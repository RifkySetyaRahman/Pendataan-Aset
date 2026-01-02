<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KondisiAset;
use Illuminate\Support\Str;

class KondisiAsetController extends Controller
{
    public function index()
    {
        $conditions = KondisiAset::orderBy('name')->get();
        return view('admin.master-data.kondisi', compact('conditions'));
    }

    public function edit($id)
    {
        $condition = KondisiAset::findOrFail($id);
        return response()->json($condition);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'id' => 'nullable|exists:kondisi_aset,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        // =========================
        // AUTO GENERATE CODE
        // =========================
        $code = strtoupper(Str::slug($data['name'], '_'));

        // Cegah duplikasi code
        $exists = KondisiAset::where('code', $code)
            ->when($data['id'] ?? null, fn ($q) => $q->where('id', '!=', $data['id']))
            ->exists();

        if ($exists) {
            return back()->withErrors([
                'name' => 'Nama kondisi menghasilkan kode yang sudah ada.'
            ])->withInput();
        }

        KondisiAset::updateOrCreate(
            ['id' => $data['id'] ?? null],
            [
                'code' => $code,
                'name' => $data['name'],
                'description' => $data['description'] ?? null,
            ]
        );

        return redirect()
            ->route('kondisi-aset.index')
            ->with('success', empty($data['id'])
                ? 'Kondisi berhasil ditambahkan'
                : 'Kondisi berhasil diperbarui'
            );
    }

    public function destroy($id)
    {
        KondisiAset::findOrFail($id)->delete();

        return redirect()
            ->route('kondisi-aset.index')
            ->with('success', 'Kondisi berhasil dihapus');
    }
}
