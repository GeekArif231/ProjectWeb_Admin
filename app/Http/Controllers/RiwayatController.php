<?php

namespace App\Http\Controllers;

use App\Models\Riwayat;
use Illuminate\Http\Request;

class RiwayatController extends Controller
{
    public function index()
    {
        $riwayats = Riwayat::whereHas('penyewaan', function ($query) {
            $query->whereIn('confirmed_status', ['confirmed', 'rejected']);
        })->with(['penyewaan.gedung', 'penyewaan.user'])->get();
    
        return view('riwayat.index', compact('riwayats'));
    }
}
