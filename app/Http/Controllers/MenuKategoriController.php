<?php

namespace App\Http\Controllers;

use App\Models\MenuKategori;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MenuKategoriController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255', Rule::unique('menu_kategori', 'nama')],
        ]);

        $kategori = MenuKategori::create($validated);

        if ($request->expectsJson()) {
            return response()->json([
                'id' => $kategori->id,
                'nama' => $kategori->nama,
            ]);
        }

        return back()->with('success', 'Kategori berhasil ditambahkan');
    }

    public function destroy(Request $request, string $id)
    {
        $kategori = MenuKategori::findOrFail($id);

        $inUse = Menu::where('kategori', $kategori->nama)->exists();
        if ($inUse) {
            $msg = 'Kategori sedang dipakai oleh menu. Ubah kategori menu dulu sebelum menghapus.';
            if ($request->expectsJson()) {
                return response()->json(['message' => $msg], 422);
            }
            return back()->with('error', $msg);
        }

        $kategori->delete();

        if ($request->expectsJson()) {
            return response()->json(['ok' => true]);
        }

        return back()->with('success', 'Kategori berhasil dihapus');
    }
}
