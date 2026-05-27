<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bukti Pembayaran Reservasi - Nugi Bali</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f5f5;
            color: #333;
            line-height: 1.6;
        }

        .invoice-container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        /* Print styles */
        @media print {
            body {
                background: white;
            }
            .invoice-container {
                box-shadow: none;
                border-radius: 0;
                margin: 0;
            }
            .print-button {
                display: none;
            }
        }

        /* Header Section */
        .invoice-header {
            background: linear-gradient(135deg, #1e40af 0%, #0369a1 100%);
            color: white;
            padding: 40px;
            text-align: center;
        }

        .header-logo {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
            margin-bottom: 15px;
        }

        .header-logo img {
            height: 50px;
            width: auto;
        }

        .header-title {
            font-size: 32px;
            font-weight: 700;
            letter-spacing: 1px;
            margin-bottom: 5px;
        }

        .header-subtitle {
            font-size: 14px;
            opacity: 0.9;
        }

        /* Badge Section */
        .invoice-badge {
            display: inline-block;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            padding: 12px 24px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-top: 20px;
        }

        /* Main Content */
        .invoice-content {
            padding: 40px;
        }

        .invoice-info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 40px;
            padding-bottom: 20px;
            border-bottom: 2px solid #e5e7eb;
        }

        .invoice-info-col h3 {
            font-size: 13px;
            color: #6b7280;
            text-transform: uppercase;
            font-weight: 600;
            letter-spacing: 0.5px;
            margin-bottom: 10px;
        }

        .invoice-info-col p {
            font-size: 15px;
            margin-bottom: 5px;
            font-weight: 500;
        }

        /* Booking Code Highlight */
        .booking-code {
            background: linear-gradient(135deg, #1e40af 0%, #0369a1 100%);
            color: white;
            padding: 15px 20px;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 700;
            letter-spacing: 1px;
            text-align: center;
        }

        /* Details Table */
        .details-table {
            width: 100%;
            margin-bottom: 30px;
            border-collapse: collapse;
        }

        .details-table th {
            background: #f3f4f6;
            padding: 15px;
            text-align: left;
            font-size: 13px;
            font-weight: 600;
            text-transform: uppercase;
            color: #6b7280;
            letter-spacing: 0.5px;
            border-bottom: 2px solid #e5e7eb;
        }

        .details-table td {
            padding: 15px;
            border-bottom: 1px solid #e5e7eb;
            font-size: 14px;
        }

        .details-table tbody tr:last-child td {
            border-bottom: none;
        }

        .detail-label {
            color: #6b7280;
            font-weight: 500;
        }

        .detail-value {
            font-weight: 600;
            color: #1f2937;
        }

        /* Amount Section */
        .amount-section {
            background: linear-gradient(135deg, #eff6ff 0%, #e0f2fe 100%);
            border-left: 4px solid #1e40af;
            padding: 25px;
            margin-bottom: 30px;
            border-radius: 6px;
        }

        .amount-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
            font-size: 14px;
        }

        .amount-label {
            color: #6b7280;
            font-weight: 500;
        }

        .amount-value {
            font-weight: 600;
            color: #374151;
        }

        .amount-row.total {
            border-top: 2px solid #d1d5db;
            padding-top: 15px;
            margin-top: 15px;
            font-size: 18px;
        }

        .amount-row.total .amount-label {
            color: #1f2937;
            font-weight: 700;
        }

        .amount-row.total .amount-value {
            color: #1e40af;
            font-weight: 700;
            font-size: 24px;
        }

        /* Information Box */
        .info-box {
            background: #fef3c7;
            border: 2px solid #fcd34d;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 30px;
        }

        .info-box-title {
            font-size: 14px;
            font-weight: 700;
            color: #92400e;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .info-box-list {
            list-style: none;
            space-y: 8px;
        }

        .info-box-list li {
            font-size: 13px;
            color: #92400e;
            margin-bottom: 8px;
            padding-left: 24px;
            position: relative;
        }

        .info-box-list li:before {
            content: "✓";
            position: absolute;
            left: 0;
            font-weight: 700;
            color: #b45309;
        }

        /* Footer */
        .invoice-footer {
            background: #f9fafb;
            padding: 30px 40px;
            border-top: 1px solid #e5e7eb;
            text-align: center;
            font-size: 13px;
            color: #6b7280;
        }

        .footer-divider {
            border-top: 2px dashed #d1d5db;
            margin: 20px 0;
            padding: 20px 0 0 0;
        }

        .footer-text {
            line-height: 1.8;
            margin-bottom: 10px;
        }

        /* Print Button */
        .print-button {
            display: inline-block;
            background: linear-gradient(135deg, #1e40af 0%, #0369a1 100%);
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            margin: 20px;
            transition: all 0.3s ease;
        }

        .print-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(30, 64, 175, 0.3);
        }

        .action-buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
            flex-wrap: wrap;
            padding: 20px;
            background: #f9fafb;
            border-top: 1px solid #e5e7eb;
        }

        .action-buttons button,
        .action-buttons a {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 24px;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .btn-print {
            background: linear-gradient(135deg, #1e40af 0%, #0369a1 100%);
            color: white;
        }

        .btn-print:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(30, 64, 175, 0.3);
        }

        .btn-download {
            background: linear-gradient(135deg, #059669 0%, #047857 100%);
            color: white;
        }

        .btn-download:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(5, 150, 105, 0.3);
        }

        .btn-back {
            background: #6b7280;
            color: white;
        }

        .btn-back:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(107, 114, 128, 0.3);
        }

        @media print {
            .action-buttons {
                display: none;
            }
        }

        /* Spacing utilities */
        .mb-0 { margin-bottom: 0; }
        .mb-10 { margin-bottom: 10px; }
        .mb-20 { margin-bottom: 20px; }
        .mt-20 { margin-top: 20px; }

        /* Status badge styling */
        .status-approved {
            display: inline-block;
            background: #d1fae5;
            color: #065f46;
            padding: 6px 12px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 600;
        }

        /* QR Code / Reference */
        .reference-section {
            text-align: center;
            padding: 20px;
            background: #f9fafb;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        .reference-label {
            font-size: 11px;
            color: #9ca3af;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 5px;
        }

        .reference-code {
            font-size: 13px;
            font-weight: 700;
            color: #1f2937;
            font-family: 'Courier New', monospace;
        }
    </style>
