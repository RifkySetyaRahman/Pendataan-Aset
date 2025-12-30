<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KondisiAset;

class KondisiAsetController extends Controller
{
    // Menampilkan semua data
    public function index()
    {
        $conditions = KondisiAset::orderBy('name')->get();
        return view('admin.kondisi-aset.index', compact('conditions'));
    }

    // Ambil data single kondisi untuk modal edit via AJAX
    public function edit($id)
    {
        $condition = KondisiAset::findOrFail($id);
        return response()->json($condition);
    }

    // Simpan data baru atau update data lama
    public function store(Request $request)
    {
        $data = $request->validate([
            'id' => 'nullable|exists:kondisi_aset,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        if (!empty($data['id'])) {
            // Update
            $condition = KondisiAset::findOrFail($data['id']);
            $condition->update([
                'name' => $data['name'],
                'description' => $data['description'] ?? null,
            ]);
            $message = 'Kondisi berhasil diperbarui';
        } else {
            // Create
            KondisiAset::create([
                'name' => $data['name'],
                'description' => $data['description'] ?? null,
            ]);
            $message = 'Kondisi berhasil ditambahkan';
        }

        return redirect()->route('kondisi-aset.index')->with('success', $message);
    }

    // Hapus data
    public function destroy($id)
    {
        $condition = KondisiAset::findOrFail($id);
        $condition->delete();

        return redirect()->route('kondisi-aset.index')->with('success', 'Kondisi berhasil dihapus');
    }
}
