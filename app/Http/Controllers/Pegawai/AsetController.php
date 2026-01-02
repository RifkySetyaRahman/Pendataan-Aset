<?php
namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Controller;
use App\Models\Aset;
use App\Models\KategoriAset;
use Illuminate\Http\Request;

class AsetController extends Controller
{
    /**
     * ASET TERPAKAI
     */
    public function used(Request $request)
    {
        // ========================
        // QUERY DASAR
        // ========================
        $query = Aset::with(['kategori', 'kondisi'])
            ->where('status', 'terpakai');

        // ========================
        // FILTER
        // ========================
        if ($request->filled('category')) {
            $query->where('category_code', $request->category);
        }

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // ========================
        // DATA TABEL
        // ========================
        $asets = $query->latest()->paginate(8)->withQueryString();

        // ========================
        // STATISTIK
        // ========================
        $totalTerpakai = Aset::where('status', 'terpakai')->sum('quantity');

        $terpakaiBulanIni = Aset::where('status', 'terpakai')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('quantity');

        $kondisiBaik = Aset::where('status', 'terpakai')
            ->where('condition_code', 'baik')
            ->sum('quantity');

        $kondisiRusakRingan = Aset::where('status', 'terpakai')
            ->where('condition_code', 'rusak_ringan')
            ->sum('quantity');

        $kondisiRusakBerat = Aset::where('status', 'terpakai')
            ->where('condition_code', 'rusak_berat')
            ->sum('quantity');

        $persenBaik = $totalTerpakai ? round(($kondisiBaik / $totalTerpakai) * 100) : 0;
        $persenRusakRingan = $totalTerpakai ? round(($kondisiRusakRingan / $totalTerpakai) * 100) : 0;
        $persenRusakBerat = $totalTerpakai ? round(($kondisiRusakBerat / $totalTerpakai) * 100) : 0;

        // ========================
        // MASTER DATA
        // ========================
        $categories = KategoriAset::orderBy('name')->get();

        return view('pegawai.aset.used', compact(
            'asets',
            'categories',
            'totalTerpakai',
            'terpakaiBulanIni',
            'kondisiBaik',
            'kondisiRusakRingan',
            'kondisiRusakBerat',
            'persenBaik',
            'persenRusakRingan',
            'persenRusakBerat'
        ));
    }
}
