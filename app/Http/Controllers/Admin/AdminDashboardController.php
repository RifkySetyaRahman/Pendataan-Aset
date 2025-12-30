<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aset;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // =====================
        // TOTAL ASET
        // =====================
        $totalAset = Aset::count();

        // =====================
        // HITUNG BULAN INI & BULAN LALU
        // =====================
        $bulanIni = Carbon::now();
        $bulanLalu = Carbon::now()->subMonth();

        $totalBulanIni = Aset::whereYear('purchase_date', $bulanIni->year)
            ->whereMonth('purchase_date', $bulanIni->month)
            ->count();

        $totalBulanLalu = Aset::whereYear('purchase_date', $bulanLalu->year)
            ->whereMonth('purchase_date', $bulanLalu->month)
            ->count();

        // =====================
        // SELISIH NAIK / TURUN
        // =====================
        $selisihAset = $totalBulanIni - $totalBulanLalu;

        if ($selisihAset > 0) {
            $trenAset = 'naik';
        } elseif ($selisihAset < 0) {
            $trenAset = 'turun';
        } else {
            $trenAset = 'stabil';
        }

        // =====================
        // STATUS ASET
        // =====================
        $asetBaru = Aset::where('status', 'baru')->count();
        $asetTerpakai = Aset::where('status', 'terpakai')->count();

        // =====================
        // KONDISI ASET
        // =====================
        $baik = Aset::where('condition_code', 'baik')->count();
        $rusakRingan = Aset::where('condition_code', 'rusak_ringan')->count();
        $rusakBerat = Aset::where('condition_code', 'rusak_berat')->count();

        $totalKondisi = max($baik + $rusakRingan + $rusakBerat, 1);

        $persenBaik = round(($baik / $totalKondisi) * 100);
        $persenRusakRingan = round(($rusakRingan / $totalKondisi) * 100);
        $persenRusakBerat = round(($rusakBerat / $totalKondisi) * 100);

        // =====================
// ASET RUSAK (RINGAN + BERAT)
// =====================
$asetRusak = $rusakRingan + $rusakBerat;

// =====================
// ASET DIGUNAKAN
// =====================
$asetDigunakan = $asetTerpakai;

// =====================
// PERSENTASE DIGUNAKAN
// =====================
$persenDigunakan = $totalAset > 0
    ? round(($asetDigunakan / $totalAset) * 100)
    : 0;
// =====================
// DONUT CHART (SVG DASH)
// =====================
$radius = 45;
$circumference = 2 * pi() * $radius;

// Hindari pembagian nol
$totalKondisi = max($baik + $rusakRingan + $rusakBerat, 1);

$baikDash = ($baik / $totalKondisi) * $circumference;
$rrDash   = ($rusakRingan / $totalKondisi) * $circumference;
$rbDash   = ($rusakBerat / $totalKondisi) * $circumference;

        // =====================
        // ASET TERBARU
        // =====================
        $asetTerbaru = Aset::with(['kategori', 'kondisi'])
            ->latest('purchase_date')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact(
    'totalAset',
    'totalBulanIni',
    'totalBulanLalu',
    'selisihAset',
    'trenAset',
    'asetBaru',
    'asetTerpakai',
    'asetRusak',
    'asetDigunakan',
    'persenDigunakan',
    'baik',
    'rusakRingan',
    'rusakBerat',
    'persenBaik',
    'persenRusakRingan',
    'persenRusakBerat',
    'asetTerbaru',

    // 🔽 WAJIB untuk chart
    'baikDash',
    'rrDash',
    'rbDash',
    'circumference'
));

    }
}
