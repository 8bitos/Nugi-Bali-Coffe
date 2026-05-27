@extends('admin.layout')
@section('title', 'Manajemen Menu')
@section('breadcrumb')
    <span class="text-gray-700 font-medium">Menu</span>
@endsection

@section('content')
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6 bg-white p-4 rounded-2xl border border-slate-100 shadow-sm">
        <div>
            <span class="text-[10px] font-bold text-blue-600 uppercase tracking-widest bg-blue-50 px-2.5 py-1 rounded-lg">Workspace</span>
            <h1 class="text-xl font-bold text-slate-800 tracking-tight mt-1.5">Manajemen Menu</h1>
            <p class="text-xs text-slate-400">Atur susunan, harga, kategori, dan deskripsi menu restoran.</p>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('admin.menu.create') }}" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-bold py-2.5 px-4 rounded-xl shadow-sm transition text-xs cursor-pointer">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
                Tambah Menu
            </a>
        </div>
    </div>

    @php
        $categoryOrder = [
            // Drinks
            'Coffee' => ['icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />', 'type' => 'drink'],
            'Non Coffee' => ['icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75Zm-.375 0h.008v.015h-.008V9.75Zm5.625 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75Zm-.375 0h.008v.015h-.008V9.75Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M12 18.75a6 6 0 0 0 6-6v-1.5m-6 7.5a6 6 0 0 1-6-6v-1.5m6 7.5v-3.75m-3.75 0h7.5M12 7.5a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />', 'type' => 'drink'],
            'Signature' => ['icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499c.195-.558.943-.558 1.138 0l2.35 6.767a1.125 1.125 0 0 0 .94.767l7.07.628c.59.052.827.78.397 1.2l-5.32 5.176a1.125 1.125 0 0 0-.325 1.012l1.69 6.843c.14.568-.445.992-.953.693l-6.142-3.619a1.125 1.125 0 0 0-1.077 0l-6.142 3.619c-.508.299-1.092-.125-.953-.693l1.69-6.843a1.125 1.125 0 0 0-.325-1.012l-5.32-5.176c-.43-.42-.193-1.193.397-1.2l7.07-.628a1.125 1.125 0 0 0 .94-.767l2.35-6.767Z" />', 'type' => 'drink'],
            'Milkshake' => ['icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M9.75 3.104v11.851c0 .285-.205.534-.482.597l-3.842.872a.75.75 0 0 1-.902-.857l1.02-8.163A3 3 0 0 1 8.522 3.75h1.228Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M14.25 3.104v11.851c0 .285.205.534.482.597l3.842.872a.75.75 0 0 0 .902-.857l-1.02-8.163A3 3 0 0 0 15.478 3.75h-1.228Z" />', 'type' => 'drink'],
            'Tea' => ['icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 3v18M3 12h18" />', 'type' => 'drink'],
            'Fizzy Breeze' => ['icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 0 1-3 0V9.75h3v9Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M18.75 9.75v9a1.5 1.5 0 0 1-3 0v-9h3Z" />', 'type' => 'drink'],
            'Smoothies' => ['icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75Z" />', 'type' => 'drink'],
            'Additional (Drinks)' => ['icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />', 'type' => 'drink'],
            
            // Foods
            'Rice Bowl' => ['icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 3v18M3 12h18" />', 'type' => 'food'],
            'Munchies' => ['icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75Z" />', 'type' => 'food'],
            'Nugi Burger' => ['icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />', 'type' => 'food'],
            'Hotdog' => ['icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75Z" />', 'type' => 'food'],
            'Salad' => ['icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 3v18M3 12h18" />', 'type' => 'food'],
            'Toast' => ['icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 3v18M3 12h18" />', 'type' => 'food'],
            'Additional (Food)' => ['icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />', 'type' => 'food']
        ];

        // Format price helper
        if (!function_exists('adminFormatPrice')) {
            function adminFormatPrice($item) {
                if ($item->kategori === 'Fizzy Breeze') {
                    return '20K / 50K';
                }
                $price = $item->harga;
                if ($price >= 1000) {
                    $formatted = $price / 1000;
                    return ($price % 1000 === 0 ? number_format($formatted, 0) : number_format($formatted, 1)) . 'K';
                }
                return $price;
            }
        }
    @endphp

    <div class="flex flex-col xl:flex-row gap-6 items-start w-full max-w-full overflow-hidden xl:overflow-visible">
        
        <!-- Left Side: Menu List Grouped by Category -->
        <div class="flex-1 min-w-0 w-full space-y-6">
            @php $hasMenus = false; @endphp
            @foreach($categoryOrder as $catName => $catDetails)
                @php
                    $catMenus = $menus->where('kategori', $catName);
                @endphp
                @if($catMenus->count() > 0)
                    @php $hasMenus = true; @endphp
                    <div class="bg-white rounded-2xl border border-slate-100 overflow-hidden shadow-sm">
                        <!-- Category Header -->
                        <div class="px-5 py-3.5 bg-slate-50/50 flex items-center justify-between border-b border-slate-100 select-none">
                            <span class="font-bold text-slate-800 text-[13px] flex items-center gap-2">
                                <svg class="w-4 h-4 text-blue-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    {!! $catDetails['icon'] !!}
                                </svg>
                                {{ $catName }}
                            </span>
                            <span class="text-[10px] font-bold text-slate-400 bg-slate-100 px-2 py-0.5 rounded-lg">{{ $catMenus->count() }} Item</span>
                        </div>

                        <!-- Category Table -->
                        <div class="overflow-x-auto">
                            <table class="w-full text-xs text-left">
                                <thead>
                                    <tr class="bg-slate-50/20 border-b border-slate-100">
                                        <th class="px-5 py-2.5 text-[10px] font-bold text-slate-400 uppercase tracking-wider">Menu</th>
                                        <th class="px-5 py-2.5 text-[10px] font-bold text-slate-400 uppercase tracking-wider w-20">Harga</th>
                                        <th class="px-5 py-2.5 text-center text-[10px] font-bold text-slate-400 uppercase tracking-wider w-24">Urutan</th>
                                        <th class="px-5 py-2.5 text-center text-[10px] font-bold text-slate-400 uppercase tracking-wider w-24">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100 category-tbody" data-category="{{ $catName }}">
                                    @foreach($catMenus as $index => $item)
                                        <tr id="row-item-{{ $item->id }}" class="hover:bg-slate-50/30 transition group/row">
                                            <td class="px-5 py-3">
                                                <div class="flex items-center gap-2.5">
                                                    @if($item->foto)
                                                        <img src="{{ Storage::url($item->foto) }}" alt="{{ $item->nama_menu }}" class="w-8 h-8 rounded-lg object-cover border border-slate-200 shrink-0">
                                                    @else
                                                        <div class="w-8 h-8 rounded-lg bg-slate-100 flex items-center justify-center text-slate-400 font-bold border border-slate-200/50 shrink-0">
                                                            {{ strtoupper(substr($item->nama_menu, 0, 1)) }}
                                                        </div>
                                                    @endif
                                                    <div class="flex flex-col min-w-0">
                                                        <span class="font-bold text-slate-800 text-[12px] uppercase truncate">{{ $item->nama_menu }}</span>
                                                        @if($item->deskripsi)
                                                            <span class="text-[10px] text-slate-400 mt-0.5 max-w-[220px] sm:max-w-xs md:max-w-md truncate" title="{{ $item->deskripsi }}">{{ $item->deskripsi }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-5 py-3 font-extrabold text-blue-900 text-[12px] whitespace-nowrap">
                                                {{ adminFormatPrice($item) }}
                                            </td>
                                            <td class="px-5 py-3">
                                                <div class="flex items-center justify-center gap-1">
                                                    <button type="button" onclick="changePosition({{ $item->id }}, 'up')" 
                                                            class="up-btn p-1 bg-slate-100 hover:bg-blue-50 text-slate-500 hover:text-blue-600 rounded-md transition hover:scale-105 cursor-pointer disabled:opacity-20 disabled:pointer-events-none" title="Pindahkan ke atas">
                                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                                                        </svg>
                                                    </button>
                                                    <button type="button" onclick="changePosition({{ $item->id }}, 'down')" 
                                                            class="down-btn p-1 bg-slate-100 hover:bg-blue-50 text-slate-500 hover:text-blue-600 rounded-md transition hover:scale-105 cursor-pointer disabled:opacity-20 disabled:pointer-events-none" title="Pindahkan ke bawah">
                                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </td>
                                            <td class="px-5 py-3">
                                                <div class="flex items-center justify-center gap-1.5">
                                                    <a href="{{ route('admin.menu.edit', $item->id) }}" class="px-2.5 py-1 bg-slate-50 hover:bg-blue-50 hover:text-blue-600 rounded-md font-bold text-slate-500 transition">
                                                        Edit
                                                    </a>
                                                    <form method="POST" action="{{ route('admin.menu.destroy', $item->id) }}" class="inline" onsubmit="event.preventDefault(); confirmDelete(this, 'Hapus menu {{ addslashes($item->nama_menu) }}?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="px-2.5 py-1 bg-rose-50 hover:bg-rose-100 text-rose-600 rounded-md font-bold transition cursor-pointer">
                                                            Hapus
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
            @endforeach

            @if(!$hasMenus)
                <div class="bg-white rounded-2xl border border-slate-100 p-16 text-center shadow-sm">
                    <svg class="w-12 h-12 stroke-current mx-auto mb-3 text-slate-300" fill="none" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v18M3 12h18" /></svg>
                    <p class="text-slate-800 font-bold text-sm mb-1">Belum ada data menu</p>
                    <p class="text-xs text-slate-400 mb-4">Mulai tambahkan menu makanan & minuman</p>
                    <a href="{{ route('admin.menu.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-blue-600 text-white text-xs font-bold rounded-xl shadow-sm hover:bg-blue-700 transition">
                        Tambah Menu Pertama
                    </a>
                </div>
            @endif
        </div>

        <!-- Right Side: Sticky Live Preview mockup of the Catalog (w-80 / w-96 simulator sizing) -->
        <div class="w-full xl:w-[320px] 2xl:w-[360px] shrink-0 sticky top-20">
            <div class="bg-white rounded-2xl border border-slate-200/80 shadow-lg flex flex-col max-h-[calc(100vh-140px)] overflow-hidden">
                <!-- Preview Header Controls -->
                <div class="bg-slate-50 border-b border-slate-100 px-4 py-3 flex items-center justify-between shrink-0">
                    <div class="flex items-center gap-2">
                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></span>
                        <span class="text-xs font-bold text-slate-700">Pratinjau Live</span>
                    </div>
                    
                    <!-- Toggle drinks/food preview -->
                    <div class="flex bg-slate-200/60 p-0.5 rounded-lg text-[10px] font-bold">
                        <button type="button" id="toggle-preview-drinks" onclick="showPreviewSection('drinks')" class="px-2.5 py-1 bg-white text-blue-900 rounded-md shadow-sm transition-all duration-200">Minuman</button>
                        <button type="button" id="toggle-preview-foods" onclick="showPreviewSection('food')" class="px-2.5 py-1 text-slate-500 rounded-md transition-all duration-200">Makanan</button>
                    </div>
                </div>

                <!-- Scrollable Catalog Visual Mockup -->
                <div id="live-preview-content" class="flex-1 overflow-y-auto p-5 bg-[#FAF9F6] text-slate-800 space-y-6 max-h-[560px] min-h-[380px]">
                    <!-- Drinks Section -->
                    <div id="preview-section-drinks" class="space-y-6">
                        @foreach(['Coffee', 'Non Coffee', 'Signature', 'Milkshake', 'Tea', 'Fizzy Breeze', 'Smoothies', 'Additional (Drinks)'] as $catName)
                            @php $catMenus = $menus->where('kategori', $catName); @endphp
                            @if($catMenus->count() > 0)
                                <div class="preview-cat-box {{ $catName === 'Signature' ? 'border border-blue-900 rounded-xl p-4 bg-[#EFF6FF]/10' : ($catName === 'Additional (Drinks)' ? 'border-2 border-dashed border-blue-900/30 rounded-xl p-4 bg-slate-50/20' : '') }}">
                                    <h3 class="font-playfair font-extrabold text-[14px] text-blue-900 border-b border-slate-100 pb-1 mb-2 tracking-wide">{{ $catName }}</h3>
                                    
                                    <div class="preview-items-list space-y-3" data-preview-cat="{{ $catName }}">
                                        @foreach($catMenus as $item)
                                            <div id="preview-item-{{ $item->id }}" class="flex flex-col">
                                                <div class="flex justify-between items-baseline gap-2">
                                                    <span class="font-bold text-[9px] text-blue-950 tracking-wider uppercase truncate max-w-[70%]">{{ $item->nama_menu }}</span>
                                                    <span class="font-bold text-[9px] text-blue-900 whitespace-nowrap">{{ adminFormatPrice($item) }}</span>
                                                </div>
                                                @if($item->deskripsi)
                                                    <span class="text-[8px] text-slate-400 leading-normal mt-0.5">{{ $item->deskripsi }}</span>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>

                    <!-- Food Section (hidden by default) -->
                    <div id="preview-section-food" class="space-y-6 hidden">
                        @foreach(['Rice Bowl', 'Munchies', 'Nugi Burger', 'Hotdog', 'Salad', 'Toast', 'Additional (Food)'] as $catName)
                            @php $catMenus = $menus->where('kategori', $catName); @endphp
                            @if($catMenus->count() > 0)
                                <div class="preview-cat-box {{ $catName === 'Rice Bowl' || $catName === 'Additional (Food)' ? 'border-2 border-dashed border-blue-900/30 rounded-xl p-4 bg-slate-50/20' : (in_array($catName, ['Munchies', 'Nugi Burger', 'Hotdog', 'Salad', 'Toast']) ? 'border border-slate-200 rounded-xl p-4 bg-white' : '') }}">
                                    <h3 class="font-playfair font-extrabold text-[14px] text-blue-900 border-b border-slate-100 pb-1 mb-2 tracking-wide">{{ $catName }}</h3>
                                    
                                    <div class="preview-items-list space-y-2.5" data-preview-cat="{{ $catName }}">
                                        @foreach($catMenus as $item)
                                            <div id="preview-item-{{ $item->id }}" class="flex flex-col">
                                                <div class="flex justify-between items-baseline gap-2">
                                                    <span class="font-bold text-[9px] text-blue-950 tracking-wider uppercase truncate max-w-[70%]">{{ $item->nama_menu }}</span>
                                                    <span class="font-bold text-[9px] text-blue-900 whitespace-nowrap">{{ adminFormatPrice($item) }}</span>
                                                </div>
                                                @if($item->deskripsi)
                                                    <span class="text-[8px] text-slate-400 leading-normal mt-0.5">{{ $item->deskripsi }}</span>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>

                    <!-- Preview Slogan -->
                    <div class="flex items-center justify-center gap-2 text-[8px] font-bold text-blue-900/40 uppercase tracking-widest border-t border-slate-100 pt-4">
                        <span class="border border-blue-900/25 px-2 py-0.5 rounded-full text-blue-900/50">Nugi</span>
                        <span>Space . Moment . Togetherness</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            updateArrowButtonsState();
        });

        // Toggle drinks or foods section inside preview
        function showPreviewSection(type) {
            const btnDrinks = document.getElementById('toggle-preview-drinks');
            const btnFoods = document.getElementById('toggle-preview-foods');
            const drinksSec = document.getElementById('preview-section-drinks');
            const foodsSec = document.getElementById('preview-section-food');

            if (type === 'drinks') {
                btnDrinks.className = 'px-2.5 py-1 bg-white text-blue-900 rounded-md shadow-sm transition-all duration-200';
                btnFoods.className = 'px-2.5 py-1 text-slate-500 rounded-md transition-all duration-200';
                drinksSec.classList.remove('hidden');
                foodsSec.classList.add('hidden');
            } else {
                btnFoods.className = 'px-2.5 py-1 bg-white text-blue-900 rounded-md shadow-sm transition-all duration-200';
                btnDrinks.className = 'px-2.5 py-1 text-slate-500 rounded-md transition-all duration-200';
                foodsSec.classList.remove('hidden');
                drinksSec.classList.add('hidden');
            }
        }

        // Change position AJAX
        function changePosition(itemId, direction) {
            const row = document.getElementById(`row-item-${itemId}`);
            const previewItem = document.getElementById(`preview-item-${itemId}`);
            if (!row) return;

            let targetRow = null;
            let targetPreview = null;

            if (direction === 'up') {
                targetRow = row.previousElementSibling;
                targetPreview = previewItem ? previewItem.previousElementSibling : null;
            } else {
                targetRow = row.nextElementSibling;
                targetPreview = previewItem ? previewItem.nextElementSibling : null;
            }

            fetch("{{ route('admin.menu.reorder') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({ id: itemId, direction: direction })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    // DOM Swap for table rows
                    if (direction === 'up' && targetRow) {
                        row.parentNode.insertBefore(row, targetRow);
                        if (previewItem && targetPreview) {
                            previewItem.parentNode.insertBefore(previewItem, targetPreview);
                        }
                    } else if (direction === 'down' && targetRow) {
                        row.parentNode.insertBefore(targetRow, row);
                        if (previewItem && targetPreview) {
                            previewItem.parentNode.insertBefore(targetPreview, previewItem);
                        }
                    }

                    // Reset disabled state on all arrows
                    updateArrowButtonsState();

                    // Show custom native toast
                    showToast('Susunan menu berhasil diperbarui');
                } else {
                    showToast(data.message);
                }
            })
            .catch(err => {
                console.error(err);
                showToast('Gagal memproses perubahan susunan');
            });
        }

        // Disable up arrows for first-row, down arrows for last-row inside their respective categories
        function updateArrowButtonsState() {
            document.querySelectorAll('.category-tbody').forEach(tbody => {
                const rows = Array.from(tbody.querySelectorAll('tr'));
                rows.forEach((row, index) => {
                    const upBtn = row.querySelector('.up-btn');
                    const downBtn = row.querySelector('.down-btn');
                    
                    if (upBtn) {
                        if (index === 0) {
                            upBtn.disabled = true;
                            upBtn.classList.add('opacity-20', 'cursor-not-allowed');
                        } else {
                            upBtn.disabled = false;
                            upBtn.classList.remove('opacity-20', 'cursor-not-allowed');
                        }
                    }
                    
                    if (downBtn) {
                        if (index === rows.length - 1) {
                            downBtn.disabled = true;
                            downBtn.classList.add('opacity-20', 'cursor-not-allowed');
                        } else {
                            downBtn.disabled = false;
                            downBtn.classList.remove('opacity-20', 'cursor-not-allowed');
                        }
                    }
                });
            });
        }

        // Custom toast notice
        function showToast(message) {
            let toast = document.getElementById('admin-toast');
            if (!toast) {
                toast = document.createElement('div');
                toast.id = 'admin-toast';
                toast.className = 'fixed bottom-5 right-5 z-[100] px-4 py-3 bg-slate-900 text-white rounded-xl shadow-xl text-xs font-bold flex items-center gap-2.5 transform translate-y-10 opacity-0 transition-all duration-300 pointer-events-none';
                toast.innerHTML = `
                    <svg class="w-4 h-4 text-emerald-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
                    <span id="toast-message"></span>
                `;
                document.body.appendChild(toast);
            }
            
            document.getElementById('toast-message').textContent = message;
            toast.classList.remove('translate-y-10', 'opacity-0');
            toast.classList.add('translate-y-0', 'opacity-100');
            
            setTimeout(() => {
                toast.classList.remove('translate-y-0', 'opacity-100');
                toast.classList.add('translate-y-10', 'opacity-0');
            }, 2500);
        }
    </script>
@endsection
