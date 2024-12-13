<?php

namespace App\Http\Controllers;

use App\Models\Riwayat;
use Illuminate\Http\Request;

class RiwayatController extends Controller
{
    public function index()
    {
        // $riwayats = Riwayat::with('penyewaan.gedung')->get();  // Memuat relasi gedung
        $riwayats = Riwayat::with(['penyewaan.gedung' => function($query) {
            $query->withTrashed(); // Menyertakan gedung yang dihapus
        }])->get();

        return view('riwayat.index', compact('riwayats'));
        // $riwayat = Riwayat::with('penyewaan.gedung', 'penyewaan.user')->get();
        // return view('riwayat.index', compact('riwayat'));
    }
}
