<?php

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Controller;
use App\Models\Aset;

class DashboardController extends Controller
{
    public function index()
    {
        // Total aset
        $totalAset = Aset::count();

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
            ->select('name', 'purchase_date')
            ->limit(5)
            ->get();

        return view('pegawai.dashboard', compact(
            'totalAset',
            'baik',
            'rusakRingan',
            'rusakBerat',
            'persenBaik',
            'persenRusakRingan',
            'persenRusakBerat',
            'asetTerbaru'
        ));
    }
}
