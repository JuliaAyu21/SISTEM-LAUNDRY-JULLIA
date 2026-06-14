<?php

namespace App\Exports;

use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TransactionExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * Ambil semua data transaksi
     */
    public function collection()
    {
        return Transaction::with(['order', 'user'])->get();
    }

    /**
     * Header kolom Excel
     */
    public function headings(): array
    {
        return [
            'ID Transaksi',
            'Order ID',
            'Nama User',
            'Jumlah Transaksi',
            'Metode Pembayaran',
            'Tanggal Transaksi',
            'Status',
        ];
    }

    /**
     * Mapping data ke kolom Excel
     */
    public function map($transaction): array
    {
        return [
            $transaction->id_transaksi,
            $transaction->id_order,
            $transaction->user->name ?? '-',
            $transaction->jumlah_transaksi,
            $transaction->method_payment,
            $transaction->transaksi_date,
            $transaction->transaksi_status,
        ];
    }
}
