<?php

namespace App\Http\Controllers;

use App\Http\Requests\SkpdRequest;
use App\Skpd;

class SkpdController extends Controller
{
    public function index()
    {
        $skpds = Skpd::all();

        return view('skpd.index', compact('skpds'));
    }

    public function create()
    {
        $skpd = Skpd::orderBy('name')->get();

        return view('skpd.create', compact('skpd'));
    }

    public function edit($id)
    {
        $skpd = Skpd::findOrFail($id);

        return view('skpd.edit', compact('skpd'));
    }

    public function store(SkpdRequest $request)
    {
        Skpd::create($request->all());

        return redirect('/skpd')->with('success', 'Berhasil menambah data skpd baru');
    }

    public function update(SkpdRequest $request, $id)
    {
        $skpd = Skpd::findOrFail($id);
        $skpd->update($request->all());

        return redirect('/skpd')->with('success', 'Berhasil memperbarui data skpd');
    }

    public function destroy($id)
    {
        $skpd = Skpd::findOrFail($id);
        if ($skpd->hasRelatedData()) {
            $error = 'Tidak bisa menghapus skpd karena telah berelasi dengan data SPT.';
            return back()->with('error', $error);
        }
        $skpd->delete();

        return back()->with('success', 'Berhasil menghapus data skpd');
    }
}
