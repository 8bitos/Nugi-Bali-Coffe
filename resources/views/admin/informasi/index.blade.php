@extends('admin.layouts.app')
@section('title','Info Web')
@section('page_title','Informasi Website')
@section('content')
<div class="mt-8 rounded-xl border border-slate-200 bg-white p-5">
    @php
        $defaultTitle = 'NUGI BALI';
        $defaultSubtitle = 'Nikmati pengalaman kuliner terbaik dengan suasana nyaman, dekorasi elegan, dan pelayanan prima.';
        $defaultCtaText = 'RESERVASI SEKARANG';
        $defaultCtaUrl = route('reservasi.create');
    @endphp
    <div class="mb-4">
        <h3 class="text-lg font-semibold text-slate-800">Landing Page Info</h3>
        <p class="text-sm text-slate-500">Edit teks dan carousel landing page langsung dari sini.</p>
    </div>
    <form method="POST" action="{{ route('admin.informasi-web.landing.update') }}" enctype="multipart/form-data" class="space-y-3">
        @csrf
        @method('PUT')
        <div id="removed-slides-markers"></div>
        <div>
            <label class="mb-1 block text-sm font-medium text-slate-700">Judul Landing</label>
            <input name="landing_title" value="{{ old('landing_title', $landingInfo->landing_title ?? $defaultTitle) }}" class="w-full rounded-lg border border-slate-300 px-3 py-2 focus:border-[#0f766e] focus:outline-none focus:ring-2 focus:ring-[#0f766e]/20">
        </div>
        <div>
            <label class="mb-1 block text-sm font-medium text-slate-700">Deskripsi Landing</label>
            <textarea name="landing_subtitle" rows="3" class="w-full rounded-lg border border-slate-300 px-3 py-2 focus:border-[#0f766e] focus:outline-none focus:ring-2 focus:ring-[#0f766e]/20">{{ old('landing_subtitle', $landingInfo->landing_subtitle ?? $defaultSubtitle) }}</textarea>
        </div>
        <div class="grid grid-cols-1 gap-3 md:grid-cols-2">
            <div>
                <label class="mb-1 block text-sm font-medium text-slate-700">Teks Tombol CTA</label>
                <input name="landing_cta_text" value="{{ old('landing_cta_text', $landingInfo->landing_cta_text ?? $defaultCtaText) }}" class="w-full rounded-lg border border-slate-300 px-3 py-2 focus:border-[#0f766e] focus:outline-none focus:ring-2 focus:ring-[#0f766e]/20">
            </div>
            <div>
                <label class="mb-1 block text-sm font-medium text-slate-700">URL Tombol CTA</label>
                <input name="landing_cta_url" value="{{ old('landing_cta_url', $landingInfo->landing_cta_url ?? $defaultCtaUrl) }}" class="w-full rounded-lg border border-slate-300 px-3 py-2 focus:border-[#0f766e] focus:outline-none focus:ring-2 focus:ring-[#0f766e]/20">
            </div>
        </div>
        @php
            $existingSlides = isset($landingInfo) && is_array($landingInfo->landing_slides) ? array_values($landingInfo->landing_slides) : [];
            if (count($existingSlides) < 3) {
                $existingSlides = array_pad($existingSlides, 3, null);
            }
        @endphp
        <div class="rounded-lg border border-dashed border-slate-300 p-3">
            <div class="mb-2 flex items-center justify-between">
                <label class="block text-sm font-medium">Carousel Slides</label>
                <button type="button" id="add-slide-btn" class="rounded-full bg-[#0f766e] px-3 py-1 text-xs font-semibold text-white">+ Tambah Slide</button>
            </div>
            <div id="slides-container" class="grid grid-cols-2 gap-2 md:grid-cols-4 lg:grid-cols-5">
                @foreach($existingSlides as $index => $slidePath)
                    <div class="slide-card rounded-lg border border-slate-300 bg-slate-50 p-1.5" data-index="{{ $index }}">
                        <div class="mb-2 flex items-center justify-between">
                            <p class="text-xs font-semibold text-slate-500">Slide {{ $index + 1 }}</p>
                            <div class="flex gap-1">
                                <button type="button" class="edit-slide-btn rounded bg-white px-2 py-1 text-xs" title="Ganti gambar">✎</button>
                                <button type="button" class="remove-slide-btn rounded bg-white px-2 py-1 text-xs text-red-600" title="Hapus slide">🗑</button>
                            </div>
                        </div>
                        <div class="slide-preview {{ !empty($slidePath) ? '' : 'flex items-center justify-center' }} aspect-square w-full overflow-hidden rounded border border-slate-200 bg-white text-[10px] text-slate-400">
                            @if(!empty($slidePath))
                                <img src="{{ asset('storage/' . $slidePath) }}" class="h-full w-full object-cover">
                            @else
                                Placeholder kosong
                            @endif
                        </div>
                        <input type="hidden" name="existing_slides[{{ $index }}]" value="{{ $slidePath }}" class="existing-slide-input">
                        <input type="hidden" name="remove_flags[{{ $index }}]" value="0" class="remove-flag-input">
                        <input type="file" name="slide_files[{{ $index }}]" accept="image/*" class="slide-file-input hidden">
                    </div>
                @endforeach
            </div>
            <p class="mt-2 text-xs text-slate-500">Setiap upload hanya mengganti slot slide yang dipilih.</p>
        </div>
        @if(count($existingSlides))
            <label class="flex items-center gap-2 text-sm text-red-600">
                <input type="checkbox" name="remove_landing_slides" value="1"> Hapus semua slide saat simpan
            </label>
        @endif

        <button class="rounded-lg bg-[#0f766e] px-4 py-2 text-sm font-semibold text-white hover:bg-[#0d655f]">Simpan Landing Page Info</button>
    </form>

    <div class="mt-4 rounded-xl border border-slate-200 bg-slate-50 p-4">
        <div class="mb-3 flex items-center justify-between">
            <p class="text-sm font-semibold text-slate-700">Live Preview</p>
            <div class="flex gap-2">
                <button type="button" id="previewDesktopBtn" class="rounded bg-[#0f766e] px-3 py-1 text-xs font-semibold text-white">Desktop</button>
                <button type="button" id="previewMobileBtn" class="rounded bg-slate-200 px-3 py-1 text-xs font-semibold text-slate-700">Mobile</button>
            </div>
        </div>
        <div id="previewFrame" class="mx-auto w-full max-w-[1280px] overflow-hidden rounded-lg border border-slate-200 bg-[#f5f7fb] shadow-sm">
            <nav class="bg-white shadow-sm">
                <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-3">
                    <div class="flex items-center gap-2">
                        <div class="h-8 w-8 rounded bg-blue-600"></div>
                        <span class="text-xl font-bold text-blue-700">NUGI BALI</span>
                    </div>
                    <div class="hidden items-center gap-5 text-sm text-slate-600 md:flex">
                        <span>Beranda</span><span>Tentang</span><span>Menu</span><span>Galeri</span><span>Lokasi</span><span>Login</span>
                    </div>
                    <span class="rounded-lg bg-gradient-to-r from-blue-500 to-cyan-600 px-4 py-2 text-xs font-bold text-white">RESERVASI</span>
                </div>
            </nav>
            <div id="previewContent" class="mx-auto grid max-w-7xl grid-cols-1 gap-8 px-6 py-8 md:grid-cols-2 md:py-12">
                <div>
                    <h4 id="previewTitle" class="text-5xl font-extrabold leading-tight text-slate-800">{{ old('landing_title', $landingInfo->landing_title ?? $defaultTitle) }}</h4>
                    <p id="previewSubtitle" class="mt-4 text-2xl leading-relaxed text-slate-600">{{ old('landing_subtitle', $landingInfo->landing_subtitle ?? $defaultSubtitle) }}</p>
                    <a id="previewCta" href="{{ old('landing_cta_url', $landingInfo->landing_cta_url ?? $defaultCtaUrl) }}" class="mt-6 inline-block rounded-lg bg-gradient-to-r from-blue-500 to-cyan-600 px-6 py-3 text-base font-semibold text-white">
                        {{ old('landing_cta_text', $landingInfo->landing_cta_text ?? $defaultCtaText) }}
                    </a>
                </div>
                <div class="relative">
                    <div id="previewHero" class="flex aspect-video w-full items-center justify-center overflow-hidden rounded-2xl bg-slate-100 text-xs text-slate-400 shadow-xl">
                        Belum ada gambar slide
                    </div>
                    <button type="button" class="absolute left-3 top-1/2 -translate-y-1/2 rounded-full bg-black/35 px-3 py-1 text-lg text-white">‹</button>
                    <button type="button" class="absolute right-3 top-1/2 -translate-y-1/2 rounded-full bg-black/35 px-3 py-1 text-lg text-white">›</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    (() => {
        const titleInput = document.querySelector('input[name="landing_title"]');
        const subtitleInput = document.querySelector('textarea[name="landing_subtitle"]');
        const ctaTextInput = document.querySelector('input[name="landing_cta_text"]');
        const ctaUrlInput = document.querySelector('input[name="landing_cta_url"]');
        const previewTitle = document.getElementById('previewTitle');
        const previewSubtitle = document.getElementById('previewSubtitle');
        const previewCta = document.getElementById('previewCta');

        const sync = () => {
            previewTitle.textContent = titleInput.value || '{{ $defaultTitle }}';
            previewSubtitle.textContent = subtitleInput.value || '{{ $defaultSubtitle }}';
            previewCta.textContent = ctaTextInput.value || '{{ $defaultCtaText }}';
            previewCta.setAttribute('href', ctaUrlInput.value || '{{ $defaultCtaUrl }}');
        };

        [titleInput, subtitleInput, ctaTextInput, ctaUrlInput].forEach(el => el.addEventListener('input', sync));
        sync();

        const slidesContainer = document.getElementById('slides-container');
        const previewHero = document.getElementById('previewHero');
        const previewFrame = document.getElementById('previewFrame');
        const previewContent = document.getElementById('previewContent');
        const desktopBtn = document.getElementById('previewDesktopBtn');
        const mobileBtn = document.getElementById('previewMobileBtn');
        const addSlideBtn = document.getElementById('add-slide-btn');
        let nextIndex = slidesContainer.querySelectorAll('.slide-card').length;

        const bindSlideCard = (card) => {
            const fileInput = card.querySelector('.slide-file-input');
            const preview = card.querySelector('.slide-preview');
            const removeFlag = card.querySelector('.remove-flag-input');
            const existingInput = card.querySelector('.existing-slide-input');
            card.querySelector('.edit-slide-btn')?.addEventListener('click', () => fileInput.click());
            card.querySelector('.remove-slide-btn')?.addEventListener('click', () => {
                const idx = card.getAttribute('data-index');
                const existingPath = existingInput.value;
                if (existingPath) {
                    const markers = document.getElementById('removed-slides-markers');
                    const existingMarker = document.createElement('input');
                    existingMarker.type = 'hidden';
                    existingMarker.name = `existing_slides[${idx}]`;
                    existingMarker.value = existingPath;
                    const removeMarker = document.createElement('input');
                    removeMarker.type = 'hidden';
                    removeMarker.name = `remove_flags[${idx}]`;
                    removeMarker.value = '1';
                    markers.appendChild(existingMarker);
                    markers.appendChild(removeMarker);
                }
                card.remove();
                syncPreviewHero();
            });
            fileInput.addEventListener('change', () => {
                const file = fileInput.files?.[0];
                if (!file) return;
                const reader = new FileReader();
                reader.onload = (e) => {
                    preview.innerHTML = `<img src="${e.target.result}" class="h-full w-full object-cover">`;
                    preview.classList.remove('flex', 'items-center', 'justify-center');
                    removeFlag.value = '0';
                    syncPreviewHero();
                };
                reader.readAsDataURL(file);
            });
        };

        const syncPreviewHero = () => {
            const firstImg = slidesContainer.querySelector('.slide-card .slide-preview img');
            if (firstImg) {
                previewHero.innerHTML = `<img src="${firstImg.getAttribute('src')}" class="h-full w-full object-cover">`;
                previewHero.classList.remove('text-slate-400');
            } else {
                previewHero.innerHTML = 'Belum ada gambar slide';
                previewHero.classList.add('text-slate-400');
            }
        };

        slidesContainer.querySelectorAll('.slide-card').forEach(bindSlideCard);
        syncPreviewHero();

        desktopBtn?.addEventListener('click', () => {
            previewFrame.classList.remove('max-w-[390px]');
            previewFrame.classList.add('w-full', 'max-w-[1280px]');
            previewContent.classList.add('md:grid-cols-2');
            previewTitle.classList.remove('text-2xl');
            previewTitle.classList.add('text-5xl');
            previewSubtitle.classList.remove('text-sm');
            previewSubtitle.classList.add('text-2xl');
            desktopBtn.className = 'rounded bg-[#0f766e] px-3 py-1 text-xs font-semibold text-white';
            mobileBtn.className = 'rounded bg-slate-200 px-3 py-1 text-xs font-semibold text-slate-700';
        });

        mobileBtn?.addEventListener('click', () => {
            previewFrame.classList.add('max-w-[390px]');
            previewFrame.classList.remove('max-w-[1280px]');
            previewContent.classList.remove('md:grid-cols-2');
            previewTitle.classList.remove('text-5xl');
            previewTitle.classList.add('text-2xl');
            previewSubtitle.classList.remove('text-2xl');
            previewSubtitle.classList.add('text-sm');
            mobileBtn.className = 'rounded bg-[#0f766e] px-3 py-1 text-xs font-semibold text-white';
            desktopBtn.className = 'rounded bg-slate-200 px-3 py-1 text-xs font-semibold text-slate-700';
        });

        addSlideBtn?.addEventListener('click', () => {
            const idx = nextIndex++;
            const card = document.createElement('div');
            card.className = 'slide-card rounded-lg border border-slate-300 bg-slate-50 p-1.5';
            card.setAttribute('data-index', idx);
            card.innerHTML = `
                <div class="mb-2 flex items-center justify-between">
                    <p class="text-xs font-semibold text-slate-500">Slide ${idx + 1}</p>
                    <div class="flex gap-1">
                        <button type="button" class="edit-slide-btn rounded bg-white px-2 py-1 text-xs" title="Pilih gambar">✎</button>
                        <button type="button" class="remove-slide-btn rounded bg-white px-2 py-1 text-xs text-red-600" title="Hapus slide">🗑</button>
                    </div>
                </div>
                <div class="slide-preview flex aspect-square w-full items-center justify-center overflow-hidden rounded border border-slate-200 bg-white text-[10px] text-slate-400">Placeholder kosong</div>
                <input type="hidden" name="existing_slides[${idx}]" value="" class="existing-slide-input">
                <input type="hidden" name="remove_flags[${idx}]" value="0" class="remove-flag-input">
                <input type="file" name="slide_files[${idx}]" accept="image/*" class="slide-file-input hidden">
            `;
            slidesContainer.appendChild(card);
            bindSlideCard(card);
            syncPreviewHero();
        });
    })();
</script>
@endsection
