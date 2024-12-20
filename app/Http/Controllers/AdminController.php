<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Gedung;
use App\Models\Penyewaan;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login'); // Buat view ini
    }

    // Proses login admin
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('username', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('admin.dashboard')->with('success', 'Welcome, Admin!');
        }

        return back()->withErrors(['login' => 'Invalid username or password']);
    }


    // Logout admin
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login')->with('success', 'Logged out successfully');
    }

    // Dashboard admin
    public function dashboard()
    {
        $gedungs = Gedung::all(); 
        $totalGedung = Gedung::count();

        // Menghitung jumlah penyewa aktif (penyewaan yang sudah dikonfirmasi)
        $totalPenyewaAktif = Penyewaan::where('confirmed_status', 'confirmed')->count();

        // Menampilkan penyewaan terbaru yang sudah dikonfirmasi
        $penyewaanTerbaru = Penyewaan::with(['gedung', 'user'])
                            ->where('confirmed_status', 'confirmed')
                            ->latest() // Mengambil penyewaan terbaru berdasarkan tanggal
                            ->first();

        $confirmedPerBulan = DB::table('riwayat')
        ->join('penyewaan', 'riwayat.penyewaan_id', '=', 'penyewaan.id')
        ->select(DB::raw('MONTH(penyewaan.tanggal_mulai) as bulan'), DB::raw('COUNT(*) as jumlah'))
        ->where('penyewaan.confirmed_status', 'confirmed')
        ->groupBy('bulan')
        ->orderBy('bulan', 'asc')
        ->pluck('jumlah', 'bulan')
        ->toArray();
    
    $rejectedPerBulan = DB::table('riwayat')
        ->join('penyewaan', 'riwayat.penyewaan_id', '=', 'penyewaan.id')
        ->select(DB::raw('MONTH(penyewaan.tanggal_mulai) as bulan'), DB::raw('COUNT(*) as jumlah'))
        ->where('penyewaan.confirmed_status', 'rejected')
        ->groupBy('bulan')
        ->orderBy('bulan', 'asc')
        ->pluck('jumlah', 'bulan')
        ->toArray();
    
    // Pastikan data bulan yang kosong tetap diisi dengan 0
    $confirmedData = [];
    $rejectedData = [];
    for ($i = 1; $i <= 12; $i++) {
        $confirmedData[] = $confirmedPerBulan[$i] ?? 0;
        $rejectedData[] = $rejectedPerBulan[$i] ?? 0; 
    }
    
    return view('admin.dashboard', compact(
        'gedungs',
        'totalGedung',
        'totalPenyewaAktif',
        'penyewaanTerbaru',
        'confirmedData',
        'rejectedData'  
    ));
    }
}
