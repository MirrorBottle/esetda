<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Agenda;
use App\AgendaApparel;
use App\AgendaDisposition;
use App\AgendaPartner;
use App\AgendaPlace;
use App\AgendaReceiver;
use App\Attachment;
use App\Inbox;
use App\Jobs\SendWhatsAppJob;
use Shivella\Bitly\Facade\Bitly;

class AgendaController extends Controller
{
    public function index()
    {
        $agendas = Agenda::orderBy('date', 'desc')->orderBy('time_start')->limit(50)->get();

        return view('agenda.schedule.index', compact('agendas'));
    }

    public function filterGubernur()
    {
        $receiver = 'Gubernur';
        $agendas = $this->agendaByReceiver(1);

        return view('agenda.schedule.index', compact('agendas', 'receiver'));
    }

    public function filterWakilGubernur()
    {
        $receiver = 'Wakil Gubernur';
        $agendas = $this->agendaByReceiver(2);

        return view('agenda.schedule.index', compact('agendas', 'receiver'));
    }

    public function filterSekda()
    {
        $receiver = 'Sekretaris Daerah';
        $agendas = $this->agendaByReceiver(3);

        return view('agenda.schedule.index', compact('agendas', 'receiver'));
    }

    public function filterAsistenSatu()
    {
        $receiver = 'Asisten I';
        $agendas = $this->agendaByReceiver(4);

        return view('agenda.schedule.index', compact('agendas', 'receiver'));
    }

    public function filterAsistenDua()
    {
        $receiver = 'Asisten II';
        $agendas = $this->agendaByReceiver(5);

        return view('agenda.schedule.index', compact('agendas', 'receiver'));
    }

    public function filterAsistenTiga()
    {
        $receiver = 'Asisten III';
        $agendas = $this->agendaByReceiver(6);

        return view('agenda.schedule.index', compact('agendas', 'receiver'));
    }

    public function detail($id)
    {
        $agenda = Agenda::findOrFail($id);
        $data = [
            'date' => $agenda->date_indo,
            'time' => $agenda->time_start == null ? '-' : $agenda->time_start .' s/d ' . $agenda->time_end,
            'agenda' => $agenda->event,
            'status' => $agenda->status_formatted,
            'place' => $agenda->place->name ?? '-',
            'apparel' => $agenda->apparel->name ?? '-',
            'disposition' => $agenda->disposition->position,
            'partners' => $agenda->partners,
            'description' => $agenda->description,
            'receiver' => $agenda->receiver->name,
            'is_attachment' => $agenda->is_attachment,
            'attachment' => [
                'name' => $agenda->attachment->title ?? null,
                'path' => $agenda->attachment->name ?? null
            ],
            'reference' => $agenda->inbox !== null ? $agenda->inbox->no . ' ('. $agenda->inbox->biro->name .')' : '-'
        ];

        if ($agenda->inbox !== null) {
            $data['inbox'] = [
                'id' => $agenda->inbox->id,
                'no_surat' => $agenda->inbox->no,
                'title' => $agenda->inbox->title,
                'date' => $agenda->inbox->date_formatted,
                'date_entry' => $agenda->inbox->date_entry_formatted,
                'sender' => $agenda->inbox->sender ?? '-',
                'category' => $agenda->inbox->category->name,
                'receiver' => $agenda->inbox->receiver->name,
                'description' => $agenda->inbox->description ?? '-',
                'is_attachment' => $agenda->inbox->is_attachment == 0 ? false : true,
                'attachments' => $agenda->inbox->attachments,
                'no_agenda' => $agenda->inbox->disposition->no_agenda ?? '-',
                'sifat' => $agenda->inbox->disposition->property_formatted ?? '-',
                'forward_note' => $agenda->inbox->forwards[0]->note ?? '-',
                'attachments' => $agenda->inbox->attachments ?? '-',
            ];
        }

        return response()->json(['data' => $data]);
    }

    public function search(Request $request)
    {
        $input = [
            'apparels' => AgendaApparel::all(),
            'places' => AgendaPlace::all(),
            'dispositions' => AgendaDisposition::all(),
            'partners' => AgendaPartner::all(),
            'receivers' => AgendaReceiver::get(['id', 'name']),
            'default' => $this->defaultReceiver(),
            'date' => to_indo_day(date('N')) .', '. to_indo_date(date('Y-m-d'), 1),
        ];

        return view('agenda.search.index', $input);
    }

