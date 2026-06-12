@extends('admin.layout')
@section('title', 'Laporan Reservasi')
@section('breadcrumb')
    <span class="text-gray-700 font-medium">Laporan Reservasi</span>
@endsection

@section('content')
<style>
    @media print {
        @page {
            margin: 0;
        }

        /* General page layout adjustments for print */
        body {
            background: white !important;
            color: #333 !important;
            font-family: 'Helvetica', 'Arial', sans-serif !important;
            font-size: 11px !important;
            margin: 0 !important;
            padding: 0 !important;
        }

        /* Hide non-printable web elements */
        #sidebar, 
        header, 
        #sidebarOverlay,
        .no-print,
        nav {
            display: none !important;
        }

        /* Reset main area padding and margins for full width printing */
        .lg\:ml-\[260px\] {
            margin-left: 0 !important;
        }
        
        main {
            padding: 0 !important;
            margin: 0 !important;
            background: white !important;
        }

        /* Match the print header container layout to the PDF report header */
        .print-header-container {
            display: flex !important;
            flex-direction: row !important;
            align-items: center !important;
            justify-content: space-between !important;
            background: #1E40AF !important;
            color: white !important;
            padding: 20px 30px !important;
            margin: 0 0 20px 0 !important;
            border-radius: 0 !important;
            border: none !important;
            box-shadow: none !important;
            width: 100% !important;
        }
        
        .print-logo-container {
            background: transparent !important;
            border: none !important;
            padding: 0 !important;
            width: 45px !important;
            height: 45px !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
        }
        
        .print-logo-container img {
            height: 40px !important;
            width: auto !important;
            border-radius: 4px !important;
        }

        .print-title {
            color: white !important;
            font-size: 20px !important;
            margin: 0 !important;
            font-weight: bold !important;
            text-transform: uppercase !important;
            line-height: 1.2 !important;
        }

        .print-subtitle {
            color: rgba(255, 255, 255, 0.9) !important;
            font-size: 11px !important;
            margin: 2px 0 0 0 !important;
        }

        /* Show contact info block during printing */
        .print-only {
            display: block !important;
            text-align: right !important;
        }
        
        .print-only p {
            color: rgba(255, 255, 255, 0.9) !important;
            font-size: 9px !important;
            line-height: 1.4 !important;
            margin: 0 !important;
        }

        /* Table layout adjustment for print */
        .bg-white {
            background: white !important;
            box-shadow: none !important;
            border: none !important;
            padding: 0 !important;
            margin: 0 30px !important;
        }
        
        table {
            width: 100% !important;
            border-collapse: collapse !important;
            margin-top: 15px !important;
        }
        
        thead tr {
            background-color: #F3F4F6 !important;
        }
        
        th {
            background-color: #F3F4F6 !important;
            color: #6B7280 !important;
            border-bottom: 2px solid #E5E7EB !important;
            padding: 8px 10px !important;
            font-size: 10px !important;
            text-transform: uppercase !important;
            font-weight: bold !important;
        }
        
        td {
            padding: 7px 10px !important;
            border-bottom: 1px solid #E5E7EB !important;
            font-size: 10px !important;
            color: #333 !important;
        }
        
        tbody tr:nth-child(even) {
            background-color: #F9FAFB !important;
        }

        /* Hide initials avatar in print table */
        .print-avatar {
            display: none !important;
        }
        
        /* Status Badges */
        .status-badge-container {
            border: none !important;
            padding: 0 !important;
            font-weight: 600 !important;
        }
    }
