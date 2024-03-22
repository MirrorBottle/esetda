<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LetterNumber;

class LetterNumberController extends Controller
{
    public function index()
    {
        $letter_numbers = LetterNumber::orderBy('month_year', 'desc')->get();

        return view('letter_number.master.index', compact('letter_numbers'));
    }

    public function create()
    {
        return view('letter_number.master.create');
    }

    public function edit($id)
    {
        $letter_number = LetterNumber::find($id);

        return view('letter_number.master.edit', compact('letter_number'));
    }

    public function store(Request $request)
    {
        // check existing month year
        $month_year_formatted = $this->reformatDateInput($request);
        if ($this->isDateExist($month_year_formatted)) {
            return back()->with('error', 'Data nomor untuk '.to_indo_month($request->month). ' '. $request->year .' sudah ada.');
        }

        // check wrong number
        if ($request->start > $request->end) {
            return back()->with('error', 'Nomor awal lebih besar daripada nomor akhir');
        }

        $input = $request->all();
        $input['month_year'] = $month_year_formatted;
        $add = LetterNumber::create($input);
        if (!$add) {
            return redirect('/arsip/nomor-surat')->with('error', 'Gagal menambah data nomor baru');
        }

        return redirect('/arsip/nomor-surat')->with('success', 'Berhasil menambah data nomor baru');
    }

    public function update(Request $request, $id)
    {
        // check wrong number
        if ($request->start > $request->end) {
            return back()->with('error', 'Nomor awal lebih besar daripada nomor akhir');
        }

        $letter_number = LetterNumber::findOrFail($id);
        $update = $letter_number->update($request->all());
        if (!$update) {
            return back()->with('error', 'Gagal memperbarui data nomor!');
        }

        return redirect('/arsip/nomor-surat')->with('success', 'Berhasil memperbarui data nomor');
    }

    public function destroy($id)
    {
        $letter_number = LetterNumber::findOrFail($id);
        if ($letter_number->useds()->count() > 0) {
            return back()->with('error', 'Data nomor sudah memiliki data yang terkait');
        }
        $letter_number->removeRelatedData();
        $letter_number->delete();

        return back()->with('success', 'Berhasil menghapus data nomor');
    }

    private function reformatDateInput($request)
    {
        return $request->year .'-'. $request->month .'-01';
    }

    private function isDateExist($month_year_formatted)
    {
        $check = LetterNumber::where('month_year', $month_year_formatted)->first();
        return $check !== null;
    }
}
