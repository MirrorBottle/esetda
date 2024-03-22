<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AgendaReceiver;

class AgendaReceiverController extends Controller
{
    public function index()
    {
        $receivers = AgendaReceiver::all();

        return view('agenda.receiver.index', compact('receivers'));
    }

    public function create()
    {
        return view('agenda.receiver.create');
    }

    public function edit($id)
    {
        $receiver = AgendaReceiver::find($id);

        return view('agenda.receiver.edit', compact('receiver'));
    }

    public function store(Request $request)
    {
        $add = AgendaReceiver::create($request->all());

        return redirect('/agenda/tujuan')->with('success', 'Berhasil menambah data tujuan baru');
    }

    public function update(Request $request, $id)
    {
        $receiver = AgendaReceiver::findOrFail($id);
        $update = $receiver->update($request->all());
        if (!$update) {
            return back()->with('error', 'Gagal memperbarui data tujuan!');
        }

        return redirect('/agenda/tujuan')->with('success', 'Berhasil memperbarui data tujuan');
    }

    public function destroy($id)
    {
        $receiver = AgendaReceiver::findOrFail($id);
        $receiver->delete();

        return back()->with('success', 'Berhasil menghapus data tujuan');
    }
}
