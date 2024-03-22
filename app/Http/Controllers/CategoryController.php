<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\KategoriRequest;
use App\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('category.index', compact('categories'));
    }

    public function create()
    {
        return view('category.create');
    }

    public function show()
    {
        // return redirect(biro_url('/kategori'));
    }

    public function edit($id)
    {
        $category = Category::find($id);

        return view('category.edit', compact('category'));
    }

    public function store(KategoriRequest $request)
    {
        $add = Category::create($request->all());

        return redirect('/kategori')
            ->with('success', 'Berhasil menambah data kategori baru');
    }

    public function update(KategoriRequest $request, $id)
    {
        $category = Category::findOrFail($id);
        $update = $category->update($request->all());
        if (!$update) {
            return back()->with('error', 'Gagal memperbarui data kategori!');
        }

        return redirect('/kategori')
            ->with('success', 'Berhasil memperbarui data kategori');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return back()->with('success', 'Berhasil menghapus data kategori');
    }
}
