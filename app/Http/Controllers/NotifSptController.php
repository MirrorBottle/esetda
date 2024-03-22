<?php

namespace App\Http\Controllers;

use App\Phone;
use Illuminate\Http\Request;
use App\Jobs\SendWhatsAppJob;
use App\SptTemplate;

class NotifSptController extends Controller
{
    public function index()
    {
        $phones = Phone::orderBy('name')->get();
        $templates = SptTemplate::where('id', '!=', 4)->orderBy('name')->get();

        return view('notif_spt.index', compact('phones', 'templates'));
    }

    public function new()
    {
        $template = SptTemplate::where('id', 4)->first();

        return view('notif_spt.new', compact('template'));
    }

    public function newUpdate(Request $request)
    {
        $template = SptTemplate::findOrFail(4);
        $update = $template->update($request->all());
        if (!$update) {
            return back()->with('error', 'Berhasil mengubah data template');
        }

        return back()->with('success', 'Berhasil mengubah data template');
    }

    public function store(Request $request)
    {
        $format = [
            'template' => 'spt',
            'username' => auth()->user()->username ?? '-',
            'phone' => $request->phone_number,
            'message' => $request->message
        ];

        SendWhatsAppJob::dispatch($format)->onQueue('notif_wa');

        return back()->with('success', 'Berhasil mengirim notifikasi ke nomor '. $format['phone']);
    }

    public function phoneUpdate(Request $request, $id)
    {
        $phone = Phone::findOrFail($id);
        $update = $phone->update($request->all());
        if (!$update) {
            return back()->with('error', 'Berhasil mengubah data penerima');
        }

        return back()->with('success', 'Berhasil mengubah data penerima');
    }

    public function phoneDestroy($id)
    {
        $phone = Phone::findOrFail($id);
        $delete = $phone->delete();
        if (!$delete) {
            return back()->with('error', 'Berhasil menghapus data penerima');
        }

        return back()->with('success', 'Berhasil menghapus data penerima');
    }

    public function templateStore(Request $request)
    {
        $add = SptTemplate::create($request->all());
        if (!$add) {
            return back()->with('error', 'Berhasil menambah data template');
        }

        return back()->with('success', 'Berhasil menambah data template');
    }

    public function templateUpdate(Request $request, $id)
    {
        $template = SptTemplate::findOrFail($id);
        $update = $template->update($request->all());
        if (!$update) {
            return back()->with('error', 'Berhasil mengubah data template');
        }

        return back()->with('success', 'Berhasil mengubah data template');
    }

    public function templateDestroy($id)
    {
        $template = SptTemplate::findOrFail($id);
        $delete = $template->delete();
        if (!$delete) {
            return back()->with('error', 'Berhasil menghapus data template');
        }

        return back()->with('success', 'Berhasil menghapus data template');
    }
}
