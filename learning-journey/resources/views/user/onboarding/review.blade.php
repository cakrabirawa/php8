<x-app-layout>
<x-slot name="header">
    <h2 class="font-semibold text-xl">
        {{ $employee->name }} — Month {{ $month }}
    </h2>
</x-slot>

<div class="max-w-5xl mx-auto py-6 space-y-6">

@php
    $firstChecklist = $checklists->first();
@endphp

{{-- ================= NOTES HR (1x DI ATAS) ================= --}}
@if(!empty($firstChecklist?->notes_hr))
<div class="bg-yellow-50 border border-yellow-300 shadow-sm rounded-lg p-6">
    <h3 class="font-semibold text-yellow-800 mb-2">Notes from HR</h3>
    <div class="text-yellow-700">
        {{ $firstChecklist->notes_hr }}
    </div>
</div>
@endif

{{-- ================= WEEK CARDS ================= --}}
@foreach($checklists as $checklist)
@php
    $data = $checklist->checklist_json ?? [];
@endphp

<div class="bg-white shadow-md rounded-lg p-6 mb-6">

    {{-- HEADER --}}
    <div class="mb-6 border-b pb-4">
        <h3 class="text-xl font-bold text-gray-900">
            {{ $data['title'] ?? '-' }}
        </h3>
    </div>

    {{-- CHECKLIST ITEMS --}}
    @if(!empty($data['items']))
    <div class="mb-8">
        <h3 class="text-lg font-semibold text-gray-800 mb-3 flex items-center">
            <span class="w-2 h-2 bg-blue-600 rounded-full mr-2"></span>
            Checklist Items
        </h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
            @foreach($data['items'] as $item)
            <div class="p-4 border rounded-lg bg-gray-50 flex items-center justify-between">
                <div class="text-gray-700 font-semibold">
                    {{ $item['text'] ?? '-' }}
                </div>

                <input type="checkbox" disabled
                    {{ !empty($item['checked']) ? 'checked' : '' }}
                    class="h-4 w-4 text-blue-600 border-gray-300 rounded">
            </div>
            @endforeach
        </div>
    </div>
    @endif

    {{-- MANDATORY TASKS --}}
    @if(!empty($data['mandatory_tasks']))
    <div class="mb-8">
        <h3 class="text-lg font-semibold text-gray-800 mb-3 flex items-center">
            <span class="w-2 h-2 bg-yellow-500 rounded-full mr-2"></span>
            Mandatory Tasks
        </h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
            @foreach($data['mandatory_tasks'] as $task)
            <div class="p-4 border rounded-lg bg-gray-50 flex items-center justify-between">
                <div class="text-gray-700 font-semibold">
                    {{ $task['text'] ?? '-' }}
                </div>

                <input type="checkbox" disabled
                    {{ !empty($task['checked']) ? 'checked' : '' }}
                    class="h-4 w-4 text-yellow-600 border-gray-300 rounded">
            </div>
            @endforeach
        </div>
    </div>
    @endif


    {{-- NOTES SS --}}
    @if($checklist->notes_ss)
    <div class="mb-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-2 flex items-center">
            <span class="w-2 h-2 bg-purple-600 rounded-full mr-2"></span>
            Notes SS
        </h3>

        <div class="bg-gray-50 p-4 border rounded text-gray-700">
            {{ $checklist->notes_ss }}
        </div>
    </div>
    @endif

     {{-- LAST UPDATE INFO (SS) --}}
    <div class="mt-4 text-sm text-gray-500 space-y-1">
        <div>
            <span class="font-semibold text-gray-700">Last Updated :</span>
            {{ optional($checklist->updated_at)->format('d M Y, H:i') ?? '-' }}
        </div>
    </div>

</div>
@endforeach


{{-- ================= CONFIRM MONTH / DISPLAY RESULT ================= --}}
@php
    $monthStatus = $checklists->first()->status ?? null;
@endphp

