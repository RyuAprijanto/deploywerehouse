@extends('layouts.master')
<<<<<<< HEAD
@section('title, Restock')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-semibold mb-6">Restock Products</h1>
=======

@section('title', 'Restock')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-semibold mb-6">Restock Produk</h1>

    <!-- Search and filter form -->
    <form method="GET" action="{{ route('showRestockPage') }}" class="mb-6">
        @csrf
        <div class="flex mb-4">
            <!-- Search input -->
            <input 
                type="text" 
                name="search" 
                value="{{ $searchTerm }}" 
                placeholder="Cari Produk" 
                class="w-full px-3 py-2 border border-gray-300 rounded"
            />
            
            <!-- Type filter -->
            <select 
                name="type" 
                class="ml-4 px-3 py-2 border border-gray-300 rounded" 
                onchange="this.form.submit()">
                <option value="">Semua</option>
                @foreach ($allTypes as $type)
                    <option value="{{ $type }}" {{ $selectedType == $type ? 'selected' : '' }}>
                        {{ $type }}
                    </option>
                @endforeach
            </select>
        </div>
    </form>
>>>>>>> 50d6e19 (yes)

    <form action="{{ route('processRestock') }}" method="POST">
        @csrf
        <table class="min-w-full bg-white border">
            <thead>
                <tr>
<<<<<<< HEAD
                    <th class="py-2 px-4 border-b">Select</th>
                    <th class="py-2 px-4 border-b">Product Name</th>
                    <th class="py-2 px-4 border-b">Current Stock</th>
                    <th class="py-2 px-4 border-b">Expired Date</th>
                    <th class="py-2 px-4 border-b">Quantity to Restock</th>
=======
                    <th class="py-2 px-4 border-b">Pilih</th>
                    <th class="py-2 px-4 border-b">Nama Produk</th>
                    <th class="py-2 px-4 border-b">Stok Produk</th>
                    <th class="py-2 px-4 border-b">Tanggal Kedaluarsa</th>
                    <th class="py-2 px-4 border-b">Jumlah Stok</th>
>>>>>>> 50d6e19 (yes)
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                <tr>
                    <td class="py-2 px-4 border-b">
                        <input type="checkbox" name="products[]" value="{{ $product->id }}">
                    </td>
                    <td class="py-2 px-4 border-b">{{ $product->name }}</td>
                    <td class="py-2 px-4 border-b">{{ $product->stock }}</td>
                    <td class="py-2 px-4 border-b">{{ $product->expired_date }}</td>
                    <td class="py-2 px-4 border-b">
                        <input type="number" name="restock_qty[{{ $product->id }}]" min="1" class="w-full px-3 h-10 rounded border-2 border-gray-300 focus:outline-none focus:border-gray-700">
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

<<<<<<< HEAD
        <button type="submit" class="mt-6 px-4 py-2 bg-blue-600 text-white font-semibold hover:bg-blue-700">Restock Selected Products</button>
    </form>
=======
        <button type="submit" class="mt-6 px-4 py-2 bg-blue-600 text-white font-semibold hover:bg-blue-700">Restock Product Yang Dipilih</button>
    </form>

    
    <div class="mt-6">
        {{ $products->links() }}
    </div>
>>>>>>> 50d6e19 (yes)
</div>
@endsection
