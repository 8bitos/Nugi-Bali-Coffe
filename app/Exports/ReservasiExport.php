<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ReservasiExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithColumnWidths
{
    protected Collection $reservasi;
    protected int $row = 0;

    public function __construct(Collection $reservasi)
    {
        $this->reservasi = $reservasi;
    }

    public function collection(): Collection
    {
        return $this->reservasi;
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama Pemesan',
            'Kontak',
            'Meja',
            'Tanggal Reservasi',
            'Jam',
            'Jumlah Orang',
            'Status',
            'Metode Pembayaran',
            'Dibuat Pada',
        ];
    }

    public function map($reservasi): array
    {
        $this->row++;
        $paymentLabels = [
            'transfer_bank' => 'Transfer Bank',
            'card' => 'Kartu Kredit/Debit',
            'ewallet' => 'E-Wallet',
        ];

        return [
            $this->row,
            $reservasi->nama_pemesan,
            $reservasi->kontak_pemesan,
            $reservasi->meja?->nomor_meja ?? '-',
            $reservasi->tanggal_reservasi,
            $reservasi->jam_reservasi,
            $reservasi->jumlah_orang,
            ucfirst($reservasi->status),
            $paymentLabels[$reservasi->payment_method] ?? '-',
            $reservasi->created_at?->format('d/m/Y H:i'),
        ];
    }

    public function styles(Worksheet $sheet): array
    {
        return [
            1 => [
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '1E40AF'],
                ],
                'alignment' => ['horizontal' => 'center'],
            ],
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 5,
            'B' => 25,
            'C' => 20,
            'D' => 12,
            'E' => 18,
            'F' => 10,
            'G' => 15,
            'H' => 12,
            'I' => 22,
            'J' => 18,
        ];
    }
}
