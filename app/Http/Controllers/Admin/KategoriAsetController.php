<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KategoriAset;
use Illuminate\Support\Str;

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
            'id'          => 'nullable|exists:kategori_asets,id',
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        // =========================
        // AUTO GENERATE CODE DARI NAME
        // =========================
        $baseCode = strtoupper(
            Str::of($data['name'])
                ->replace(['&', '-'], ' ')
                ->slug('_')
        );

        // Pastikan code unik
        $code = $baseCode;
        $counter = 1;

        while (
            KategoriAset::where('code', $code)
                ->when($data['id'] ?? null, fn ($q) => $q->where('id', '!=', $data['id']))
                ->exists()
        ) {
            $code = $baseCode . '_' . $counter++;
        }

        if (!empty($data['id'])) {
            // Update
            $category = KategoriAset::findOrFail($data['id']);
            $category->update([
                'name'        => $data['name'],
                'code'        => $code,
                'description' => $data['description'],
            ]);
            $message = 'Kategori berhasil diperbarui';
        } else {
            // Create
            KategoriAset::create([
                'name'        => $data['name'],
                'code'        => $code,
                'description' => $data['description'],
            ]);
            $message = 'Kategori berhasil ditambahkan';
        }

        return redirect()->route('kategori-aset.index')->with('success', $message);
    }

    // Ambil data single kategori (edit via AJAX)
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

        return redirect()->route('kategori-aset.index')->with('success', 'Kategori berhasil dihapus');
    }
}
