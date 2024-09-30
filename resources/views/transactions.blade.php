@extends('layouts.master')

@section('content')
<div class="container flex flex-col w-screen justify-center py-8 px-3 items-center">
    <h1 class="text-2xl font-semibold mb-6">Rincian Transaksi</h1>

    <div class="flex flex-col mb-8 justify-center items-center p-4">
        <h2 class="text-xl font-medium mb-4">Transaksi Bulanan</h2>
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

        <div class="mb-6">
            <a href="{{ route('monthlyTransactions') }}" class="text-blue-600 hover:underline">
                Lihat semua transaksi bulanan
            </a>
        </div>
    </div>

    <!-- Filter Form -->
    <div class="mb-6">
        <form id="filterForm" action="{{ route('viewTransactions') }}" method="GET">
            <div class="flex gap-4">
                <div>
                    <label for="month" class="block text-lg font-medium mb-1">Bulan:</label>
                    <select name="month" id="month" class="px-3 py-2 border rounded">
                        <option value="All" {{ request('month') == 'All' ? 'selected' : '' }}>Pilih Bulan</option>
                        @foreach (range(1, 12) as $month)
                            <option value="{{ $month }}" {{ request('month') == $month ? 'selected' : '' }}>
                                {{ \Carbon\Carbon::createFromDate(null, $month, 1)->format('F') }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="year" class="block text-lg font-medium mb-1">Tahun:</label>
                    <select name="year" id="year" class="px-3 py-2 border rounded">
                        @for ($year = now()->year; $year >= now()->year - 10; $year--)
                            <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>
                                {{ $year }}
                            </option>
                        @endfor
                    </select>
                </div>
            </div>
        </form>
    </div>

    <div class="flex mb-4">
        <a href="{{ route('addTransaction') }}" class="px-4 py-2 bg-blue-600 hover:bg-blue-800 text-white font-semibold rounded-md">
            Transaksi Baru
        </a>
    </div>

    <h2 class="text-xl font-medium mb-4">Riwayat Transaksi</h2>
    <table class="min-w-full bg-white border mb-6">
        <thead>
            <tr>
                <th class="py-2 px-4 border-b">Tanggal</th>
                <th class="py-2 px-4 border-b">Tipe Transaksi</th>
                <th class="py-2 px-4 border-b">Jumlah Harga</th>
                <th class="py-2 px-4 border-b">Keterangan Transaksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $transaction)
            <tr>
                <td class="py-2 px-4 border-b">{{ $transaction->date }}</td>
                <td class="py-2 px-4 border-b">{{ $transaction->transactionType->name }}</td>
                <td class="py-2 px-4 border-b">Rp.{{ number_format($transaction->price, 2) }}</td>
                <td class="py-2 px-4 border-b">{{ $transaction->description }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-">
        {{ $transactions->links() }}
    </div>
</div>

<script>
    document.getElementById('month').addEventListener('change', function() {
        document.getElementById('filterForm').submit();
    });

    document.getElementById('year').addEventListener('change', function() {
        document.getElementById('filterForm').submit();
    });
</script>

@endsection






