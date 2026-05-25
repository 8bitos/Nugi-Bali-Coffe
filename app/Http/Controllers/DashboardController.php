<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;
use App\Models\Menu;
use App\Models\Meja;
use App\Models\Galeri;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Show admin dashboard
     */
    public function index()
    {
        $totalReservasi = Reservasi::count();
        $reservasiPending = Reservasi::where('status', 'pending')->count();
        $totalMenu = Menu::count();
        $totalMeja = Meja::count();
        $totalGaleri = Galeri::count();
        $totalPelanggan = User::where('role', 'pelanggan')->count();
        
        $recentReservasi = Reservasi::with('user', 'meja')
            ->latest()
            ->take(10)
            ->get();

        return view('admin.dashboard', compact(
            'totalReservasi',
            'reservasiPending',
            'totalMenu',
            'totalMeja',
            'totalGaleri',
            'totalPelanggan',
            'recentReservasi'
        ));
    }

    /**
     * Show reservation report
     */
    public function reservasiReport()
    {
        $reservasi = Reservasi::with('user', 'meja')->latest()->get();
        return view('admin.reservasi.report', compact('reservasi'));
    }

    /**
     * Export reservation report to PDF or Excel
     */
    public function exportReservasi(Request $request)
    {
        $reservasi = Reservasi::with('user', 'meja')
            ->when($request->status, fn($q) => $q->where('status', $request->status))
            ->latest()
            ->get();

        return view('admin.reservasi.export', compact('reservasi'));
    }
}
