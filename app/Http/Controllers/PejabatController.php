<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pejabat;
use App\User;

class PejabatController extends Controller
{
    public function index()
    {
        if (auth()->user()->username === 'fahmi' || auth()->user()->username === 'tu_pimpinan') {
            $pejabats = Pejabat::all();
        } else {
            $user = User::where('username', 'like', '%karo%')->where('biro_id', auth()->user()->biro_id)->first();
            $pejabats = Pejabat::where('user_id', $user->id)->get();
        }
        $status_disposisi = $pejabats[0]->is_ttd_area ?? '-';

        return view('pejabat.index', compact('pejabats', 'status_disposisi'));
    }

    public function create()
    {
        return view('pejabat.create');
    }

    public function edit($id)
    {
        $pejabat = Pejabat::find($id);

        return view('pejabat.edit', compact('pejabat'));
    }

    public function store(Request $request)
    {
        $add = Pejabat::create($request->all());
        if (!$add) {
            return redirect('/pejabat')->with('error', 'Gagal menambah data pejabat baru');
        }

        return redirect('/pejabat')->with('success', 'Berhasil menambah data pejabat baru');
    }

    public function update(Request $request, $id)
    {
        $pejabat = Pejabat::findOrFail($id);
        $update = $pejabat->update($request->all());
        if (!$update) {
            return back()->with('error', 'Gagal memperbarui data pejabat!');
        }

        return redirect('/pejabat')->with('success', 'Berhasil memperbarui data pejabat');
    }

    public function destroy($id)
    {
        $pejabat = Pejabat::findOrFail($id);
        $pejabat->delete();

        return back()->with('success', 'Berhasil menghapus data pejabat');
    }

    public function status(Request $request)
    {
        $pejabat = Pejabat::findOrFail($request->id);
        $pejabat->update(['is_active' => $request->status == 1 ? false : true]);

        return back()->with('success', 'Berhasil mengubah data status pejabat');
    }

    public function statusDisposisi(Request $request)
    {
        Pejabat::where('id', '!=', 0)->update(['is_ttd_area' => $request->status]);

        return back()->with('success', 'Berhasil mengubah pengaturan disposisi');
    }
}
