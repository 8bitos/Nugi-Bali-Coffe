<?php

namespace App\Http\Controllers;

use App\Models\InformasiWeb;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InformasiWebController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $informasi = InformasiWeb::latest()->get();
        $landingInfo = InformasiWeb::first();
        return view('admin.informasi.index', compact('informasi', 'landingInfo'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.informasi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_web' => 'sometimes|string|max:255',
            'profil' => 'nullable|string',
            'kontak_email' => 'nullable|email',
            'kontak_telepon' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
            'lokasi_url' => 'nullable|url',
            'instagram_url' => 'nullable|url',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
            'hero_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
            'tentang_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
            'lokasi_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
            'landing_title' => 'nullable|string|max:255',
            'landing_subtitle' => 'nullable|string',
            'landing_cta_text' => 'nullable|string|max:100',
            'landing_cta_url' => 'nullable|string|max:255',
            'landing_slides' => 'nullable|array|max:10',
            'landing_slides.*' => 'image|mimes:jpeg,png,jpg,webp|max:4096',
        ]);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('informasi', 'public');
        }

        if ($request->hasFile('hero_image')) {
            $validated['hero_image'] = $request->file('hero_image')->store('informasi', 'public');
        }
        if ($request->hasFile('tentang_image')) {
            $validated['tentang_image'] = $request->file('tentang_image')->store('informasi', 'public');
        }
        if ($request->hasFile('lokasi_image')) {
            $validated['lokasi_image'] = $request->file('lokasi_image')->store('informasi', 'public');
        }

        if ($request->hasFile('landing_slides')) {
            $slidePaths = [];
            foreach ($request->file('landing_slides') as $slide) {
                $slidePaths[] = $slide->store('landing-slides', 'public');
            }
            $validated['landing_slides'] = $slidePaths;
        }

        InformasiWeb::create($validated);
        return redirect()->route('admin.informasi-web.index')->with('success', 'Informasi berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return redirect()->route('admin.informasi-web.edit', $id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $informasi = InformasiWeb::findOrFail($id);
        return view('admin.informasi.edit', compact('informasi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $informasi = InformasiWeb::findOrFail($id);

        $validated = $request->validate([
            'nama_web' => 'sometimes|string|max:255',
            'profil' => 'nullable|string',
            'kontak_email' => 'nullable|email',
            'kontak_telepon' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
            'lokasi_url' => 'nullable|url',
            'instagram_url' => 'nullable|url',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
            'hero_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
            'tentang_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
            'lokasi_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
            'landing_title' => 'nullable|string|max:255',
            'landing_subtitle' => 'nullable|string',
            'landing_cta_text' => 'nullable|string|max:100',
            'landing_cta_url' => 'nullable|string|max:255',
            'landing_slides' => 'nullable|array|max:10',
            'landing_slides.*' => 'image|mimes:jpeg,png,jpg,webp|max:4096',
            'remove_landing_slides' => 'nullable|boolean',
        ]);

        if ($request->hasFile('logo')) {
            if ($informasi->logo) {
                Storage::disk('public')->delete($informasi->logo);
            }
            $validated['logo'] = $request->file('logo')->store('informasi', 'public');
        }

        if ($request->hasFile('hero_image')) {
            if ($informasi->hero_image) {
                Storage::disk('public')->delete($informasi->hero_image);
            }
            $validated['hero_image'] = $request->file('hero_image')->store('informasi', 'public');
        }
        if ($request->hasFile('tentang_image')) {
            if ($informasi->tentang_image) {
                Storage::disk('public')->delete($informasi->tentang_image);
            }
            $validated['tentang_image'] = $request->file('tentang_image')->store('informasi', 'public');
        }
        if ($request->hasFile('lokasi_image')) {
            if ($informasi->lokasi_image) {
                Storage::disk('public')->delete($informasi->lokasi_image);
            }
            $validated['lokasi_image'] = $request->file('lokasi_image')->store('informasi', 'public');
        }

        if ($request->boolean('remove_landing_slides') && is_array($informasi->landing_slides)) {
            foreach ($informasi->landing_slides as $oldSlide) {
                Storage::disk('public')->delete($oldSlide);
            }
            $validated['landing_slides'] = [];
        }

        if ($request->hasFile('landing_slides')) {
            if (is_array($informasi->landing_slides)) {
                foreach ($informasi->landing_slides as $oldSlide) {
                    Storage::disk('public')->delete($oldSlide);
                }
            }
            $slidePaths = [];
            foreach ($request->file('landing_slides') as $slide) {
                $slidePaths[] = $slide->store('landing-slides', 'public');
            }
            $validated['landing_slides'] = $slidePaths;
        }

        $informasi->update($validated);
        return redirect()->route('admin.informasi-web.index')->with('success', 'Informasi berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $informasi = InformasiWeb::findOrFail($id);
        if ($informasi->logo) {
            Storage::disk('public')->delete($informasi->logo);
        }
        if ($informasi->hero_image) {
            Storage::disk('public')->delete($informasi->hero_image);
        }
        if ($informasi->tentang_image) {
            Storage::disk('public')->delete($informasi->tentang_image);
        }
        if ($informasi->lokasi_image) {
            Storage::disk('public')->delete($informasi->lokasi_image);
        }
        if (is_array($informasi->landing_slides)) {
            foreach ($informasi->landing_slides as $slide) {
                Storage::disk('public')->delete($slide);
            }
        }
        $informasi->delete();
        return redirect()->route('admin.informasi-web.index')->with('success', 'Informasi berhasil dihapus');
    }

    public function updateLanding(Request $request)
    {
        $validated = $request->validate([
            'landing_title' => 'nullable|string|max:255',
            'landing_subtitle' => 'nullable|string',
            'landing_cta_text' => 'nullable|string|max:100',
            'landing_cta_url' => 'nullable|string|max:255',
            'existing_slides' => 'nullable|array',
            'existing_slides.*' => 'nullable|string',
            'remove_flags' => 'nullable|array',
            'remove_flags.*' => 'nullable|in:0,1',
            'slide_files' => 'nullable|array',
            'slide_files.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
            'remove_landing_slides' => 'nullable|boolean',
        ]);

        $info = InformasiWeb::firstOrCreate([], ['nama_web' => 'Nugi Bali']);

        if ($request->boolean('remove_landing_slides') && is_array($info->landing_slides)) {
            foreach ($info->landing_slides as $oldSlide) {
                Storage::disk('public')->delete($oldSlide);
            }
            $validated['landing_slides'] = [];
        }

        $existingSlides = $request->input('existing_slides', []);
        $removeFlags = $request->input('remove_flags', []);
        $uploadedFiles = $request->file('slide_files', []);
        $indices = array_unique(array_merge(
            array_keys($existingSlides),
            array_keys($removeFlags),
            array_keys($uploadedFiles),
        ));
        $nextSlides = [];

        foreach ($indices as $i) {
            $existingPath = $existingSlides[$i] ?? null;
            $remove = ($removeFlags[$i] ?? '0') === '1';
            $file = $uploadedFiles[$i] ?? null;

            if ($file) {
                if (!empty($existingPath)) {
                    Storage::disk('public')->delete($existingPath);
                }
                $nextSlides[] = $file->store('landing-slides', 'public');
                continue;
            }

            if ($remove && !empty($existingPath)) {
                Storage::disk('public')->delete($existingPath);
                continue;
            }

            if (!$remove && !empty($existingPath)) {
                $nextSlides[] = $existingPath;
            }
        }

        if (count($indices) > 0 || $request->boolean('remove_landing_slides')) {
            $validated['landing_slides'] = $nextSlides;
        }

        $info->update($validated);
        return redirect()->route('admin.informasi-web.index')->with('success', 'Landing page info berhasil diperbarui.');
    }
}
