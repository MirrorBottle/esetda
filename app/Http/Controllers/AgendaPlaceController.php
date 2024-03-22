<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AgendaPlace;

class AgendaPlaceController extends Controller
{
    public function index()
    {
        $places = AgendaPlace::orderBy('name')->get();

        return view('agenda.place.index', compact('places'));
    }

    public function create()
    {
        return view('agenda.place.create');
    }

    public function edit($id)
    {
        $place = AgendaPlace::find($id);

        return view('agenda.place.edit', compact('place'));
    }

    public function store(Request $request)
    {
        $add = AgendaPlace::create($request->all());

        return redirect('/agenda/tempat')->with('success', 'Berhasil menambah data tempat baru');
    }

    public function update(Request $request, $id)
    {
        $place = AgendaPlace::findOrFail($id);
        $update = $place->update($request->all());
        if (!$update) {
            return back()->with('error', 'Gagal memperbarui data tempat!');
        }

        return redirect('/agenda/tempat')->with('success', 'Berhasil memperbarui data tempat');
    }

    public function destroy($id)
    {
        $place = AgendaPlace::findOrFail($id);
        $place->delete();

        return back()->with('success', 'Berhasil menghapus data tempat');
    }
}
