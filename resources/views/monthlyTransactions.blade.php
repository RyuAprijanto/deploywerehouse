@extends('layouts.master')

@section('content')
<div class="container flex flex-col justify-center py-8 px-3">
    <h1 class="text-2xl font-semibold mb-6">Semua Transaksi Bulanan</h1>

    <table class="min-w-full bg-white border mb-6">
        <thead>
            <tr>
                <th class="py-2 px-4 border-b">Tahun</th>
                <th class="py-2 px-4 border-b">Bulan</th>
                <th class="py-2 px-4 border-b">Jumlah Harga</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($monthlyTransactions as $monthly)
            <tr>
                <td class="py-2 px-4 border-b">{{ $monthly->year }}</td>
                <td class="py-2 px-4 border-b">{{ \Carbon\Carbon::createFromDate($monthly->year, $monthly->month, 1)->format('F') }}</td>
                <td class="py-2 px-4 border-b {{ $monthly->total >= 0 ? 'text-green-600' : 'text-red-600' }}">
                    Rp.{{ number_format($monthly->total, 2) }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    <div class="mt-4">
        {{ $monthlyTransactions->links() }}
    </div>

    <div class="mt-4">
        <a href="{{ route('viewTransactions') }}" class="text-blue-600 hover:underline">
            Kembali ke Transaksi Saat Ini
        </a>
    </div>
</div>
@endsection
