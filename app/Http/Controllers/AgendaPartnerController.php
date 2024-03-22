<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AgendaPartner;

class AgendaPartnerController extends Controller
{
    public function index()
    {
        $partners = AgendaPartner::orderBy('position')->get();

        return view('agenda.partner.index', compact('partners'));
    }

    public function create()
    {
        return view('agenda.partner.create');
    }

    public function edit($id)
    {
        $partner = AgendaPartner::find($id);

        return view('agenda.partner.edit', compact('partner'));
    }

    public function store(Request $request)
    {
        $add = AgendaPartner::create($request->all());

        return redirect('/agenda/pendamping')->with('success', 'Berhasil menambah data pendamping baru');
    }

    public function update(Request $request, $id)
    {
        $partner = AgendaPartner::findOrFail($id);
        $update = $partner->update($request->all());
        if (!$update) {
            return back()->with('error', 'Gagal memperbarui data pendamping!');
        }

        return redirect('/agenda/pendamping')->with('success', 'Berhasil memperbarui data pendamping');
    }

    public function destroy($id)
    {
        $partner = AgendaPartner::findOrFail($id);
        // remove all partners agenda
        $partner->agendas()->detach();
        // remove partner
        $partner->delete();

        return back()->with('success', 'Berhasil menghapus data pendamping');
    }
}
