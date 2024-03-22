<?php

namespace App\Http\Controllers;

use App\Http\Requests\SptSignerRequest;
use App\SptSigner;

class SptSignerController extends Controller
{
    public function index()
    {
        $spt_signers = SptSigner::all();

        return view('spt_signer.index', compact('spt_signers'));
    }

    public function create()
    {
        $spt_signer = SptSigner::orderBy('name')->get();

        return view('spt_signer.create', compact('spt_signer'));
    }

    public function edit($id)
    {
        $spt_signer = SptSigner::findOrFail($id);

        return view('spt_signer.edit', compact('spt_signer'));
    }

    public function store(SptSignerRequest $request)
    {
        SptSigner::create($request->all());

        return redirect('/spt-ttd')->with('success', 'Berhasil menambah data penandatangan SPT baru');
    }

    public function update(SptSignerRequest $request, $id)
    {
        $spt_signer = SptSigner::findOrFail($id);
        $spt_signer->update($request->all());

        return redirect('/spt-ttd')->with('success', 'Berhasil memperbarui data penandatangan SPT');
    }

    public function destroy($id)
    {
        $spt_signer = SptSigner::findOrFail($id);
        if ($spt_signer->hasRelatedData()) {
            $error = 'Tidak bisa menghapus data penandatangan SPT karena telah berelasi dengan data spt.';
            return back()->with('error', $error);
        }
        $spt_signer->delete();

        return back()->with('success', 'Berhasil menghapus data penandatangan SPT');
    }
}
