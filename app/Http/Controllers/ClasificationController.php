<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ClasificationRequest;
use App\Clasification;

class ClasificationController extends Controller
{
    public function index()
    {
        $clasifications = Clasification::orderBy('code')->orderBy('code_clasification')->get();

        return view('clasification.index', compact('clasifications'));
    }

    public function create()
    {
        return view('clasification.create');
    }

    public function show()
    {
        // return redirect(biro_url('/Clasification'));
    }

    public function edit($id)
    {
        $clasification = Clasification::find($id);

        return view('clasification.edit', compact('clasification'));
    }

    public function store(ClasificationRequest $request)
    {
        $add = Clasification::create($request->all());

        return redirect('/arsip/klasifikasi')
            ->with('success', 'Berhasil menambah data klasifikasi baru');
    }

    public function update(ClasificationRequest $request, $id)
    {
        $clasification = Clasification::findOrFail($id);
        $update = $clasification->update($request->all());
        if (!$update) {
            return back()->with('error', 'Gagal memperbarui data klasifikasi!');
        }

        return redirect('/arsip/klasifikasi')
            ->with('success', 'Berhasil memperbarui data klasifikasi');
    }

    public function destroy($id)
    {
        $clasification = Clasification::findOrFail($id);
        if ($clasification->hasRelation()) {
            return back()->with('error', 'Kode klasifikasi '. $clasification->code .' sudah terkait dengan data arsip.');
        }

        $clasification->delete();

        return back()->with('success', 'Berhasil menghapus data klasifikasi');
    }
}
