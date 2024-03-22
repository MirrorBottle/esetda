<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AgendaApparel;

class AgendaApparelController extends Controller
{
    public function index()
    {
        $apparels = AgendaApparel::orderBy('name')->get();

        return view('agenda.apparel.index', compact('apparels'));
    }

    public function create()
    {
        return view('agenda.apparel.create');
    }

    public function edit($id)
    {
        $apparel = AgendaApparel::find($id);

        return view('agenda.apparel.edit', compact('apparel'));
    }

    public function store(Request $request)
    {
        $add = AgendaApparel::create($request->all());

        return redirect('/agenda/pakaian')->with('success', 'Berhasil menambah data pakaian baru');
    }

    public function update(Request $request, $id)
    {
        $apparel = AgendaApparel::findOrFail($id);
        $update = $apparel->update($request->all());
        if (!$update) {
            return back()->with('error', 'Gagal memperbarui data pakaian!');
        }

        return redirect('/agenda/pakaian')->with('success', 'Berhasil memperbarui data pakaian');
    }

    public function destroy($id)
    {
        $apparel = AgendaApparel::findOrFail($id);
        $apparel->delete();

        return back()->with('success', 'Berhasil menghapus data pakaian');
    }
}
