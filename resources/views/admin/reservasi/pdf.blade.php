<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Laporan Reservasi - Nugi Bali</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Helvetica', 'Arial', sans-serif; font-size: 11px; color: #333; }
        .header { background: #1E40AF; color: white; padding: 20px 30px; margin-bottom: 20px; }
        .header h1 { font-size: 20px; margin-bottom: 3px; }
        .header p { font-size: 11px; opacity: 0.9; }
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
    <div class="header">
        <h1>NUGI BALI</h1>
        <p>Laporan Data Reservasi</p>
    </div>

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
        @if(!$status && !$dariTanggal && !$sampaiTanggal)
            <span>Semua Data</span>
        @endif
    </div>

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
        Dicetak pada: {{ now()->format('d F Y H:i') }} | NUGI BALI - Restaurant & Coffee Shop
    </div>
</body>
</html>
