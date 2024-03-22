<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ArchiveRequest;
use App\Archive;
use App\ArchiveInfo;
use App\ArchiveBundle;
use App\ArchiveBundleDetail;
use App\Clasification;
use App\Inbox;
use App\Outbox;
use App\Biro;
use App\Attachment;

class ArchiveController extends Controller
{
    public function index($type)
    {
        if ( auth()->user()->isAdmin() ) {
            // daftar seluruh arsip
            $archives = Archive::filterType($type)
                ->where('status', '!=', 'p')
                ->orderBy('id', 'desc')
                ->get();
        } else {
            $archives = Archive::filterBiro()
                ->filterType($type)
                ->orderBy('id', 'desc')
                ->limit(50)
                ->get();
        }

        return view('archive.index', compact('archives', 'type'));
    }

    public function bundleList($type)
    {
        $bundles = ArchiveBundle::where('type', $type)
            ->orderBy('id', 'desc')
            ->get();

        return view('archive.bundle.index', compact('bundles', 'type'));
    }

    public function validationList($type, $bundle_id)
    {
        $back_url = url('arsip/validasi/'. $type .'/'. $bundle_id);
        $details = ArchiveBundleDetail::where('bundle_id', $bundle_id)
            ->orderBy('id', 'desc')
            ->get();

        return view('archive.bundle.detail', compact('details', 'type', 'back_url', 'bundle_id'));
    }

    public function detail($type, $id)
    {
        $archive = Archive::filterType($type)->findOrFail($id);
        $relation   = $archive->archivable;
        $data    = [
            'clasification' => $archive->clasification->name,
            'clasification_code' => $archive->clasification->code_formatted,
            'description' => $archive->description ?? '-',
            'year' => $archive->year,
            'date' => $archive->date_indo,
            'tk_prk' => $archive->tk_prk_formatted,
            'qty' => $archive->qty,
            'no_box' => $archive->no_box ?? '-',
            'no_folder' => $archive->no_folder ?? '-',
            'condition' => $archive->condition_formatted,
            'note' => $archive->note ?? '-',
            'is_attachment' => $archive->is_attachment,
            'attachment' => [
                'name' => $archive->attachment->title ?? 'null',
                'path' => $archive->attachment->name ?? 'null'
            ],
            'archivable' => [
                'id' => $relation->id,
                'no_surat' => $relation->no,
                'title' => $relation->title,
                'date' => $relation->date_formatted,
                'date_entry' => $relation->date_entry_formatted,
                'sender' => $relation->sender ?? '-',
                'category' => $relation->category->name,
                'receiver' => $relation->receiver->name,
                'description' => $relation->description ?? '-',
                'is_attachment' => $relation->is_attachment == 0 ? false : true,
                'attachments' => $relation->attachments,
                'no_agenda' => $relation->disposition->no_agenda ?? '-',
                'sifat' => $relation->disposition->property_formatted ?? '-',
                'forward_note' => $relation->forwards[0]->note ?? '-',
                'attachments' => $relation->attachments ?? '-',
            ]
        ];

        return response()->json(['data' => $data]);
    }

    public function search(Request $request)
    {
        $input = [
            'biros' => Biro::get(['id', 'name']),
            'date' => to_indo_day(date('N')) .', '. to_indo_date(date('Y-m-d'), 1),
        ];

        return view('archive.search.index', $input);
    }

    public function result(Request $request)
    {
        // masih bug untuk parm array biro
        // $filter = $this->filterParam($request->except('_token'));
        $filter = '';
        $type = $request->type;
        if (auth()->user()->isAdmin()) {
            $archives = Archive::where('status', '!=', 'p')
                ->filterType($type)
                ->filter($request);

            if ($request->has('biro_id')) {
                $archives = $archives->whereIn('biro_id', $request->biro_id);
            }
        } else {
            $archives = Archive::filterBiro()
                ->filterType($type)
                ->filter($request);
        }

        $archives = $archives->orderBy('id', 'desc')->get();

        return view('archive.index', compact('archives', 'filter', 'type'));
    }

    public function create($type)
    {
        $input = [
            'type' => $type,
            'date' => to_indo_day(date('N')) .', '. to_indo_date(date('Y-m-d'), 1),
            'biro_id' => auth()->user()->biro_id,
            'biro' => auth()->user()->biro->name ?? '',
            'biros' => $this->biroData(),
            'clasifications' => $this->clasificationData(),
            'surats' => $this->unarchivedData($type),
            'surat_id' => 0,
            'surat_title' => '',
        ];

        return view('archive.create', $input);
    }

    public function createCustom($type, $id)
    {
        $archive_info = ArchiveInfo::findOrFail($id);
        $input = [
            'type' => $type,
            'date' => $archive_info->date_indo,
            'biro_id' => auth()->user()->biro_id,
            'biro' => auth()->user()->biro->name,
            'biros' => $this->biroData(),
            'clasifications' => $this->clasificationData(),
            'surats' => $this->unarchivedData($type),
            'surat_id' => $archive_info->archivable_id,
            'surat_title' => $archive_info->archivable->title,
        ];

        return view('archive.create', $input);
    }

    public function edit($type, $id)
    {
        $archive = Archive::findOrFail($id);
        $input = [
            'type' => $type,
            'archive' => $archive,
            'biro_id' => $archive->biro_id,
            'biro' => $archive->biro->name,
            'clasifications' => $this->clasificationData(),
            'surat_id' => $archive->archivable_id,
            'surat_title' => $archive->no_surat,
            'back_url' => request()->back_url ?? null
        ];

        return view('archive.edit', $input);
    }

