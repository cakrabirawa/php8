@extends('layouts.app')

@section('title', 'Data Pengguna')

@section('content')
    <input type="hidden" id="ajax-title-bridge" value="Data Pengguna">

    <div class="space-y-6">
        <h1 class="text-2xl font-bold text-gray-900">👥 Daftar Pengguna Sistem</h1>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <p class="text-gray-600">Halaman data manajemen user internal server.</p>
        </div>
    </div>
@endsection