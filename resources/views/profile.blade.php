@extends('layouts.master')

@section('title', 'Profile Page')

@section('content')
<div class="container mx-auto p-4">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <!-- Left Side: User Info -->
        <div class="bg-white shadow-md rounded-lg p-4">
<<<<<<< HEAD
            <h2 class="text-2xl mb-4">Profile</h2>
            <p class="mb-2"><strong>Username:</strong> {{ $user->username }}</p>
            <p class="mb-2"><strong>Email:</strong> {{ $user->email }}</p>
            <a type="button" href="{{ route('editProfile') }}" class="text-white bg-yellow-500 hover:bg-yellow-600 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-yellow-400 dark:hover:bg-yellow-500 dark:focus:ring-yellow-600">
                Change Profile
=======
            <h2 class="text-2xl mb-4">Profil</h2>
            <p class="mb-2"><strong>Nama Pengguna:</strong> {{ $user->username }}</p>
            <p class="mb-2"><strong>Alamat email:</strong> {{ $user->email }}</p>
            <a type="button" href="{{ route('editProfile') }}" class="text-white bg-yellow-500 hover:bg-yellow-600 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-yellow-400 dark:hover:bg-yellow-500 dark:focus:ring-yellow-600">
                Ubah Profil
>>>>>>> 50d6e19 (yes)
            </a>
        </div>

        <!-- Right Side: Recent Changes and Profit -->
        <div class="space-y-4">
<<<<<<< HEAD
            <!-- Recent Changes -->
            <div class="bg-white shadow-md rounded-lg p-4">
                <h3 class="text-xl mb-4">Recent Changes</h3>
                <ul>
                    @forelse ($recentChanges as $change)
                        <li class="mb-2">
                            <p class="text-sm text-gray-600">{{ $change->action }} - {{ $change->created_at->format('Y-m-d H:i') }}</p>
                        </li>
                    @empty
                        <li>No recent changes available.</li>
                    @endforelse
                </ul>
                <a href="{{ route('showHistory') }}" class="text-blue-500 hover:underline">View Full History</a>
            </div>

                        <!-- Profit (Reserved Area) -->
=======
            
<div class="bg-white shadow-md rounded-lg p-4 mb-6">
    <h3 class="text-xl mb-4">Perubahan Terkini</h3>
    <ul>
        @forelse ($recentChanges as $change)
            <li class="mb-2">
                <p class="text-sm text-gray-600">{{ $change->action }} - {{ $change->created_at->format('Y-m-d H:i') }}</p>
            </li>
        @empty
            <li>Belum ada perubahan</li>
        @endforelse
    </ul>
    <a href="{{ route('showHistory') }}" class="text-blue-500 hover:underline">Lihat Semua Perubahan</a>
</div>

<!-- Monthly Transactions Section -->
<div class="bg-white shadow-md rounded-lg p-4">
    <h3 class="text-xl mb-4">Rekap Penjualan Terakhir 5 Bulan</h3>
    <ul>
        @forelse ($monthlyTransactions as $transaction)
            <li class="mb-2">
                <p class="text-lg font-semibold">
                    {{ \Carbon\Carbon::create($transaction->year, $transaction->month, 1)->format('F Y') }}:
                    <span class="{{ $transaction->total >= 0 ? 'text-green-600' : 'text-red-600' }}">
                        Rp.{{ number_format($transaction->total, 2) }}
                    </span>
                </p>
            </li>
           @empty
           <li>Belum ada Transaksi</li>
        @endforelse
    </ul>
    <a href="{{ route('monthlyTransactions') }}" class="text-blue-500 hover:underline">Lihat Semua Transaksi Bulanan</a>
</div>

                        {{-- <!-- Profit (Reserved Area) -->
>>>>>>> 50d6e19 (yes)
<div class="bg-white shadow-md rounded-lg p-4">
    <h3 class="text-xl mb-4">Rekap Penjualan Untuk {{ now()->format('F Y') }}</h3>
    <p class="text-lg {{ $profitLoss >= 0 ? 'text-green-500' : 'text-red-500' }}">
        {{ $profitLoss >= 0 ? '+' : '' }}Rp.{{ number_format($profitLoss, 2) }}
    </p>
<<<<<<< HEAD
</div>
=======
</div> --}}
>>>>>>> 50d6e19 (yes)


        </div>
    </div>
</div>
@endsection

