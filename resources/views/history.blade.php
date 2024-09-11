@extends('layouts.master')

@section('document_title', 'History')

@section('content')
<div class="container mx-auto p-4">
    <h2 class="text-2xl mb-4">Riwayat Pengguna</h2>

<<<<<<< HEAD
    <table class="table-auto w-full mb-4">
        <thead>
            <tr>
                <th class="px-4 py-2">Aksi</th>
                <th class="px-4 py-2">Keterangan</th>
                <th class="px-4 py-2">Tanggal</th>
=======
    <table class="min-w-full bg-white border">
        <thead>
            <tr>
                <th class="py-2 px-4 border-b">Aksi</th>
                <th class="py-2 px-4 border-b">Keterangan</th>
                <th class="py-2 px-4 border-b">Tanggal</th>
>>>>>>> 50d6e19 (yes)
            </tr>
        </thead>
        <tbody>
            @foreach ($history as $histories)
            <tr>
                <td class="border px-4 py-2">{{ $histories->action }}</td>
                <td class="border px-4 py-2">{{ $histories->details }}</td>
                <td class="border px-4 py-2">{{ $histories->created_at->toDayDateTimeString() }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $history->links() }} 
    </div>
</div>
@endsection

