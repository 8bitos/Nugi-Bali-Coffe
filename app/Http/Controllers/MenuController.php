<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\MenuKategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menus = Menu::orderBy('position', 'asc')->get();
        $kategori = MenuKategori::orderBy('nama')->get();
        return view('admin.menu.index', compact('menus', 'kategori'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori = MenuKategori::orderBy('nama')->get();
        return view('admin.menu.create', compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_menu' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('menu', 'public');
        }

        // Set position to max + 1
        $maxPosition = Menu::where('kategori', $validated['kategori'])->max('position') ?? 0;
        $validated['position'] = $maxPosition + 1;

        Menu::create($validated);
        return redirect()->route('admin.menu.index')->with('success', 'Menu berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return redirect()->route('admin.menu.edit', $id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $menu = Menu::findOrFail($id);
        $kategori = MenuKategori::orderBy('nama')->get();
        return view('admin.menu.edit', compact('menu', 'kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $menu = Menu::findOrFail($id);

        $validated = $request->validate([
            'nama_menu' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            if ($menu->foto) {
                Storage::disk('public')->delete($menu->foto);
            }
            $validated['foto'] = $request->file('foto')->store('menu', 'public');
        }

        $menu->update($validated);
        return redirect()->route('admin.menu.index')->with('success', 'Menu berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $menu = Menu::findOrFail($id);
        if ($menu->foto) {
            Storage::disk('public')->delete($menu->foto);
        }
        $menu->delete();
        return redirect()->route('admin.menu.index')->with('success', 'Menu berhasil dihapus');
    }

    /**
     * Reorder menu items via AJAX
     */
    public function reorder(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:menu,id',
            'direction' => 'required|in:up,down',
        ]);

        $item = Menu::findOrFail($request->id);
        $direction = $request->direction;

        // Find the adjacent item in the same category
        if ($direction === 'up') {
            $adjacent = Menu::where('kategori', $item->kategori)
                ->where('position', '<', $item->position)
                ->orderBy('position', 'desc')
                ->first();
        } else {
            $adjacent = Menu::where('kategori', $item->kategori)
                ->where('position', '>', $item->position)
                ->orderBy('position', 'asc')
                ->first();
        }

        if ($adjacent) {
            // Swap positions
            $temp = $item->position;
            $item->update(['position' => $adjacent->position]);
            $adjacent->update(['position' => $temp]);

            return response()->json([
                'success' => true,
                'message' => 'Susunan menu berhasil diubah',
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Menu sudah berada di posisi paling ' . ($direction === 'up' ? 'atas' : 'bawah'),
        ]);
    }
}
