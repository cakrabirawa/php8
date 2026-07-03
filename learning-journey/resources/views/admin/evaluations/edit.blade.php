<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Edit Evaluation</h2>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto">
    {{-- Notifikasi Sukses --}}
    @if (session('success'))
        <div class="mb-4 p-4 bg-green-100 border-l-4 border-green-500 text-green-700">
            {{ session('success') }}
        </div>
    @endif

    {{-- Notifikasi Error Custom (Total > 500) --}}
    @if (session('error'))
        <div class="mb-4 p-4 bg-red-100 border-l-4 border-red-500 text-red-700">
            {{ session('error') }}
        </div>
    @endif

    {{-- Notifikasi Error Validasi Laravel (min/max/required) --}}
    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-50 border-l-4 border-red-500 text-red-600">
            <ul class="list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
        <form method="POST" action="{{ route('admin.evaluations.update', $employee_evaluation->id) }}">

            @csrf
            @method('PUT')

        <div class="mb-4">
            <label>Employee</label>

            <!-- Select terlihat, tapi tidak bisa diedit -->
            <select class="border p-2 w-full rounded" disabled>
                @foreach($employees as $emp)
                    <option value="{{ $emp->employee_id }}"
                        {{ $emp->employee_id == $employee_evaluation->employee_id ? 'selected' : '' }}>
                        {{ $emp->employee_id }} - {{ $emp->name }}
                    </option>
                @endforeach
            </select>

            <!-- Hidden input supaya tetap terkirim ke server -->
            <input type="hidden" name="employee_id" value="{{ $employee_evaluation->id }}">
        </div>

{{-- ================= LATEST KPI (READ ONLY) ================= --}}
@php
    $latestKpiPeriod = $employee_evaluation->kpi_december !== null
        ? 'December'
        : 'June';

    $latestKpiValue = $employee_evaluation->kpi_december
        ?? $employee_evaluation->kpi_june;
@endphp

<div class="mb-6 bg-gray-50 border rounded-lg p-4">
    <h3 class="text-lg font-semibold mb-3">
        Latest KPI ({{ $latestKpiPeriod }})
    </h3>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
        <div>
            <div class="text-gray-500">Business</div>
            <div class="font-semibold">
                {{ $employee_evaluation->business_score ?? '-' }}
            </div>
        </div>

        <div>
            <div class="text-gray-500">Behavior</div>
            <div class="font-semibold">
                {{ $employee_evaluation->behavior_score ?? '-' }}
            </div>
        </div>

        <div>
            <div class="text-gray-500">PA</div>
            <div class="font-semibold">
                {{ $employee_evaluation->pa_score ?? '-' }}
            </div>
        </div>

        <div>
            <div class="text-gray-500">Total KPI</div>
            <div class="font-bold text-indigo-600 text-lg">
                {{ $latestKpiValue ?? '-' }}
            </div>
        </div>
    </div>
</div>

{{-- ================= KPI CURRENT YEAR ================= --}}
<div class="mt-6">
    <h3 class="font-semibold mb-3">Update KPI – Current Year</h3>

    <div class="grid grid-cols-3 gap-4">
        <div>
            <label class="block mb-1">Business Score</label>
            <input type="number" step="0.01" name="business_score"
                class="border p-2 w-full rounded"
                value="{{ old('business_score', $employee_evaluation->business_score) }}">
        </div>

        <div>
            <label class="block mb-1">Behavior Score</label>
            <input type="number" step="0.01" name="behavior_score"
                class="border p-2 w-full rounded"
                value="{{ old('behavior_score', $employee_evaluation->behavior_score) }}">
        </div>

        <div>
            <label class="block mb-1">PA Score</label>
            <input type="number" step="0.01" name="pa_score"
                class="border p-2 w-full rounded"
                value="{{ old('pa_score', $employee_evaluation->pa_score) }}">
        </div>
    </div>


{{-- ================= ASSESSMENT ================= --}}
<div class="mt-6">
    <label class="block mb-1">Assessment Link</label>
    <input type="text" name="assessment_link"
        class="border p-2 w-full rounded"
        value="{{ old('assessment_link', $employee_evaluation->assessment_link) }}">
</div>

{{-- ================= ACTION ================= --}}
<button class="mt-6 bg-blue-600 text-white px-5 py-2 rounded">
    Update
</button>


    </div>
</x-app-layout>
