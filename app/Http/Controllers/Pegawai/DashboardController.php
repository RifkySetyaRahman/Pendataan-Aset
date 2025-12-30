<?php

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Controller;
use App\Models\Aset;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Total aset
        $totalAset = Aset::count();
// Aset bulan ini
$asetBulanIni = Aset::whereMonth('purchase_date', Carbon::now()->month)
    ->whereYear('purchase_date', Carbon::now()->year)
    ->count();

// Aset bulan lalu
$asetBulanLalu = Aset::whereMonth('purchase_date', Carbon::now()->subMonth()->month)
    ->whereYear('purchase_date', Carbon::now()->subMonth()->year)
    ->count();

// Selisih pertambahan
$selisihAset = $asetBulanIni - $asetBulanLalu;

        // Jumlah aset berdasarkan kondisi
        $baik = Aset::where('condition_code', 'BAIK')->count();
        $rusakRingan = Aset::where('condition_code', 'RUSAK_RINGAN')->count();
        $rusakBerat = Aset::where('condition_code', 'RUSAK_BERAT')->count();

        // Hindari pembagian nol
        $total = max($totalAset, 1);

        // Persentase kondisi
        $persenBaik = round(($baik / $total) * 100, 1);
        $persenRusakRingan = round(($rusakRingan / $total) * 100, 1);
        $persenRusakBerat = round(($rusakBerat / $total) * 100, 1);

        // Aset terbaru (berdasarkan tanggal didapat)
        $asetTerbaru = Aset::orderBy('purchase_date', 'desc')
    ->paginate(5); // 5 aset per halaman


        return view('pegawai.dashboard', compact(
    'totalAset',
    'baik',
    'rusakRingan',
    'rusakBerat',
    'persenBaik',
    'persenRusakRingan',
    'persenRusakBerat',
    'asetTerbaru',
    'asetBulanIni',
    'asetBulanLalu',
    'selisihAset'
));
    }
}