@if($monthStatus === 'pending_sm')
    {{-- ===== FORM CONFIRM (BELUM DIKONFIRM SM) ===== --}}
    <form method="POST" action="{{ route('user.onboarding.confirm', [$employee->employee_id, $month]) }}">
    @csrf

    <div class="bg-white shadow-md rounded-lg p-6 space-y-5">
        <h3 class="font-semibold text-lg">Confirm Month</h3>

        {{-- FILLED BY --}}
        <div>
            <label class="font-semibold">Confirmed By</label>
            <input type="text"
                   name="filled_by"
                   class="w-full border rounded p-2"
                   required>
        </div>

        {{-- SCORE SLIDER --}}
        <div>
            <label class="font-semibold">Score</label>

            <input type="range"
                name="score"
                min="1"
                max="100"
                value="75"
                id="scoreSlider"
                oninput="updateSlider(this)"
                class="w-full h-2 rounded-lg appearance-none cursor-pointer bg-gray-200">

            <div class="flex justify-between text-xs text-gray-500">
                <span>1</span>
                <output name="scoreOutput" class="font-semibold text-gray-700">75</output>
                <span>100</span>
            </div>
        </div>

        {{-- NOTES STORE MANAGER --}}
        <div>
            <label class="font-semibold">Notes Store Manager</label>
            <textarea name="notes_store_manager"
                      class="w-full border rounded p-2"
                      rows="3"
                      required></textarea>
        </div>

        <button class="bg-green-600 text-white px-5 py-2 rounded hover:bg-green-700">
            Confirm & Send to HR
        </button>
    </div>
    </form>


    @elseif($monthStatus === 'pending')

        <div class="bg-blue-50 border border-blue-200 rounded-lg p-6">
            <div class="font-semibold text-blue-800">
                Waiting for HR Review
            </div>

            <div class="text-sm text-blue-700 mt-1">
                This month has been confirmed by Store Manager and sent to HR.
            </div>
        </div>

    @elseif($monthStatus === 'approved')

        <div class="bg-green-50 border border-green-200 rounded-lg p-6">
            <div class="font-semibold text-green-800">
                Approved by HR
            </div>

            <div class="text-sm text-green-700 mt-1">
                This onboarding month has been approved.
            </div>
        </div>

    @elseif($monthStatus === 'draft' || !$monthStatus)

        <div class="bg-gray-50 border border-gray-200 rounded-lg p-6">
            <div class="font-semibold text-gray-800">
                Draft
            </div>

            <div class="text-sm text-gray-700 mt-1">
                Employee has not completed the onboarding checklist yet.
            </div>
        </div>

    @elseif($monthStatus === 'rejected')

        <div class="bg-red-50 border border-red-200 rounded-lg p-6">
            <div class="font-semibold text-red-800">
                Rejected by HR
            </div>

            <div class="text-sm text-red-700 mt-1">
                Please review HR notes and revise the onboarding process.
            </div>
        </div>

    @else

        {{-- DEFAULT DISPLAY RESULT --}}

        @php
            $firstChecklist = $checklists->first();
        @endphp

        <div class="bg-white shadow-md rounded-lg p-6 space-y-4">
            <h3 class="font-semibold text-lg">Store Manager Confirmation</h3>

            <div>
                <span class="font-semibold text-gray-700">Confirmed By:</span>
                <div class="bg-gray-50 border rounded p-3 mt-1">
                    {{ $firstChecklist->filled_by ?? '-' }}
                </div>
            </div>

            <div>
                <span class="font-semibold text-gray-700">Score:</span>
                <div class="bg-gray-50 border rounded p-3 mt-1">
                    {{ $firstChecklist->score ?? '-' }}
                </div>
            </div>

            <div>
                <span class="font-semibold text-gray-700">Notes Store Manager:</span>
                <div class="bg-gray-50 border rounded p-3 mt-1">
                    {{ $firstChecklist->notes_store_manager ?? '-' }}
                </div>
            </div>
        </div>

    @endif

</div>

<script>
function updateSlider(slider) {
    const value = slider.value;
    const min = slider.min;
    const max = slider.max;

    const percentage = ((value - min) / (max - min)) * 100;

    // Update angka
    document.querySelector('output[name="scoreOutput"]').value = value;

    // Tentukan warna berdasarkan nilai
    let color = '#ef4444'; // merah default

    if (value >= 75) {
        color = '#22c55e'; // hijau
    } else if (value >= 50) {
        color = '#facc15'; // kuning
    }

    // Gradient FIX: kiri warna, kanan abu
    slider.style.background = `linear-gradient(to right,
        ${color} 0%,
        ${color} ${percentage}%,
        #e5e7eb ${percentage}%,
        #e5e7eb 100%)`;
}

// init
document.addEventListener("DOMContentLoaded", function () {
    const slider = document.getElementById('scoreSlider');
    updateSlider(slider);
});
</script>
</x-app-layout>