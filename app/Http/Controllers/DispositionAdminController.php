<?php

namespace App\Http\Controllers;

use App\DispositionAdmin;
use App\Forward;
use App\Inbox;
use App\Jobs\SendWhatsAppJob;
use App\Receiver;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class DispositionAdminController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DispositionAdmin  $dispositionAdmin
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $inbox = Inbox::findOrFail($id);
        $disposition_data = $this->dispositionData($inbox->unique_key);
        $data = [
            'inbox' => $inbox,
            'dispositions' => $disposition_data,
            'disposition_items' => $this->dispositionItems(),
            'disposition_status' => $this->dispositionStatus($disposition_data),
            'receivers' => $this->receiverDataPerUser(),
        ];

        return view('inbox.disposisi_admin', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Inbox  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->except('disposition_admin_id', 'signature_check');

        // update data yg sdh pernah disposisi sebelumnya
        if ($request->disposition_admin_id !== null) {
            // reset position jika gk ada
            if (!$request->has('position')) {
                $input['position'] = null;
            }
            // remove signature image
            if ($request->signature_image !== null && $request->signature_check === '0') {
                $input['signature_image'] = null;
            }

            $disposition_admin = DispositionAdmin::findOrFail($request->disposition_admin_id);

            // generate signature image
            if ($request->signature_image === null && $request->signature_check == '1') {
                $input['signature_image'] = $this->generateSignature($disposition_admin);
            }

            // cek jika data di ubah ke biro lain
            if ($disposition_admin->receiver_id !== (int) $request->receiver_id) {
                // hapus data yg sudah di teruskan sebelumnya
                $old_forward = Forward::where('inbox_id', $disposition_admin->inbox_id)
                    ->where('biro_id', $disposition_admin->receiver->biro_id)
                    ->first();

                if ($old_forward !== null) {
                    $old_forward->delete();
                }

                // forward ulang data ke biro baru
                $this->forwardData($request);
            }

            // update disposisi terbaru
            $disposition_admin->update($input);

            // kirim notif wa
            $this->NotifWaDisposisi($disposition_admin->refresh(), 'update');

            return back()->with('success', 'Berhasil memperbarui data disposisi');
        }

        $disposition_admin = DispositionAdmin::create($input);
        $inbox = Inbox::findOrFail($id);
        $inbox->update(['is_disposition' => true]);

        // generate signature image
        if ($request->signature_image === null && $request->signature_check == '1') {
            $disposition_admin->update(['signature_image' => $this->generateSignature($disposition_admin)]);
        }

        // check jika di teruskan ke biro-biro maka masukkan ke surat terusan
        if (strpos($disposition_admin->receiver->name, 'BIRO') !== false) {
            $this->forwardData($request);
        }

        // kirim notif wa
        $this->NotifWaDisposisi($disposition_admin);

        return back()->with('success', 'Berhasil mengirim data disposisi');
    }

    /**
     * Generate signature image from base64 string.
     *
     */
    private function generateSignature($disposition_admin)
    {
        $file_name = 'Disposisi_Surat_' . $disposition_admin->id . '' . $disposition_admin->created_at->format('dmYHis') . '.pdf';
        $qr_code = QrCode::format('png')
            ->merge('images/kaltim-logo-small.png', 0.35, true)
            ->size(200)
            ->errorCorrection('H')
            ->generate(url('storage/' . $file_name));

        $image_encode = base64_encode($qr_code);
        $image_name = 'DS_' . auth()->user()->id . '_' . date('d_m_Y') . '_' . time() . '.png';
        File::put(public_path('storage') . '/' . $image_name, base64_decode($image_encode));

        return $image_name;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Inbox  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DispositionAdmin $dispositionAdmin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function checkPassword(Request $request)
    {
        $disposition_password = auth()->user()->disposition_password;
        if (Hash::check($request->password, $disposition_password)) {
            return response()->json([
                'status' => true,
                'message' => 'Disposition Password Correct'
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Disposition Password Incorrect'
        ]);
    }

    public function setUniqueKey()
    {
        $dispositions = DispositionAdmin::where('unique_key', NULL)->get();

        foreach ($dispositions as $disposition) {
            $key = unique_key();
            $disposition->update(['unique_key' => $key]);
            $inbox = Inbox::find($disposition->inbox_id);
            if ($inbox !== null) {
                $inbox->update(['unique_key' => $key]);
            }
        }

        // dd('joss mantap');
    }

    public function allDisposition($id)
    {
        $inbox = Inbox::with('disposition_admin')->findOrFail($id);

        return view('inbox.all_disposition', compact('inbox'));
    }

    private function dispositionData($unique_key)
    {
        return DispositionAdmin::where('unique_key', $unique_key)->whereNotNull('actions')->get();
    }

    private function dispositionStatus($data)
    {
        $status = [
            'type' => 'new',
            'id' => null,
            'actions' => [],
            'receiver_id' => null,
            'position' => null,
            'description' => null,
            'signature' => null
        ];

        foreach ($data as $disposition) {
            if ($disposition->user_id === auth()->user()->id) {
                $status = [
                    'type' => 'edit',
                    'id' => $disposition->id,
                    'actions' => $disposition->actions,
                    'receiver_id' => $disposition->receiver_id,
                    'position' => $disposition->position,
                    'description' => $disposition->description,
                    'signature' => $disposition->signature_image
                ];
            }
        }

        return $status;
    }

    private function receiverDataPerUser()
    {
        $username = auth()->user()->username;
        if (strpos($username, 'admin') !== false || strpos($username, 'pj') !== false) {
            // tujuan admin2
            $list_id = [3, 4, 5, 6, 7];
            if ($username == 'admin_gub' || $username == 'pj_gubernur') {
                $list_id[] = 2;
            }

            return Receiver::whereIn('id', $list_id)
                ->orWhere('name', 'like', '%BIRO%')
                ->orWhere('type', 2)
                ->orWhere('name', 'ARSIP')
                ->where('name', '!=', 'KABAG')
                ->where('name', '!=', 'KASUBAG')
                ->get(['id', 'name', 'type']);
        }

        return Receiver::where('name', 'like', '%BIRO%')
            ->orWhere('name', 'KABAG')
            ->orWhere('name', 'KASUBAG')
            ->orWhere('name', 'ARSIP')
            ->get(['id', 'name', 'type']);
    }

    private function dispositionItems()
    {
        return [
            1 => 'Proses Lebih Lanjut',
            'Tanggapan dan Saran',
            'Jadwalkan',
            'Wakil / Dampingi',
            'Siapkan Bahan / Pointer',
            'Koordinasikan',
        ];
    }

    private function NotifWaDisposisi($disposition, $tipe = 'new')
    {
        $auth_receiver = auth()->user()->receiver->name;
        $user_receiver = User::where('receiver_id', $disposition->receiver_id)->first();
        // jika kirim ke biro maka target ke akun operator biro
        if ($disposition->receiver->biro_id !== null) {
            $user_receiver = User::where('type', 1)
                ->where('receiver_id', null)
                ->where('biro_id', $disposition->receiver->biro_id)
                ->first();
        }

        if ($user_receiver === null) {
            Log::error("User Tujuan " . $disposition->receiver->name . " belum ada.");
            return true;
        }

        if ($user_receiver->wa === null) {
            Log::error("Nomor WA untuk tujuan " . $disposition->receiver->name . " belum ada");
            return true;
        }

        $inbox = $disposition->inbox;
        $data_surat = [
            'template' => 'cek_status',
            'username' => auth()->user()->username ?? '-',
            'code' => null,
            'tipe' => $tipe,
            'phone' => $user_receiver->wa,
            'instansi' => $inbox->sender,
            'no_surat' => $inbox->no ?? '-',
            'dari' => $auth_receiver,
            'tujuan' => $disposition->receiver->name . ' ' . $disposition->position,
            'judul' => $inbox->title,
            'status' => 'Perlu Disposisi',
        ];

        SendWhatsAppJob::dispatch($data_surat)->onQueue('notif_wa');
    }

    private function forwardData($request)
    {
        $receiver = Receiver::findOrFail($request->receiver_id);
        $forward = Forward::create([
            'biro_id' => $receiver->biro_id,
            'user_id' => auth()->user()->id,
            'inbox_id' => $request->inbox_id,
            'outbox_id' => null,
            'receiver_id' => auth()->user()->receiver_id, // todo: kek nya gk dipake sih ini
            'note' => $request->description,
        ]);

        return $forward;
    }
}