    public function result(Request $request)
    {
        // masih ada bug untuk ngefilter receiver array
        // $filter  = $this->filterParam($request->except('_token'));
        $filter  = '';
        $agendas = Agenda::filter($request)
            ->orderBy('id', 'desc')
            ->get();

        return view('agenda.schedule.index', compact('agendas', 'filter'));
    }

    public function create()
    {
        $input = [
            'apparels' => AgendaApparel::all(),
            'places' => AgendaPlace::all(),
            'dispositions' => AgendaDisposition::all(),
            'partners' => AgendaPartner::all(),
            'receivers' => AgendaReceiver::get(['id', 'name']),
            'receiver_default' => $this->defaultReceiver(),
            'inboxes' => $this->inboxReference(),
            'date' => to_indo_day(date('N')) .', '. to_indo_date(date('Y-m-d'), 1)
        ];

        return view('agenda.schedule.create', $input);
    }

    public function edit($id)
    {
        $agenda = Agenda::findOrFail($id);
        $input = [
            'agenda' => $agenda,
            'apparels' => AgendaApparel::all(),
            'places' => AgendaPlace::all(),
            'dispositions' => AgendaDisposition::all(),
            'partners' => AgendaPartner::all(),
            'receivers' => AgendaReceiver::get(['id', 'name']),
            'receiver_default' => $this->defaultReceiver(),
            'inboxes' => $this->inboxReference($agenda->inbox_id ?? null)
        ];

        return view('agenda.schedule.edit', $input);
    }

    public function store(Request $request)
    {
        $input = $request->all();

        // check new place
        if ($request->place_id !== null) {
            $place = AgendaPlace::find($request->place_id);
            if ($place == null) {
                $new_place = AgendaPlace::create(['name' => $request->place_id]);
                $input['place_id'] = $new_place->id;
            }
        }

        // check new apparel
        if ($request->place_id !== null) {
            $apparel = AgendaApparel::find($request->apparel_id);
            if ($apparel == null) {
                $new_apparel = AgendaApparel::create(['name' => $request->apparel_id]);
                $input['apparel_id'] = $new_apparel->id;
            }
        }

        // check new disposition
        $disposition = AgendaDisposition::find($request->disposition_id);
        if ($disposition == null) {
            $new_disposition = AgendaDisposition::create(['position' => $request->disposition_id]);
            $input['disposition_id'] = $new_disposition->id;
        }

        // store and check agenda
        $agenda = Agenda::create($input);
        if (!$agenda) {
            return back()->with('error', 'Gagal menambah jadwal kegiatan baru!');
        }

        // check new partners
        if ($request->has('partner_id')) {
            $partners = array();
            foreach ($request->partner_id as $partner) {
                $check_partner = AgendaPartner::find($partner);
                if ($check_partner == null) {
                    $new_partner = AgendaPartner::create(['position' => $partner]);
                    $partners[] = $new_partner->id;
                } else {
                    $partners[] = $partner;
                }
            }

            // sync agenda partner
            $agenda->partners()->sync($partners);
        }

        // update inbox status to is agenda
        if ($request->inbox_id !== null) {
            $agenda->inbox()->update(['is_agenda' => true]);
        }

        // add attachment
        if ($request->hasFile('attachment'))
        {
            $allowed    = ['pdf', 'jpg', 'jpeg', 'png'];
            $file       = $request->file('attachment');
            $title      = $file->getClientOriginalName();
            $extension  = $file->getClientOriginalExtension();
            $name       = 'agenda_'. date('d_m_Y') .'_'. str_random(10). '.'. $extension;

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

            $shortlink = $this->generateShortLink($agenda->id);
            $agenda->update(['is_attachment' => 1, 'shortlink' => $shortlink]);
            $agenda->attachment()->save($attachment);
        }

        // send notification
        $this->sendWhatsAppBot($agenda);

        return redirect($request->back_url)->with('success', 'Berhasil menambah jadwal kegiatan baru');
    }

