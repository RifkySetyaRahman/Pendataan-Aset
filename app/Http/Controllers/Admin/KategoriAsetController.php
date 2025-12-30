<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KategoriAset;

class KategoriAsetController extends Controller
{
    // Menampilkan semua data
    public function index()
    {
        $categories = KategoriAset::orderBy('name')->get();
        return view('admin.master-data.kategori', compact('categories'));
    }

    // Simpan data baru atau update data lama
    public function store(Request $request)
    {
        $data = $request->validate([
            'id' => 'nullable|exists:kategori_asets,id',
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:20|unique:kategori_asets,code,' . $request->id,
            'description' => 'nullable|string',
        ]);

        if (!empty($data['id'])) {
            // Update
            $category = KategoriAset::findOrFail($data['id']);
            $category->update([
                'name' => $data['name'],
                'code' => strtoupper($data['code']),
                'description' => $data['description'] ?? null,
            ]);
            $message = 'Kategori berhasil diperbarui';
        } else {
            // Create
            KategoriAset::create([
                'name' => $data['name'],
                'code' => strtoupper($data['code']),
                'description' => $data['description'] ?? null,
            ]);
            $message = 'Kategori berhasil ditambahkan';
        }

        return redirect()->route('kategori.index')->with('success', $message);
    }

    // Ambil data single kategori (jika ingin edit via AJAX, opsional)
    public function edit($id)
    {
        $category = KategoriAset::findOrFail($id);
        return response()->json($category);
    }

    // Hapus data
    public function destroy($id)
    {
        $category = KategoriAset::findOrFail($id);
        $category->delete();

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus');
    }
}