</head>
<body>
    <div class="invoice-container">
        <!-- Header -->
        <div class="invoice-header">
            <div class="header-logo">
                <img src="{{ asset('assets/images/logo.png') }}" alt="NUGI BALI">
                <span class="header-title">NUGI BALI</span>
            </div>
            <div class="header-subtitle">BUKTI PEMBAYARAN RESERVASI</div>
            <div class="invoice-badge">✓ PEMBAYARAN DIKONFIRMASI</div>
        </div>

        <!-- Content -->
        <div class="invoice-content">
            <!-- Booking Code -->
            <div class="booking-code mb-20">
                KODE BOOKING: #{{ str_pad($reservasi->id, 8, '0', STR_PAD_LEFT) }}
            </div>

            <!-- Customer & Reservation Info -->
            <div class="invoice-info-row">
                <div class="invoice-info-col">
                    <h3>Data Pemesan</h3>
                    <p class="detail-value">{{ $reservasi->nama_pemesan }}</p>
                    <p class="detail-label">
                        @php
                            $countryFlags = ['ID' => '🇮🇩', 'MY' => '🇲🇾', 'SG' => '🇸🇬', 'TH' => '🇹🇭', 'PH' => '🇵🇭'];
                            $flag = $countryFlags[$reservasi->country_code ?? 'ID'] ?? '🌍';
                        @endphp
                        {{ $flag }} {{ $reservasi->kontak_pemesan }}
                    </p>
                    <p class="detail-label">{{ $reservasi->user->email }}</p>
                </div>
                <div class="invoice-info-col">
                    <h3>Tanggal Pemesanan</h3>
                    <p class="detail-value">{{ \Carbon\Carbon::parse($reservasi->created_at)->format('d F Y') }}</p>
                    <p class="detail-label">{{ \Carbon\Carbon::parse($reservasi->created_at)->format('H:i') }}</p>
                </div>
            </div>

            <!-- Details Table -->
            <table class="details-table">
                <thead>
                    <tr>
                        <th style="width: 40%;">Keterangan</th>
                        <th style="width: 30%; text-align: center;">Detail</th>
                        <th style="width: 30%; text-align: right;">Harga</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="detail-label">Reservasi Meja</td>
                        <td style="text-align: center;">
                            <span class="detail-value">Meja {{ $meja->nomor_meja }}</span>
                        </td>
                        <td style="text-align: right;">
                            <span class="detail-value">Rp {{ number_format($meja->harga ?? 0, 0, ',', '.') }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="detail-label">Tanggal Reservasi</td>
                        <td style="text-align: center;">
                            <span class="detail-value">{{ \Carbon\Carbon::parse($reservasi->tanggal_reservasi)->format('d F Y') }}</span>
                        </td>
                        <td style="text-align: right;">-</td>
                    </tr>
                    <tr>
                        <td class="detail-label">Waktu Reservasi</td>
                        <td style="text-align: center;">
                            <span class="detail-value">{{ $reservasi->jam_reservasi }}</span>
                        </td>
                        <td style="text-align: right;">-</td>
                    </tr>
                    <tr>
                        <td class="detail-label">Jumlah Orang</td>
                        <td style="text-align: center;">
                            <span class="detail-value">{{ $reservasi->jumlah_orang }} Orang</span>
                        </td>
                        <td style="text-align: right;">-</td>
                    </tr>
                </tbody>
            </table>

            <!-- Amount Section -->
            <div class="amount-section">
                <div class="amount-row">
                    <span class="amount-label">Harga Meja</span>
                    <span class="amount-value">Rp {{ number_format($meja->harga ?? 0, 0, ',', '.') }}</span>
                </div>
                <div class="amount-row">
                    <span class="amount-label">Diskon</span>
                    <span class="amount-value">-</span>
                </div>
                <div class="amount-row">
                    <span class="amount-label">Pajak/Admin</span>
                    <span class="amount-value">-</span>
                </div>
                <div class="amount-row total">
                    <span class="amount-label">TOTAL PEMBAYARAN</span>
                    <span class="amount-value">Rp {{ number_format($meja->harga ?? 0, 0, ',', '.') }}</span>
                </div>
            </div>

            <!-- Status -->
            <div class="invoice-info-row" style="border-bottom: none;">
                <div class="invoice-info-col">
                    <h3>Status Pembayaran</h3>
                    <span class="status-approved">✓ SUDAH TERBAYAR</span>
                </div>
                <div class="invoice-info-col">
                    <h3>Status Reservasi</h3>
                    <span class="status-approved">✓ DISETUJUI</span>
                </div>
            </div>

            <!-- Information Box -->
            <div class="info-box">
                <div class="info-box-title">📋 INFORMASI PENTING</div>
                <ul class="info-box-list">
                    <li>Admin akan menghubungi Anda melalui telepon yang tercatat</li>
                    <li>Simpan Kode Booking untuk referensi</li>
                    <li>Harap tiba 10 menit sebelum waktu yang dijadwalkan</li>
                    <li>Jika ingin membatalkan, hubungi kami sebelum 24 jam</li>
                    <li>Bukti pembayaran ini berlaku sebagai tiket masuk</li>
                </ul>
            </div>

            <!-- Reference Section -->
            <div class="reference-section">
                <div class="reference-label">Nomor Referensi Transaksi</div>
                <div class="reference-code">RES-{{ date('Ymd', strtotime($reservasi->created_at)) }}-{{ str_pad($reservasi->id, 5, '0', STR_PAD_LEFT) }}</div>
            </div>
        </div>

        <!-- Footer -->
        <div class="invoice-footer">
            <div class="footer-divider"></div>
            <div class="footer-text">
                <strong>NUGI BALI</strong> - Restaurant & Coffee Shop<br>
                {{ config('app.url') }}
            </div>
            <div class="footer-text" style="font-size: 11px; color: #9ca3af;">
                Dokumen ini dicetak pada {{ \Carbon\Carbon::now()->format('d F Y H:i') }}<br>
                Bukti pembayaran ini sah dan berlaku sebagai tiket masuk
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="action-buttons">
        <a href="{{ route('reservasi.success', $reservasi->id) }}" class="btn-back">
            ← Kembali
        </a>
        <button type="button" onclick="saveInvoiceAsPNG()" class="btn-download">
            📥 Save as PNG
        </button>
        <button type="button" onclick="window.print()" class="btn-print">
            🖨️ Cetak
        </button>
    </div>

    <script>
        function saveInvoiceAsPNG() {
            const btn = event.target;
            const element = document.querySelector('.invoice-container');
            const filename = 'Bukti-Pembayaran-{{ str_pad($reservasi->id, 8, '0', STR_PAD_LEFT) }}.png';
            
            if (!element) {
                alert('Elemen invoice tidak ditemukan');
                return;
            }

            // Show loading message
            const originalText = btn.textContent;
            btn.textContent = '⏳ Memproses...';
            btn.disabled = true;

            // Clone element for better rendering
            const clonedElement = element.cloneNode(true);
            
            setTimeout(() => {
                html2canvas(element, {
                    scale: 2,
                    logging: false,
                    backgroundColor: '#ffffff',
                    useCORS: true,
                    allowTaint: true,
                    imageTimeout: 0,
                    timeout: 0
                }).then(canvas => {
                    try {
                        // Create download link
                        const link = document.createElement('a');
                        link.href = canvas.toDataURL('image/png');
                        link.download = filename;
                        
                        // Trigger download
                        document.body.appendChild(link);
                        link.click();
                        document.body.removeChild(link);
                        
                        // Reset button
                        btn.textContent = originalText;
                        btn.disabled = false;
                    } catch (downloadError) {
                        console.error('Download error:', downloadError);
                        alert('Gagal mengunduh gambar. Silakan coba lagi.');
                        btn.textContent = originalText;
                        btn.disabled = false;
                    }
                }).catch(error => {
                    console.error('Error generating PNG:', error);
                    btn.textContent = originalText;
                    btn.disabled = false;
                    alert('Gagal membuat gambar. Silakan coba lagi atau gunakan fitur cetak.');
                });
            }, 100);
        }
    </script>
</body>
</html>
