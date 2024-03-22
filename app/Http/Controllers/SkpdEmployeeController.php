<?php

namespace App\Http\Controllers;

use App\Http\Requests\SkpdEmployeeRequest;
use App\Skpd;
use App\SkpdEmployee;

class SkpdEmployeeController extends Controller
{
    public function index()
    {
        $skpd_employees = SkpdEmployee::all();

        return view('skpd_employee.index', compact('skpd_employees'));
    }

    public function create()
    {
        $skpds = Skpd::get(['id', 'name']);
        $skpd_employee = SkpdEmployee::orderBy('name')->get();

        return view('skpd_employee.create', compact('skpds', 'skpd_employee'));
    }

    public function edit($id)
    {
        $skpds = Skpd::get(['id', 'name']);
        $skpd_employee = SkpdEmployee::findOrFail($id);

        return view('skpd_employee.edit', compact('skpds', 'skpd_employee'));
    }

    public function store(SkpdEmployeeRequest $request)
    {
        SkpdEmployee::create($request->all());

        return redirect('/skpd-pejabat')->with('success', 'Berhasil menambah data pejabat SKPD baru');
    }

    public function update(SkpdEmployeeRequest $request, $id)
    {
        $skpd_employee = SkpdEmployee::findOrFail($id);
        $skpd_employee->update($request->all());

        return redirect('/skpd-pejabat')->with('success', 'Berhasil memperbarui data pejabat SKPD');
    }

    public function destroy($id)
    {
        $skpd_employee = SkpdEmployee::findOrFail($id);
        if ($skpd_employee->hasRelatedData()) {
            $error = 'Tidak bisa menghapus data pejabat SKPD karena telah berelasi dengan data SPT.';
            return back()->with('error', $error);
        }
        $skpd_employee->delete();

        return back()->with('success', 'Berhasil menghapus data pejabat SKPD');
    }

    public function apiGetData($skpd_id)
    {
        $skpd_employees = SkpdEmployee::where('skpd_id', $skpd_id)->get();
        if ($skpd_employees->isEmpty()) {
            $error_msg = 'Tidak ada data pejabat skpd untuk SKPD tersebut';
            return response()->json(['success' => false, 'error' => $error_msg]);
        }

        return response()->json(['success' => true, 'data' => $skpd_employees]);
    }
}
