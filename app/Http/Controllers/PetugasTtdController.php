<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PetugasTtd;

class PetugasTtdController extends Controller
{
    public function archive()
    {
        $petugas_ttd = PetugasTtd::where('type', 'arsip')->first();

        return view('archive.petugas_ttd', compact('petugas_ttd'));
    }

    public function archiveUpdate(Request $request)
    {
        $petugas_ttd = PetugasTtd::where('type', 'arsip')->first();
        $petugas_ttd->update($request->all());

        return back()->with('success', 'Berhasil mengubah data petugas penandatangan');
    }

    public function agenda()
    {
        $petugas_ttd = PetugasTtd::where('type', 'agenda')->first();

        return view('agenda.schedule.petugas_ttd', compact('petugas_ttd'));
    }

    public function agendaUpdate(Request $request)
    {
        $petugas_ttd = PetugasTtd::where('type', 'agenda')->first();
        $petugas_ttd->update($request->all());

        return back()->with('success', 'Berhasil mengubah data petugas penandatangan');
    }

    public function biro()
    {
        $slug = auth()->user()->biro->slug;
        $petugas_ttd = PetugasTtd::where('type', $slug)->first();

        return view('petugas.index', compact('petugas_ttd', 'slug'));
    }

    public function biroUpdate(Request $request, $slug)
    {
        $petugas_ttd = PetugasTtd::where('type', $slug)->first();
        $petugas_ttd->update($request->all());

        return back()->with('success', 'Berhasil mengubah data petugas penandatangan');
    }
}
