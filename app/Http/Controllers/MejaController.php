<?php

namespace App\Http\Controllers;

use App\Models\Meja;
use Illuminate\Http\Request;

class MejaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $meja = Meja::latest()->get();
        return view('admin.meja.index', compact('meja'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.meja.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nomor_meja' => 'required|string|max:255|unique:meja',
            'kapasitas' => 'required|integer|min:1',
            'harga' => 'required|numeric|min:0',
            'status' => 'sometimes|in:tersedia,terisi,maintenance',
        ]);

        Meja::create($validated);
        return redirect()->route('admin.meja.index')->with('success', 'Meja berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return redirect()->route('admin.meja.edit', $id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $meja = Meja::findOrFail($id);
        return view('admin.meja.edit', compact('meja'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $meja = Meja::findOrFail($id);

        $validated = $request->validate([
            'nomor_meja' => 'required|string|max:255|unique:meja,nomor_meja,' . $id,
            'kapasitas' => 'required|integer|min:1',
            'harga' => 'required|numeric|min:0',
            'status' => 'sometimes|in:tersedia,terisi,maintenance',
        ]);

        $meja->update($validated);
        return redirect()->route('admin.meja.index')->with('success', 'Meja berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $meja = Meja::findOrFail($id);
        $meja->delete();
        return redirect()->route('admin.meja.index')->with('success', 'Meja berhasil dihapus');
    }
}