    public function store(ArchiveRequest $request, $type)
    {
        $model = $type == 'masuk' ? Inbox::class : Outbox::class;
        $surat = $model::find($request->surat_id);
        $archive = $surat->archive()->save(new Archive($request->all()));

        if ($request->hasFile('attachment'))
        {
            $allowed    = ['pdf', 'jpg', 'jpeg', 'png'];
            $file       = $request->file('attachment');
            $title      = $file->getClientOriginalName();
            $extension  = $file->getClientOriginalExtension();
            $name       = 'arsip_'. date('d_m_Y') .'_'. str_random(10). '.'. $extension;

            $check = in_array(strtolower($extension), $allowed);
            if ($check) {
                $attachment = new Attachment([
                    'user_id' => auth()->user()->id,
                    'title' => $title,
                    'name' => $name,
                    'ext' => $extension,
                    'size' => $file->getSize(),
                    'order' => 1
                ]);
                $file->move(public_path('storage'), $name);
            }

            $archive->update(['is_attachment' => 1]);
            $archive->attachment()->save($attachment);
        }

        // check if has archive info
        $archive_info = ArchiveInfo::where('archivable_type', $archive->archivable_type)
            ->where('archivable_id', $request->surat_id)
            ->first();

        if ($archive_info !== null) {
            $archive_info->update(['is_archived' => 1]);
            $archive_info->archivable()->update(['is_archived' => 1]);
        }

        return redirect('arsip/'. $type)->with('success', 'Berhasil menambah arsip '.$type.' baru');
    }

    public function update(ArchiveRequest $request, $type, $id)
    {
        $archive = Archive::findOrFail($id);
        $archive->update($request->all());

        if ($request->hasFile('attachment'))
        {
            $allowed    = ['pdf', 'jpg', 'jpeg', 'png'];
            $file       = $request->file('attachment');
            $title      = $file->getClientOriginalName();
            $extension  = $file->getClientOriginalExtension();
            $name       = 'arsip_'. date('d_m_Y') .'_'. str_random(10). '.'. $extension;

            $check = in_array(strtolower($extension), $allowed);
            if ($check) {
                $attachment = new Attachment([
                    'user_id' => auth()->user()->id,
                    'title' => $title,
                    'name' => $name,
                    'ext' => $extension,
                    'size' => $file->getSize(),
                    'order' => 1
                ]);
                $file->move(public_path('storage'), $name);
            }

            $archive->update(['is_attachment' => 1]);
            $archive->attachment()->delete();
            $archive->attachment()->save($attachment);
        }

        // check attachments status
        if ($request->uploaded_file == 'removed') {
            $archive->attachment()->delete();
            $archive->update(['is_attachment' => 0]);
        }

        $redirect_url = 'arsip/'.$type;
        if ($request->back_url !== null) { $redirect_url = $request->back_url; }

        return redirect($redirect_url)->with('success', 'Berhasil mengubah data arsip '.$type);
    }

    public function updateValidation(Request $request)
    {
        // generate new bundle
        $archives = array();
        $list_id  = explode(",", $request->list_surat_id);
        foreach ($list_id as $id) {
            $archive_check = Archive::findOrFail($id);
            $archives[] = new ArchiveBundleDetail(['archive_id' => $archive_check->id]);
            $archive_check->update(['status' => $request->status]);
        }

        $bundle = ArchiveBundle::create(['type' => $request->type, 'total' => count($list_id)]);
        $bundle->details()->saveMany($archives);

        return back()->with('success', 'Berhasil mengirim data arsip '.$request->type);
    }

    public function destroy($type, $id)
    {
        $archive = Archive::findOrFail($id);
        $archive->removeRelatedData();
        $archive->delete();

        return redirect('arsip/'.$type)->with('success', 'Berhasil menghapus data arsip '.$type);
    }

    public function confirm(Request $request)
    {
        foreach ($request->list_id as $archive_id => $action) {
            $status = $action == '1' ? 'a' : 'r';
            $archive = Archive::findOrFail($archive_id);
            $archive->update(['status' => $status]);
            $archive->bundle()->update(['status' => $status]);
            $archive->archivable()->update(['is_archived' => 1]);
        }

        $bundle = ArchiveBundle::findOrFail($request->bundle_id);
        $check_status = ArchiveBundleDetail::where('bundle_id', $bundle->id)->where('status', null)->count();
        if ($check_status == null) { $bundle->update(['status' => 'a']); }
        else { $bundle->update(['status' => 'p']); }

        return back()->with('success', 'Berhasil melakukan validasi arsip surat '.$request->type);
    }

    private function unarchivedData($type, $except_id = null)
    {
        $model = $type == 'masuk' ? Inbox::class : Outbox::class;
        $archives = Archive::filterBiro()->filterType($type);
        if ($except_id != null) {
            $archives = $archives->where('id', '!=', $except_id);
        }

        return $model::filterBiro()
            ->whereNotIn('id', $archives->pluck('archivable_id'))
            ->get(['id', 'no']);
    }

    private function clasificationData()
    {
        return Clasification::get(['id', 'code', 'code_clasification', 'name']);
    }

    private function biroData()
    {
        return Biro::get(['id', 'name']);
    }

    private function filterParam($request)
    {
        $filter = '';
        foreach ($request as $key => $param)
        {
            $filter .= $key .'='. urlencode($param) .'&';
        }

        return substr($filter, 0, -1);
    }
}
