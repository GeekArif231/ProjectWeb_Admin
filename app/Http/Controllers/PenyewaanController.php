<?php

namespace App\Http\Controllers;

use App\Models\Penyewaan;
use App\Models\Riwayat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class PenyewaanController extends Controller
{
    public function pending()
    {
        // Mengambil data penyewaan dengan status 'pending'
        $penyewaan = Penyewaan::with(['gedung', 'user'])
            ->where('confirmed_status', 'pending')
            ->get();

        return view('penyewaan.pending', compact('penyewaan'));
    }

    public function updateStatus(Request $request)
    {
        $penyewaan = Penyewaan::findOrFail($request->id);
    $penyewaan->confirmed_status = $request->status;
    $penyewaan->save();

    // Menambahkan ke riwayat setelah status diperbarui
    Riwayat::create([
        'penyewaan_id' => $penyewaan->id,
        'total_harga_sewa' => $this->hitungHargaSewa($penyewaan)
    ]);

    return response()->json(['success' => 'Status berhasil diperbarui!']);
        // $request->validate([
        //     'id' => 'required|exists:penyewaan,id',
        //     'status' => 'required|in:confirmed,rejected',
        // ]);

        // // Update status penyewaan
        // $penyewaan = Penyewaan::find($request->id);
        // $penyewaan->confirmed_status = $request->status;
        // $penyewaan->save();

        // $message = $request->status === 'confirmed' ? 'Penyewaan berhasil dikonfirmasi.' : 'Penyewaan berhasil dibatalkan.';
        // return back()->with('success', $message);
    }

    private function hitungHargaSewa($penyewaan)
    {
        // Hitung total harga sewa berdasarkan tanggal dan harga gedung
        $start = new \Carbon\Carbon($penyewaan->tanggal_mulai);
        $end = new \Carbon\Carbon($penyewaan->tanggal_selesai);
        $hari = $start->diffInDays($end);

        $harga = $penyewaan->user->user_type == 'internal' ? $penyewaan->gedung->harga_internal : $penyewaan->gedung->harga_eksternal;
        return $harga * ($hari + 1);
    }
}
