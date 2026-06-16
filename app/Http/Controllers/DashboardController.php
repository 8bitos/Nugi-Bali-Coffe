<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;
use App\Models\Menu;
use App\Models\Meja;
use App\Models\Galeri;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\ReservasiExport;
use Maatwebsite\Excel\Facades\Excel;

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
        $mejaTersedia = Meja::where('status', 'tersedia')->count();
        $mejaTerisi = Meja::where('status', 'terisi')->count();
        $approvedToday = Reservasi::where('status', 'approved')
            ->whereDate('tanggal_reservasi', today())
            ->count();
        
        $recentReservasi = Reservasi::with('user', 'meja')
            ->latest()
            ->take(10)
            ->get();

        // Chart Data: Reservasi per bulan (12 bulan terakhir)
        $reservasiPerBulan = Reservasi::select(
                DB::raw("DATE_FORMAT(created_at, '%Y-%m') as bulan"),
                DB::raw('COUNT(*) as total')
            )
            ->where('created_at', '>=', now()->subMonths(12))
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        // Fill missing months with 0
        $chartBulanLabels = [];
        $chartBulanData = [];
        for ($i = 11; $i >= 0; $i--) {
            $month = now()->subMonths($i);
            $key = $month->format('Y-m');
            $chartBulanLabels[] = $month->translatedFormat('M Y');
            $found = $reservasiPerBulan->firstWhere('bulan', $key);
            $chartBulanData[] = $found ? $found->total : 0;
        }

        // Chart Data: Status reservasi
        $statusData = Reservasi::select('status', DB::raw('COUNT(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status')
            ->toArray();

        $chartStatusLabels = ['Pending', 'Approved', 'Rejected', 'Completed', 'Cancelled'];
        $chartStatusData = [
            $statusData['pending'] ?? 0,
            $statusData['approved'] ?? 0,
            $statusData['rejected'] ?? 0,
            $statusData['completed'] ?? 0,
            $statusData['cancelled'] ?? 0,
        ];

        // Chart Data: Pendapatan per bulan (dari harga meja)
        $pendapatanPerBulan = Reservasi::join('meja', 'reservasi.meja_id', '=', 'meja.id')
            ->select(
                DB::raw("DATE_FORMAT(reservasi.created_at, '%Y-%m') as bulan"),
                DB::raw('SUM(meja.harga) as total')
            )
            ->whereIn('reservasi.status', ['approved', 'completed'])
            ->where('reservasi.created_at', '>=', now()->subMonths(12))
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        $chartPendapatanData = [];
        for ($i = 11; $i >= 0; $i--) {
            $key = now()->subMonths($i)->format('Y-m');
            $found = $pendapatanPerBulan->firstWhere('bulan', $key);
            $chartPendapatanData[] = $found ? (float) $found->total : 0;
        }

        // Chart Data: Top 5 meja populer
        $mejaPopuler = Reservasi::join('meja', 'reservasi.meja_id', '=', 'meja.id')
            ->select('meja.nomor_meja', DB::raw('COUNT(*) as total'))
            ->groupBy('meja.nomor_meja')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        $chartMejaLabels = $mejaPopuler->pluck('nomor_meja')->map(fn($v) => 'Meja ' . $v)->toArray();
        $chartMejaData = $mejaPopuler->pluck('total')->toArray();

        return view('admin.dashboard', compact(
            'totalReservasi',
            'reservasiPending',
            'totalMenu',
            'totalMeja',
            'totalGaleri',
            'totalPelanggan',
            'mejaTersedia',
            'mejaTerisi',
            'approvedToday',
            'recentReservasi',
            'chartBulanLabels',
            'chartBulanData',
            'chartStatusLabels',
            'chartStatusData',
            'chartPendapatanData',
            'chartMejaLabels',
            'chartMejaData'
        ));
    }

    /**
     * Show reservation report
     */
    public function reservasiReport()
    {
        $reservasi = Reservasi::with('user', 'meja')->latest()->get();
        $info = \App\Models\InformasiWeb::first();
        return view('admin.reservasi.report', compact('reservasi', 'info'));
    }

    /**
     * Show export page with filters
     */
    public function exportPage(Request $request)
    {
        $status = $request->string('status')->toString();
        $dariTanggal = $request->string('dari_tanggal')->toString();
        $sampaiTanggal = $request->string('sampai_tanggal')->toString();

        $query = Reservasi::with('user', 'meja');

        $allowedStatus = ['pending', 'approved', 'rejected', 'completed', 'cancelled'];
        if (in_array($status, $allowedStatus, true)) {
            $query->where('status', $status);
        }
        if ($dariTanggal) {
            $query->whereDate('tanggal_reservasi', '>=', $dariTanggal);
        }
        if ($sampaiTanggal) {
            $query->whereDate('tanggal_reservasi', '<=', $sampaiTanggal);
        }

        $reservasi = $query->latest()->get();

        return view('admin.reservasi.export', compact('reservasi', 'status', 'dariTanggal', 'sampaiTanggal'));
    }

    /**
     * Download export as PDF or Excel
     */
    public function exportDownload(Request $request)
    {
        $format = $request->input('format', 'pdf');
        $status = $request->string('status')->toString();
        $dariTanggal = $request->string('dari_tanggal')->toString();
        $sampaiTanggal = $request->string('sampai_tanggal')->toString();

        $query = Reservasi::with('user', 'meja');

        $allowedStatus = ['pending', 'approved', 'rejected', 'completed', 'cancelled'];
        if (in_array($status, $allowedStatus, true)) {
            $query->where('status', $status);
        }
        if ($dariTanggal) {
            $query->whereDate('tanggal_reservasi', '>=', $dariTanggal);
        }
        if ($sampaiTanggal) {
            $query->whereDate('tanggal_reservasi', '<=', $sampaiTanggal);
        }

        $reservasi = $query->latest()->get();
        $filename = 'laporan-reservasi-' . now()->format('Y-m-d');

        if ($format === 'excel') {
            return Excel::download(
                new ReservasiExport($reservasi),
                $filename . '.xlsx'
            );
        }

        // Default: PDF
        $info = \App\Models\InformasiWeb::first();
        $pdf = Pdf::loadView('admin.reservasi.pdf', compact('reservasi', 'status', 'dariTanggal', 'sampaiTanggal', 'info'));
        $pdf->setPaper('a4', 'landscape');
        return $pdf->download($filename . '.pdf');
    }
}
