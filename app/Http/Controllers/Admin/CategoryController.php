<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('id', 'DESC')->get();

        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $save = Category::insert([
            'name' => $request->input('name')
        ]);

        if ($save) {
            return back()->with('success', 'Berhasil menambahkan kategori baru.');
        }

        return back()->with('error', 'Gagal menambahkan kategori baru.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $update = $category->update([
            'name' => $request->input('name')
        ]);

        if ($update) {
            return back()->with('success', 'Berhasil mengubah data kategori.');
        }

        return back()->with('error', 'Gagal mengubah data kategori.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        if ( $category->delete() ) {
            return back()->with('success', 'Berhasil menghapus data kategori.');
        }

        return back()->with('error', 'Gagal menghapus data kategori.');
    }
}
