<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PelangganController extends Controller
{
    /**
     * Show customer dashboard
     */
    public function dashboard()
    {
        $user = Auth::user();
        
        $totalReservasi = Reservasi::where('user_id', $user->id)->count();
        $reservasiAktif = Reservasi::where('user_id', $user->id)
            ->whereIn('status', ['pending', 'approved'])
            ->count();
        $reservasiSelesai = Reservasi::where('user_id', $user->id)
            ->where('status', 'completed')
            ->count();
        $reservasiDibatalkan = Reservasi::where('user_id', $user->id)
            ->whereIn('status', ['cancelled', 'rejected'])
            ->count();
        
        $recentReservasi = Reservasi::with('meja')
            ->where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        return view('pelanggan.dashboard', compact(
            'totalReservasi',
            'reservasiAktif',
            'reservasiSelesai',
            'reservasiDibatalkan',
            'recentReservasi'
        ));
    }

    /**
     * Show all customer reservations
     */
    public function reservasi(Request $request)
    {
        $user = Auth::user();
        $status = $request->string('status')->toString();

        $query = Reservasi::with('meja')
            ->where('user_id', $user->id);

        $allowedStatus = ['pending', 'approved', 'rejected', 'completed', 'cancelled'];
        if (in_array($status, $allowedStatus, true)) {
            $query->where('status', $status);
        }

        $reservasi = $query->latest()->paginate(10)->withQueryString();

        $counts = [
            'total' => Reservasi::where('user_id', $user->id)->count(),
            'pending' => Reservasi::where('user_id', $user->id)->where('status', 'pending')->count(),
            'approved' => Reservasi::where('user_id', $user->id)->where('status', 'approved')->count(),
            'completed' => Reservasi::where('user_id', $user->id)->where('status', 'completed')->count(),
            'cancelled' => Reservasi::where('user_id', $user->id)->whereIn('status', ['cancelled', 'rejected'])->count(),
        ];

        return view('pelanggan.reservasi', compact('reservasi', 'counts', 'status'));
    }

    /**
     * Cancel a reservation
     */
    public function cancelReservasi(string $id)
    {
        $user = Auth::user();
        $reservasi = Reservasi::where('user_id', $user->id)->findOrFail($id);

        // Only allow cancellation if pending or approved, and date hasn't passed
        if (!in_array($reservasi->status, ['pending', 'approved'])) {
            return back()->with('error', 'Reservasi tidak dapat dibatalkan karena statusnya sudah ' . $reservasi->status);
        }

        if ($reservasi->tanggal_reservasi < now()->toDateString()) {
            return back()->with('error', 'Reservasi tidak dapat dibatalkan karena tanggal sudah lewat');
        }

        $reservasi->update(['status' => 'cancelled']);
        return back()->with('success', 'Reservasi berhasil dibatalkan');
    }
}
