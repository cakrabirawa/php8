<x-app-layout>

<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Onboarding Summary – {{ $employee->name }}
    </h2>
</x-slot>

<div class="py-8">
<div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

{{-- EMPLOYEE INFO --}}
<div class="bg-white shadow rounded-lg p-6 mb-8 border">
    <h3 class="text-xl font-bold text-gray-900">
        {{ $employee->name }}
    </h3>

    <p class="text-sm text-gray-600 mt-1">
        Store: {{ $employee->store->name ?? '-' }}
    </p>

    <span class="inline-block mt-3 px-3 py-1 rounded-lg
        bg-green-100 text-green-700 text-sm font-medium">
        Onboarding Completed
    </span>
</div>

{{-- MONTH LIST --}}
@foreach($months as $month => $data)

<div class="bg-white shadow-md rounded-lg p-6 mb-6 border">

    <div class="flex justify-between items-center mb-4">
        <h3 class="text-lg font-semibold">
            Month {{ $month }}
        </h3>

        <span class="px-3 py-1 rounded-lg text-sm font-medium
            {{ $data['status'] === 'approved'
                ? 'bg-green-100 text-green-700 border border-green-300'
                : ($data['status'] === 'rejected'
                    ? 'bg-red-100 text-red-700 border border-red-300'
                    : 'bg-gray-100 text-gray-600') }}">
            {{ ucfirst($data['status']) }}
        </span>
    </div>

    {{-- MONTH HR NOTES --}}
    @if(!empty($data['notes_hr']))
        <div class="mb-4 p-4 bg-yellow-50 border border-yellow-300 rounded">
            <p class="text-sm font-semibold text-yellow-800 mb-1">
                HR Notes (Month {{ $month }})
            </p>
            <p class="text-sm text-yellow-700">
                {{ $data['notes_hr'] }}
            </p>
        </div>
    @endif


    {{-- WEEK DETAILS --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @foreach($data['weeks'] as $week)
        <div class="border rounded p-4 bg-gray-50">
            <p class="font-semibold mb-2">
                Week {{ $week->week }}
            </p>

            <p class="text-sm text-gray-600 mb-1">
                Status: <span class="font-medium">{{ ucfirst($week->status) }}</span>
            </p>

            <p class="text-sm text-gray-600">
                Filled by: {{ $week->filled_by ?? '-' }}
            </p>

            @if($week->notes_store_manager)
                <div class="mt-2 text-sm text-gray-700">
                    <span class="font-medium">Store Notes:</span><br>
                    {{ $week->notes_store_manager }}
                </div>
            @endif

        </div>
        @endforeach
    </div>
         
</div>
@endforeach

<a href="{{ route('admin.checklist.index') }}"
   class="inline-block mt-4 text-blue-600 hover:underline">
    ← Back to Onboarding List
</a>

</div>
</div>
</x-app-layout>
