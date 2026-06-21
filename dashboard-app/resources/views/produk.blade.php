@extends('layouts.app')

@section('title', 'Manajemen Produk')

@section('content')
    <input type="hidden" id="ajax-title-bridge" value="Manajemen Produk">

    <div class="space-y-6">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-900">📦 Utara Data Produk</h1>
            <button class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition">
                + Tambah Produk
            </button>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <p class="text-gray-600">Berhasil! Konten ini berpindah mulus tanpa melipatgandakan komponen sidebar.</p>
        </div>
    </div>
@endsection