    public function update(Request $request, $id)
    {
        $agenda = Agenda::findOrFail($id);
        // update old inbox id agenda to false
        if ($agenda->inbox_id !== null) {
            $agenda->inbox()->update(['is_agenda' => false]);
        }

        $input = $request->all();

        // check new place
        if ($request->place_id !== null) {
            $place = AgendaPlace::find($request->place_id);
            if ($place == null) {
                $new_place = AgendaPlace::create(['name' => $request->place_id]);
                $input['place_id'] = $new_place->id;
            }
        }

        // check new apparel
        if ($request->place_id !== null) {
            $apparel = AgendaApparel::find($request->apparel_id);
            if ($apparel == null) {
                $new_apparel = AgendaApparel::create(['name' => $request->apparel_id]);
                $input['apparel_id'] = $new_apparel->id;
            }
        }

        // check new disposition
        $disposition = AgendaDisposition::find($request->disposition_id);
        if ($disposition == null) {
            $new_disposition = AgendaDisposition::create(['position' => $request->disposition_id]);
            $input['disposition_id'] = $new_disposition->id;
        }

        // update agenda
        $agenda->update($input);

        // check new partners
        if ($request->has('partner_id')) {
            $partners = array();
            foreach ($request->partner_id as $partner) {
                $check_partner = AgendaPartner::find($partner);
                if ($check_partner == null) {
                    $new_partner = AgendaPartner::create(['position' => $partner]);
                    $partners[] = $new_partner->id;
                } else {
                    $partners[] = $partner;
                }
            }

            // sync agenda partner
            $agenda->partners()->sync($partners);
        }

        // update inbox status to is agenda
        if ($request->inbox_id !== null) {
            $agenda->inbox()->update(['is_agenda' => true]);
        }

        // add attachment
        if ($request->hasFile('attachment'))
        {
            $allowed    = ['pdf', 'jpg', 'jpeg', 'png'];
            $file       = $request->file('attachment');
            $title      = $file->getClientOriginalName();
            $extension  = $file->getClientOriginalExtension();
            $name       = 'agenda_'. date('d_m_Y') .'_'. str_random(10). '.'. $extension;

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

            $shortlink = $this->generateShortLink($agenda->id);
            $agenda->update(['is_attachment' => 1, 'shortlink' => $shortlink]);
            $agenda->attachment()->delete();
            $agenda->attachment()->save($attachment);
        }

        // check attachment remove status
        if ($request->has('uploaded_file')) {
            if ($request->uploaded_file == 'removed') {
                $agenda->attachment()->delete();
                $agenda->update(['is_attachment' => 0]);
            }
        }

        // send notification
        $this->sendWhatsAppBot($agenda, 'update');

        return redirect($request->back_url)->with('success', 'Berhasil mengubah data jadwal kegiatan');
    }

    public function destroy($id)
    {
        $agenda = Agenda::findOrFail($id);
        // remove all partners agenda
        $agenda->partners()->detach();
        // remove agenda
        $agenda->delete();

        return redirect('/agenda/jadwal')->with('success', 'Berhasil menghapus data jadwal kegiatan');
    }

    private function agendaByReceiver($id)
    {
        return Agenda::where('receiver_id', $id)->orderBy('id', 'desc')->limit(50)->get();
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

    private function defaultReceiver()
    {
        if (auth()->user()->isAdmin()) { return null; }

        $code = str_replace("agenda_", "", auth()->user()->username);
        return AgendaReceiver::where('code', $code)->first();
    }

    private function inboxReference($except_id = null)
    {
        $inboxes = Inbox::where('is_agenda', 0)->where('is_archived', NULL);
        if ($except_id != null) {
            $inboxes = $inboxes->orWhere('id', $except_id);
        }
        return $inboxes->get(['id', 'no']);
    }

    private function sendWhatsAppBot($agenda, $type = null)
    {
        $shortlink = $agenda->is_attachment ? $agenda->shortlink : '-';

        $data = [
            'type' => $type,
            'username' => auth()->user()->username ?? '-',
            'phone' => '',
            'template' => 'agenda',
            'date' => $agenda->date_indo,
            'agendas' => [
                [
                    'name' => $agenda->receiver->name ?? '-',
                    'start_time' => $agenda->time_start ?? '-',
                    'end_time' => $agenda->time_end ?? '-',
                    'event' => $agenda->event ?? '-',
                    'apparel' => $agenda->apparel->name ?? '-',
                    'place' => $agenda->place->name ?? '-',
                    'note' => $agenda->description ?? '-',
                    'attachment' => $shortlink
                ]
            ]
        ];

        SendWhatsAppJob::dispatch($data)->onQueue('notif_wa');
    }

    private function generateShortLink($agenda_id)
    {
        $linktree = url('linktree/agenda/'. $agenda_id);

        return Bitly::getUrl($linktree);
    }
}
