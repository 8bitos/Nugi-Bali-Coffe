@php
    $logoPath = null;
    if (!empty($info->logo) && file_exists(storage_path('app/public/' . $info->logo))) {
        $logoPath = storage_path('app/public/' . $info->logo);
    } elseif (file_exists(public_path('assets/images/logo.png'))) {
        $logoPath = public_path('assets/images/logo.png');
    }

    $logoBase64 = null;
    if ($logoPath) {
        $logoData = base64_encode(file_get_contents($logoPath));
        $logoMime = mime_content_type($logoPath);
        $logoBase64 = 'data:' . $logoMime . ';base64,' . $logoData;
    }
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Laporan Reservasi - {{ $info->nama_web ?? 'Nugi Bali' }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Helvetica', 'Arial', sans-serif; font-size: 11px; color: #333; }
        .header-table { width: 100% !important; margin: 0 !important; background: #1E40AF; padding: 20px 30px; margin-bottom: 20px; border-collapse: collapse; }
        .header-table td { border: none !important; padding: 0 !important; color: white; }
        .filter-info { padding: 0 30px; margin-bottom: 15px; font-size: 11px; color: #666; }
        .filter-info span { background: #EFF6FF; padding: 3px 8px; border-radius: 3px; margin-right: 8px; color: #1E40AF; font-weight: 600; }
        table { width: calc(100% - 60px); border-collapse: collapse; margin: 0 30px; }
        th { background: #F3F4F6; padding: 8px 10px; text-align: left; font-size: 10px; text-transform: uppercase; color: #6B7280; border-bottom: 2px solid #E5E7EB; }
        td { padding: 7px 10px; border-bottom: 1px solid #E5E7EB; font-size: 10px; }
        tbody tr:nth-child(even) { background: #F9FAFB; }
        .status-badge { padding: 2px 8px; border-radius: 10px; font-size: 9px; font-weight: 600; }
        .status-pending { background: #FEF3C7; color: #92400E; }
        .status-approved { background: #D1FAE5; color: #065F46; }
        .status-rejected { background: #FEE2E2; color: #991B1B; }
        .status-completed { background: #DBEAFE; color: #1E40AF; }
        .status-cancelled { background: #F3F4F6; color: #6B7280; }
        .footer { margin-top: 20px; padding: 15px 30px; border-top: 1px solid #E5E7EB; font-size: 9px; color: #9CA3AF; text-align: center; }
        .summary { padding: 10px 30px; margin-bottom: 10px; }
        .summary span { font-weight: 700; color: #1E40AF; }
    </style>
</head>
<body>
    <table class="header-table">
        <tr>
            @if($logoBase64)
            <td style="width: 50px; vertical-align: middle; padding: 0;">
                <img src="{{ $logoBase64 }}" style="height: 40px; width: auto; display: block; border-radius: 6px;" alt="Logo">
            </td>
            <td style="padding-left: 15px; vertical-align: middle;">
            @else
            <td style="vertical-align: middle;">
            @endif
                <h1 style="font-size: 20px; font-weight: bold; margin: 0; line-height: 1.2;">{{ strtoupper($info->nama_web ?? 'Nugi Bali') }}</h1>
                <p style="font-size: 11px; margin: 2px 0 0 0; opacity: 0.9;">Laporan Data Reservasi</p>
            </td>
            <td style="text-align: right; vertical-align: middle; font-size: 9px; opacity: 0.8; line-height: 1.4;">
                @if(!empty($info->alamat))
                    {{ $info->alamat }}<br>
                @endif
                @if(!empty($info->kontak_telepon))
                    Telp: {{ $info->kontak_telepon }}
                @endif
                @if(!empty($info->kontak_email))
                    | Email: {{ $info->kontak_email }}
                @endif
            </td>
        </tr>
    </table>

    @if($status || $dariTanggal || $sampaiTanggal)
        <div class="filter-info">
            Filter: 
            @if($status)
                <span>Status: {{ ucfirst($status) }}</span>
            @endif
            @if($dariTanggal)
                <span>Dari: {{ $dariTanggal }}</span>
            @endif
            @if($sampaiTanggal)
                <span>Sampai: {{ $sampaiTanggal }}</span>
            @endif
        </div>
    @endif

    <div class="summary">
        Total data: <span>{{ $reservasi->count() }}</span> reservasi
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 4%;">No</th>
                <th style="width: 18%;">Nama Pemesan</th>
                <th style="width: 14%;">Kontak</th>
                <th style="width: 8%;">Meja</th>
                <th style="width: 12%;">Tanggal</th>
                <th style="width: 8%;">Jam</th>
                <th style="width: 8%;">Orang</th>
                <th style="width: 10%;">Status</th>
                <th style="width: 14%;">Pembayaran</th>
            </tr>
        </thead>
        <tbody>
            @forelse($reservasi as $i => $item)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $item->nama_pemesan }}</td>
                    <td>{{ $item->kontak_pemesan }}</td>
                    <td>{{ $item->meja?->nomor_meja ?? '-' }}</td>
                    <td>{{ $item->tanggal_reservasi }}</td>
                    <td>{{ $item->jam_reservasi }}</td>
                    <td>{{ $item->jumlah_orang }}</td>
                    <td>
                        <span class="status-badge status-{{ $item->status }}">{{ ucfirst($item->status) }}</span>
                    </td>
                    <td>
                        @php
                            $paymentLabels = ['transfer_bank' => 'Transfer Bank', 'card' => 'Kartu', 'ewallet' => 'E-Wallet'];
                        @endphp
                        {{ $paymentLabels[$item->payment_method] ?? '-' }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" style="text-align: center; padding: 20px; color: #9CA3AF;">Tidak ada data reservasi</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        Dicetak pada: {{ now()->format('d F Y H:i') }} | {{ $info->nama_web ?? 'Nugi Bali' }} - Restaurant & Coffee Shop
    </div>
</body>
</html>
