<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Aset;
use App\Models\KategoriAset;
use App\Models\KondisiAset;
use Carbon\Carbon;

class ManajemenAsetController extends Controller
{
    /**
     * INDEX - SEMUA ASET (BARU, BEKAS, TERPAKAI)
     * untuk halaman: manajemen-aset.index
     */
    public function index()
    {
        // =========================
        // DATA TABEL (PAGINATION)
        // =========================
        $aset = Aset::orderBy('created_at', 'desc')
            ->paginate(8);

        // =========================
        // TOTAL ASET TERPAKAI
        // =========================
        $totalTerpakai = Aset::where('status', 'terpakai')
            ->sum('quantity');

        // TERPAKAI BULAN INI
        $terpakaiBulanIni = Aset::where('status', 'terpakai')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('quantity');

        // =========================
        // KONDISI ASET TERPAKAI
        // =========================
        $baik = Aset::where('status', 'terpakai')
            ->where('condition_code', 'baik')
            ->sum('quantity');

        $rusakRingan = Aset::where('status', 'terpakai')
            ->where('condition_code', 'rusak_ringan')
            ->sum('quantity');

        $rusakBerat = Aset::where('status', 'terpakai')
            ->where('condition_code', 'rusak_berat')
            ->sum('quantity');

        // =========================
        // PERSENTASE KONDISI
        // =========================
        $persenBaik = $totalTerpakai
            ? round(($baik / $totalTerpakai) * 100)
            : 0;

        $persenRusakRingan = $totalTerpakai
            ? round(($rusakRingan / $totalTerpakai) * 100)
            : 0;

        $persenRusakBerat = $totalTerpakai
            ? round(($rusakBerat / $totalTerpakai) * 100)
            : 0;

        return view('manajemen-aset.index', compact(
            'aset',
            'totalTerpakai',
            'terpakaiBulanIni',
            'baik',
            'rusakRingan',
            'rusakBerat',
            'persenBaik',
            'persenRusakRingan',
            'persenRusakBerat'
        ));
    }

    /**
     * DAFTAR ASET BARU
     */
    public function asetBaru()
    {
        $asetBaru = Aset::where('status', 'baru')
            ->orderBy('created_at', 'desc')
            ->paginate(8);

        $totalAset = $asetBaru->sum('quantity');

        $asetBaruBulanIni = Aset::where('status', 'baru')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('quantity');

        $baik   = $asetBaru->where('condition_code', 'baik')->sum('quantity');
        $cukup  = $asetBaru->where('condition_code', 'cukup')->sum('quantity');
        $rusak  = $asetBaru->where('condition_code', 'rusak')->sum('quantity');

        $persenBaik  = $totalAset ? round(($baik / $totalAset) * 100) : 0;
        $persenCukup = $totalAset ? round(($cukup / $totalAset) * 100) : 0;
        $persenRusak = $totalAset ? round(($rusak / $totalAset) * 100) : 0;

        return view('manajemen-aset.aset-baru', compact(
            'asetBaru',
            'totalAset',
            'asetBaruBulanIni',
            'baik',
            'cukup',
            'rusak',
            'persenBaik',
            'persenCukup',
            'persenRusak'
        ));
    }

    /**
     * FORM INPUT ASET BARU
     */
    public function create()
    {
        return view('admin.manajemen-aset.input', [
            'categories' => KategoriAset::orderBy('name')->get(),
            'conditions' => KondisiAset::orderBy('name')->get(),
        ]);
    }

    /**
     * SIMPAN DATA ASET BARU
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'            => 'required|string|min:3',
            'serialnumber'    => 'required|string|min:3|unique:aset,serialnumber',
            'location'        => 'required|string|min:3',
            'purchase_date'   => 'nullable|date',
            'category_code'   => 'required|exists:kategori_aset,code',
            'condition_code'  => 'required|exists:kondisi_aset,code',
            'description'     => 'nullable|string',
            'status'          => 'required|in:baru,bekas,terpakai',
            'quantity'        => 'required|integer|min:1',
        ]);

        Aset::create($validated);

        return redirect()
            ->route('manajemen-aset.aset-baru')
            ->with('success', 'Aset berhasil ditambahkan');
    }

/**
 * FORM EDIT ASET
 */
public function edit($id)
{
    // Cari aset berdasarkan ID
    $aset = Aset::findOrFail($id);

    // Ambil data kategori dan kondisi untuk select option
    $categories = KategoriAset::orderBy('name')->get();
    $conditions = KondisiAset::orderBy('name')->get();

    // Kirim data ke view
    return view('admin.manajemen-aset.update', compact(
        'aset',
        'categories',
        'conditions'
    ));
}

    /**
 * UPDATE DATA ASET
 */
public function update(Request $request, $id)
{
    // Cari aset berdasarkan ID
    $aset = Aset::findOrFail($id);

    // Validasi input
    $validated = $request->validate([
        'name'            => 'required|string|min:3',
        'serialnumber'    => 'required|string|min:3|unique:aset,serialnumber,' . $aset->id,
        'location'        => 'required|string|min:3',
        'purchase_date'   => 'nullable|date',
        'category_code'   => 'required|exists:kategori_aset,code',
        'condition_code'  => 'required|exists:kondisi_aset,code',
        'description'     => 'nullable|string',
        'status'          => 'required|in:baru,bekas,terpakai',
        'quantity'        => 'required|integer|min:1',
    ]);

    // Update data aset
    $aset->update($validated);

    return redirect()
        ->route('manajemen-aset.index')
        ->with('success', 'Data aset berhasil diperbarui');
}

    /**
 * HAPUS DATA ASET
 */
public function destroy($id)
{
    // Cari aset berdasarkan ID
    $aset = Aset::findOrFail($id);

    // Hapus data
    $aset->delete();

    return redirect()
        ->route('manajemen-aset.index')
        ->with('success', 'Data aset berhasil dihapus');
}

}
