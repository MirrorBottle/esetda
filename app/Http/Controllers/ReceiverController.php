<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TujuanRequest;
use App\User;
use App\Category;
use App\CategoryDetail;
use App\Receiver;
use App\ReceiverDetail;

class ReceiverController extends Controller
{
    public function index()
    {
        $receivers = Receiver::all();

        return view('receiver.index', compact('receivers'));
    }

    public function create()
    {
        $receivers = Receiver::orderBy('name')->get();

        return view('receiver.create', compact('receivers'));
    }

    public function show()
    {
        return redirect('/tujuan');
    }

    public function edit($id)
    {
        $receiver = Receiver::findOrFail($id);

        return view('receiver.edit', compact('receiver'));
    }

    public function store(TujuanRequest $request)
    {
        $add = Receiver::create($request->all());

        return redirect('/tujuan')
            ->with('success', 'Berhasil menambah data tujuan baru');
    }

    public function update(TujuanRequest $request, $id)
    {
        $receiver = Receiver::findOrFail($id);
        $update = $receiver->update($request->all());

        return redirect('/tujuan')->with('success', 'Berhasil memperbarui data tujuan');
    }

    public function destroy($id)
    {
        $receiver = Receiver::findOrFail($id);
        if ($receiver->hasRelatedData()) {
            return back()->with('error', 'Tidak bisa menghapus tujuan karena telah berelasi dengan data surat atau dari biro lainnya.');
        }
        $receiver->delete();

        return back()->with('success', 'Berhasil menghapus data tujuan');
    }

    public function apiData(Request $request)
    {
        $receivers = Receiver::where('type', $request->type)->get(['id', 'name']);

        if ($receivers->isEmpty()) {
            $error_msg = 'Tidak ada data tujuan untuk tipe tersebut';
            return response()->json(['success' => false, 'error' => $error_msg]);
        }

        return response()->json(['success' => true, 'data' => $receivers]);
    }
}
