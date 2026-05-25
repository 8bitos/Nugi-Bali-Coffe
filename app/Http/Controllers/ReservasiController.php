<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;
use App\Models\Meja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $status = $request->string('status')->toString();
        $q = trim((string) $request->get('q', ''));
        $tanggal = $request->string('tanggal')->toString();

        $baseQuery = Reservasi::query()->with(['user', 'meja']);

        $allowedStatus = ['pending', 'approved', 'rejected', 'completed', 'cancelled'];
        if (in_array($status, $allowedStatus, true)) {
            $baseQuery->where('status', $status);
        }

        if ($tanggal !== '') {
            $baseQuery->whereDate('tanggal_reservasi', $tanggal);
        }

        if ($q !== '') {
            $baseQuery->where(function ($qb) use ($q) {
                $qb->where('nama_pemesan', 'like', '%' . $q . '%')
                    ->orWhere('kontak_pemesan', 'like', '%' . $q . '%')
                    ->orWhereHas('meja', function ($mq) use ($q) {
                        $mq->where('nomor_meja', 'like', '%' . $q . '%');
                    });
            });
        }

        $reservasi = $baseQuery->latest()->paginate(15)->withQueryString();

        $counts = [
            'total' => Reservasi::count(),
            'pending' => Reservasi::where('status', 'pending')->count(),
            'approved' => Reservasi::where('status', 'approved')->count(),
            'completed' => Reservasi::where('status', 'completed')->count(),
            'rejected' => Reservasi::where('status', 'rejected')->count(),
            'cancelled' => Reservasi::where('status', 'cancelled')->count(),
        ];

        return view('admin.reservasi.index', compact('reservasi', 'counts', 'status', 'q', 'tanggal'));
    }

    /**
     * Show step 1: Select table and booking details
     */
    public function step1()
    {
        // Clear session from previous attempt
        session()->forget(['reservasi_temp']);
        
        $meja = Meja::where('status', 'tersedia')->get();
        return view('reservasi.step1', compact('meja'));
    }

    /**
     * Show step 2: Customer information
     */
    public function step2(Request $request)
    {
        $validated = $request->validate([
            'meja_id' => 'required|exists:meja,id',
            'tanggal_reservasi' => 'required|date|after:today',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'jumlah_orang' => 'required|integer|min:1',
        ]);

        $meja = Meja::findOrFail($validated['meja_id']);
        
        // Validate capacity
        if ($validated['jumlah_orang'] > $meja->kapasitas) {
            return back()->withErrors(['jumlah_orang' => 'Jumlah orang melebihi kapasitas meja']);
        }

        // Store in session
        session(['reservasi_temp' => $validated]);

        return view('reservasi.step2');
    }

    /**
     * Show step 3: Confirmation
     */
    public function step3(Request $request)
    {
        $temp = session('reservasi_temp');
        if (!$temp) {
            return redirect()->route('reservasi.step1')->with('error', 'Data reservasi tidak valid');
        }

        $validated = $request->validate([
            'nama_pemesan' => 'required|string|max:255',
            'kontak_pemesan' => 'required|string|max:20',
            'catatan' => 'nullable|string',
        ]);

        // Merge with temp data
        $reservasiData = array_merge($temp, $validated);
        session(['reservasi_temp' => $reservasiData]);

        $meja = Meja::findOrFail($temp['meja_id']);
        
        return view('reservasi.step3', [
            'reservasi' => $reservasiData,
            'meja' => $meja
        ]);
    }

    /**
     * Show step 4: Payment method
     */
    public function step4(Request $request)
    {
        $temp = session('reservasi_temp');
        if (!$temp) {
            return redirect()->route('reservasi.step1')->with('error', 'Data reservasi tidak valid');
        }

        $meja = Meja::findOrFail($temp['meja_id']);
        
        return view('reservasi.step4', [
            'reservasi' => $temp,
            'meja' => $meja
        ]);
    }

    /**
     * Process payment and create reservation
     */
    public function payment(Request $request)
    {
        $temp = session('reservasi_temp');
        if (!$temp) {
            return redirect()->route('reservasi.step1')->with('error', 'Data reservasi tidak valid');
        }

        $validated = $request->validate([
            'payment_method' => 'required|in:transfer_bank,card,ewallet',
            'terms_accepted' => 'required|accepted',
        ]);

        // Create reservation with 'approved' status (payment confirmed)
        $reservasi = Reservasi::create([
            'user_id' => Auth::id(),
            'meja_id' => $temp['meja_id'],
            'nama_pemesan' => $temp['nama_pemesan'],
            'kontak_pemesan' => $temp['kontak_pemesan'],
            'tanggal_reservasi' => $temp['tanggal_reservasi'],
            'jam_reservasi' => $temp['jam_mulai'],
            'jam_selesai' => $temp['jam_selesai'],
            'jumlah_orang' => $temp['jumlah_orang'],
            'catatan' => $temp['catatan'] ?? null,
            'status' => 'approved', // Changed from 'pending' to 'approved'
        ]);

        // TODO: Store payment method for reference
        // $reservasi->payment_method = $validated['payment_method'];
        // $reservasi->save();

        // Clear session
        session()->forget(['reservasi_temp']);

        return redirect()->route('reservasi.success', $reservasi->id)->with('success', 'Reservasi dan pembayaran berhasil diproses');
    }

    /**
     * Confirm and store reservation (DEPRECATED - use payment instead)
     */
    public function confirm(Request $request)
    {
        return redirect()->route('reservasi.step1')->with('error', 'Silakan lanjut ke pembayaran');
    }

    /**
     * Show success page
     */
    public function success(string $id)
    {
        $reservasi = Reservasi::with('meja')->findOrFail($id);
        $meja = $reservasi->meja;
        return view('reservasi.success', compact('reservasi', 'meja'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $meja = Meja::where('status', 'tersedia')->get();
        return view('reservasi.create', compact('meja'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'meja_id' => 'required|exists:meja,id',
            'nama_pemesan' => 'required|string|max:255',
            'kontak_pemesan' => 'required|string|max:20',
            'tanggal_reservasi' => 'required|date|after:today',
            'jam_reservasi' => 'required|date_format:H:i',
            'jumlah_orang' => 'required|integer|min:1',
            'catatan' => 'nullable|string',
        ]);

        $meja = Meja::findOrFail($validated['meja_id']);
        
        // Validate capacity
        if ($validated['jumlah_orang'] > $meja->kapasitas) {
            return back()->withErrors(['jumlah_orang' => 'Jumlah orang melebihi kapasitas meja']);
        }

        $validated['user_id'] = Auth::id();
        $validated['status'] = 'pending';

        Reservasi::create($validated);
        return redirect()->route('home')->with('success', 'Reservasi berhasil dibuat. Tunggu konfirmasi admin.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $reservasi = Reservasi::with('user', 'meja')->findOrFail($id);
        return view('admin.reservasi.show', compact('reservasi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $reservasi = Reservasi::findOrFail($id);
        $meja = Meja::all();
        return view('admin.reservasi.edit', compact('reservasi', 'meja'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $reservasi = Reservasi::findOrFail($id);

        $validated = $request->validate([
            'meja_id' => 'sometimes|exists:meja,id',
            'status' => 'sometimes|in:pending,approved,rejected,completed,cancelled',
            'catatan' => 'nullable|string',
        ]);

        $reservasi->update($validated);
        return redirect()->route('admin.reservasi.index')->with('success', 'Reservasi berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $reservasi = Reservasi::findOrFail($id);
        $reservasi->delete();
        return redirect()->route('admin.reservasi.index')->with('success', 'Reservasi berhasil dihapus');
    }

    /**
     * Approve a reservation
     */
    public function approve(string $id)
    {
        $reservasi = Reservasi::findOrFail($id);
        $reservasi->update(['status' => 'approved']);
        return back()->with('success', 'Reservasi disetujui');
    }

    /**
     * Reject a reservation
     */
    public function reject(string $id)
    {
        $reservasi = Reservasi::findOrFail($id);
        $reservasi->update(['status' => 'rejected']);
        return back()->with('success', 'Reservasi ditolak');
    }

    /**
     * Complete a reservation
     */
    public function complete(string $id)
    {
        $reservasi = Reservasi::findOrFail($id);
        $reservasi->update(['status' => 'completed']);
        return back()->with('success', 'Reservasi selesai');
    }
}
