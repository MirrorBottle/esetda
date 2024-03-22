<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kop;

class KopController extends Controller
{
    public function index()
    {
        $kops = Kop::all();

        return view('kop.index', compact('kops'));
    }

    public function edit($id)
    {
        $kop = Kop::findOrFail($id);

        return view('kop.edit', compact('kop'));
    }

    public function update(Request $request, $id)
    {
        $kop = Kop::findOrFail($id);
        $kop->update(['content' => $request->content]);

        return redirect('/kop')->with('success', 'Berhasil mengubah data kop surat');
    }
}
