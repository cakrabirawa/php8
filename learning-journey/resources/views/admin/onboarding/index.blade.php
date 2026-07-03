<x-app-layout>
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Onboarding Checklist – Admin Review
    </h2>
</x-slot>

<div class="py-8">
<div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

@if(session('success'))
<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
    {{ session('success') }}
</div>
@endif

{{-- SEARCH + EDIT TEMPLATE BUTTON --}}
<div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-3">

    {{-- SEARCH --}}
    <form method="GET" class="flex items-center gap-3">
        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Search name / employee ID / store..."
            class="w-full md:w-96 border rounded-lg px-4 py-2 focus:ring focus:ring-blue-200"
        >

        <button
            type="submit"
            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
            Search
        </button>
    </form>

    {{-- BUTTON EDIT TEMPLATE --}}
    <a href="{{ route('admin.onboarding.template.edit', ['month' => 1, 'week' => 1]) }}"
       class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 text-center">
        Edit Checklist Template
    </a>

</div>

{{-- CARDS --}}
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">

@foreach($cards as $card)

{{-- ================================================= --}}
{{-- ✅ SUMMARY CARD (6 MONTHS COMPLETED) --}}
{{-- ================================================= --}}
@if($card['type'] === 'summary')

<a href="{{ route('admin.checklist.summary', $card['employee_id']) }}">
<div class="bg-green-50 border border-green-300 shadow rounded-xl p-6 hover:shadow-lg transition">

    <h3 class="text-xl font-bold text-gray-900">
        {{ $card['employee']->name }}
    </h3>

    <p class="text-sm text-gray-600 mt-1">
        Store: {{ $card['employee']->store->name ?? '-' }}
    </p>

    <span class="inline-block mt-4 px-3 py-1 rounded-lg text-sm font-medium
        {{ ($card['is_full'] ?? false)
            ? 'bg-blue-100 text-blue-700'
            : 'bg-green-100 text-green-700' }}">

        {{ ($card['is_full'] ?? false)
            ? 'Onboarding Completed (Auto Approved)'
            : 'Onboarding Completed (6 Months Approved)' }}

    </span>
</div>
</a>

{{-- ================================================= --}}
{{-- 📅 MONTHLY CARD --}}
{{-- ================================================= --}}
@else
@php
    $items = $card['items'];
    $first = $items->first();
    $employee = $first->employee;
    $month = $first->month;

    $monthStatus = 'pending';
    if ($items->every(fn($i) => $i->status === 'approved')) {
        $monthStatus = 'approved'; 
    } elseif ($items->contains(fn($i) => $i->status === 'rejected')) {
        $monthStatus = 'rejected';
    }
@endphp

<a href="{{ route('admin.checklist.show', $first->id) }}">
<div class="bg-white shadow-md rounded-xl p-6 border hover:shadow-lg transition">

<div class="flex justify-between items-center mb-4">
    <div>
        <h3 class="text-xl font-bold text-gray-900">
            {{ $employee->name }}
        </h3>
        <p class="text-sm text-gray-600">
            Store: {{ $employee->store->name ?? '-' }}
        </p>
        <p class="text-sm text-gray-600 mt-1">
            Bulan ke-{{ $month }}
        </p>
    </div>

    @if($monthStatus !== 'pending')
        <span class="px-3 py-1 rounded-lg text-sm font-medium
            {{ $monthStatus === 'approved'
                ? 'bg-green-100 text-green-700 border border-green-300'
                : 'bg-red-100 text-red-700 border border-red-300' }}">
            {{ ucfirst($monthStatus) }}
        </span>
    @endif
</div>

@if($monthStatus === 'pending')
<div class="border-t pt-4 flex justify-end">
    <form action="{{ route('admin.checklist.updateMonthStatus') }}" method="POST">
        @csrf
        <input type="hidden" name="employee_id" value="{{ $first->employee_id }}">
        <input type="hidden" name="month" value="{{ $month }}">
        <input type="hidden" name="status" value="approved">

        <button class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
            Approve
        </button>
    </form>
</div>
@endif

</div>
</a>

@endif
@endforeach

</div>

{{-- PAGINATION --}}
<div class="mt-4">
    {{ $cards->links() }}
</div>

</div>
</div>
</x-app-layout>
