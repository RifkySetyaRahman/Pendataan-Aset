<?php

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Controller;
use App\Models\Aset;

class AsetController extends Controller
{
    /**
     * Aset dengan status DIPAKAI
     */
    public function used()
    {
        $asets = Aset::where('status', 'dipakai')
            ->latest()
            ->get();

        return view('pegawai.aset.used', compact('asets'));
    }

    /**
     * Aset dengan status BARU
     */
    public function new()
    {
        $asets = Aset::where('status', 'baru')
            ->latest()
            ->get();

        return view('pegawai.aset.new', compact('asets'));
    }
}