</style>

    <!-- Header Laporan dengan Logo -->
    <div class="flex flex-col md:flex-row items-center justify-between gap-4 mb-6 bg-white rounded-2xl border border-slate-100 p-6 shadow-sm print-header-container">
        <div class="flex flex-col sm:flex-row items-center gap-4 text-center sm:text-left">
            <div class="w-16 h-16 rounded-xl bg-slate-50 border border-slate-200/50 flex items-center justify-center p-2 shrink-0 print-logo-container">
                <img src="{{ !empty($info?->logo) ? asset('storage/' . $info->logo) : asset('assets/images/logo.png') }}" alt="Nugi Bali Logo" class="max-w-full max-h-full object-contain">
            </div>
            <div>
                <span class="text-[10px] font-bold text-blue-600 uppercase tracking-widest bg-blue-50 px-2.5 py-1 rounded-lg no-print">Laporan Resmi</span>
                <h1 class="text-xl font-bold text-slate-800 tracking-tight mt-1.5 print-title">{{ $info?->nama_web ?? 'Nugi Bali' }}</h1>
                <p class="text-xs text-slate-400 print-subtitle">Laporan Data Reservasi Pelanggan</p>
            </div>
        </div>
        
        <!-- Alamat & Kontak (Tampil saat di-print saja) -->
        <div class="print-only hidden text-right text-slate-500 text-[10px] leading-relaxed">
            @if(!empty($info->alamat))
                <p>{{ $info->alamat }}</p>
            @endif
            <p>
                @if(!empty($info->kontak_telepon))
                    Telp: {{ $info->kontak_telepon }}
                @endif
                @if(!empty($info->kontak_email))
                    {{ !empty($info->kontak_telepon) ? '|' : '' }} Email: {{ $info->kontak_email }}
                @endif
            </p>
        </div>

        <div class="flex flex-wrap items-center gap-2 no-print">
            <button onclick="window.print()" class="px-4 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold rounded-xl text-xs transition flex items-center gap-2 cursor-pointer border border-slate-200/40">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                </svg>
                Cetak Halaman
            </button>
            <a href="{{ route('admin.reservasi.export') }}" class="px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl text-xs transition flex items-center gap-2 shadow-sm shadow-blue-500/10">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                </svg>
                Export PDF / Excel
            </a>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-xs text-left">
                <thead>
                    <tr class="bg-slate-50/50 border-b border-slate-100">
                        <th class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-wider">No</th>
                        <th class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-wider">Pemesan</th>
                        <th class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-wider">Kontak</th>
                        <th class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-wider">Tanggal & Jam</th>
                        <th class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-wider">Meja</th>
                        <th class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-wider">Jumlah Orang</th>
                        <th class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($reservasi as $i => $item)
                        <tr class="hover:bg-slate-50/50 transition">
                            <td class="px-6 py-4 font-semibold text-slate-500">{{ $i + 1 }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-blue-500/10 to-indigo-500/10 text-indigo-700 border border-indigo-100/20 font-bold text-[11px] flex items-center justify-center shrink-0 print-avatar">
                                        {{ strtoupper(substr($item->nama_pemesan, 0, 2)) }}
                                    </div>
                                    <div>
                                        <p class="font-bold text-slate-800 text-[13px]">{{ $item->nama_pemesan }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 font-medium text-slate-600">{{ $item->kontak_pemesan }}</td>
                            <td class="px-6 py-4 font-medium text-slate-600">
                                <p class="text-slate-800 font-bold">{{ \Carbon\Carbon::parse($item->tanggal_reservasi)->translatedFormat('d M Y') }}</p>
                                <p class="text-[10px] text-slate-400 font-medium mt-0.5">{{ $item->jam_reservasi }} WITA</p>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-blue-50 border border-blue-100 text-blue-700 rounded-lg font-bold">
                                    Meja {{ $item->meja?->nomor_meja ?? '-' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 font-medium text-slate-700">{{ $item->jumlah_orang }} Orang</td>
                            <td class="px-6 py-4">
                                @php
                                    $statusColors = [
                                        'pending' => 'bg-amber-50 text-amber-700 border-amber-100',
                                        'approved' => 'bg-emerald-50 text-emerald-700 border-emerald-100',
                                        'rejected' => 'bg-rose-50 text-rose-700 border-rose-100',
                                        'completed' => 'bg-blue-50 text-blue-700 border-blue-100',
                                        'cancelled' => 'bg-slate-50 text-slate-700 border-slate-100',
                                    ];
                                @endphp
                                <span class="px-2.5 py-0.5 text-[10px] font-bold rounded-md border {{ $statusColors[$item->status] ?? 'bg-slate-50 border-slate-100' }} uppercase tracking-wider status-badge-container">
                                    {{ $item->status }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-16 text-center text-slate-400">
                                <svg class="w-12 h-12 stroke-current mx-auto mb-3 opacity-60" fill="none" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 13.5h3.86a2.25 2.25 0 0 1 2.008 1.24l.885 1.77a2.25 2.25 0 0 0 2.007 1.24h1.98a2.25 2.25 0 0 0 2.007-1.24l.885-1.77a2.25 2.25 0 0 1 2.007-1.24h3.86m-18 0h18" /></svg>
                                <p class="text-slate-800 font-bold text-sm mb-1">Belum ada data</p>
                                <p class="text-xs text-slate-400">Data laporan tidak ditemukan.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
