<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AgendaDisposition;

class AgendaDispositionController extends Controller
{
    public function index()
    {
        $dispositions = AgendaDisposition::orderBy('position')->get();

        return view('agenda.disposition.index', compact('dispositions'));
    }

    public function create()
    {
        return view('agenda.disposition.create');
    }

    public function edit($id)
    {
        $disposition = AgendaDisposition::find($id);

        return view('agenda.disposition.edit', compact('disposition'));
    }

    public function store(Request $request)
    {
        $add = AgendaDisposition::create($request->all());

        return redirect('/agenda/disposisi')->with('success', 'Berhasil menambah data disposisi baru');
    }

    public function update(Request $request, $id)
    {
        $disposition = AgendaDisposition::findOrFail($id);
        $update = $disposition->update($request->all());
        if (!$update) {
            return back()->with('error', 'Gagal memperbarui data disposisi!');
        }

        return redirect('/agenda/disposisi')->with('success', 'Berhasil memperbarui data disposisi');
    }

    public function destroy($id)
    {
        $disposition = AgendaDisposition::findOrFail($id);
        $disposition->delete();

        return back()->with('success', 'Berhasil menghapus data disposisi');
    }
}
