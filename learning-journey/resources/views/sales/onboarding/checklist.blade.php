<x-app-layout>
<x-slot name="header">
    <h2 class="font-semibold text-xl">
        Month {{ $month }} – Week {{ $week }}
    </h2>
</x-slot>

<div class="max-w-4xl mx-auto py-6 space-y-6">

{{-- NOTES HR --}}
@if(!empty($checklist->notes_hr))
<div class="bg-yellow-50 border border-yellow-300 p-4 rounded">
    <h3 class="font-semibold text-yellow-800 mb-1">Notes from HR</h3>
    <p class="text-yellow-700">{{ $checklist->notes_hr }}</p>
</div>
@endif

@php
    // ✅ Status yang masih boleh diedit oleh SS
    $editableStatuses = ['draft', 'rejected'];
    $readonly = !in_array($checklist->status, $editableStatuses);

    $statusLabel = ucfirst(str_replace('_', ' ', $checklist->status));
@endphp

<form method="POST"
      action="{{ route('sales.store', [$checklist->employee_id, $month, $week]) }}"
      class="space-y-6">
@csrf

{{-- CARD --}}
<div class="bg-white shadow-md rounded-lg p-6">

    {{-- HEADER --}}
    <div class="mb-6 border-b pb-4">
        <h1 class="text-2xl font-bold text-gray-900">
            Week {{ $week }} — {{ $data['title'] ?? 'Checklist' }}
        </h1>

        <div class="text-sm text-gray-500 mt-1">
            Employee:
            <span class="font-semibold text-gray-700">
                {{ $employee->name }}
            </span>
        </div>

        {{-- STATUS --}}
        <div class="text-sm mt-2">
            Status:
                @php
                    $statusMap = [
                        'draft' => 'On Progress',
                        'pending_sm' => 'Waiting for Store Manager Confirmation',
                        'pending' => 'Waiting for HR Approval',
                        'approved' => 'Approved',
                        'rejected' => 'Rejected',
                    ];

                    $statusText = $statusMap[$checklist->status] ?? ucfirst($checklist->status);
                @endphp

                <span class="px-2 py-1 text-xs rounded-full
                    {{ $checklist->status == 'approved' ? 'bg-green-100 text-green-700' :
                    ($checklist->status == 'pending' ? 'bg-yellow-100 text-yellow-700' :
                    ($checklist->status == 'pending_sm' ? 'bg-blue-100 text-blue-700' :
                    ($checklist->status == 'rejected' ? 'bg-red-100 text-red-700' :
                    'bg-gray-100 text-gray-600'))) }}">
                    {{ $statusText }}
                </span>
        </div>
    </div>


    @if(session('missing_weeks') || session('error_checklist'))

    <div class="bg-red-50 border border-red-300 rounded-xl p-5 mb-6">

        <h3 class="font-semibold text-red-800 mb-4">
            Action Required
        </h3>

        {{-- WEEK BELUM ADA --}}
        @if(session('missing_weeks'))
            <div class="mb-4">
                <p class="text-sm font-medium text-red-700 mb-2">
                    Week berikut belum diisi:
                </p>

                @foreach(session('missing_weeks') as $w)
                <div class="flex justify-between items-center bg-white rounded-lg border p-3 mb-2">
                    <span class="text-gray-700">
                        Week {{ $w }}
                    </span>

                    <a href="{{ route('sales.show',[
                        $employee->employee_id,
                        $month,
                        $w
                    ]) }}"
                    class="px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-700">
                        Open
                    </a>
                </div>
                @endforeach
            </div>
        @endif


    {{-- CHECKLIST BELUM LENGKAP --}}
    @if(session('error_checklist'))

    <div>
        <p class="text-sm font-medium text-red-700 mb-3">
            Checklist belum lengkap:
        </p>

        <div class="space-y-2">
            @foreach(session('error_checklist') as $err)
            <div class="flex justify-between items-center bg-white border rounded-lg px-4 py-3">

                <span class="text-sm text-red-700">
                    Week {{ $err['week'] }} —
                    {{ $err['text'] }}
                </span>

                <a href="{{ route('sales.show',[
                    $employee->employee_id,
                    $month,
                    $err['week']
                ]) }}"
                class="ml-3 text-xs px-3 py-1 rounded-full bg-blue-100 text-blue-700 hover:bg-blue-200 font-semibold whitespace-nowrap">
                    Open
                </a>

            </div>
            @endforeach
        </div>

    </div>

    @endif

    </div>

    @endif

    {{-- CHECKLIST ITEMS --}}
    @if(!empty($data['items']))
    <div class="mb-8">
        <h3 class="text-lg font-semibold text-gray-800 mb-3 flex items-center">
            <span class="w-2 h-2 bg-blue-600 rounded-full mr-2"></span>
            Checklist Items
        </h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
            @foreach($data['items'] as $i => $item)
            <label class="p-4 border rounded-lg bg-gray-50 flex items-center justify-between">
                <div class="text-gray-700 font-semibold">
                    {{ $item['text'] ?? '-' }}
                </div>

                <input type="checkbox"
                    name="checklist[items][{{ $i }}][checked]"
                    value="1"
                    {{ !empty($item['checked']) ? 'checked' : '' }}
                    {{ $readonly ? 'disabled' : '' }}
                    class="h-4 w-4 text-blue-600 border-gray-300 rounded">

                <input type="hidden"
                    name="checklist[items][{{ $i }}][text]"
                    value="{{ $item['text'] }}">
            </label>
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
            @foreach($data['mandatory_tasks'] as $i => $task)
            <label class="p-4 border rounded-lg bg-gray-50 flex items-center justify-between">
                <div class="text-gray-700 font-semibold">
                    {{ $task['text'] ?? '-' }}
                </div>

                <input type="checkbox"
                    name="checklist[mandatory_tasks][{{ $i }}][checked]"
                    value="1"
                    {{ !empty($task['checked']) ? 'checked' : '' }}
                    {{ $readonly ? 'disabled' : '' }}
                    class="h-4 w-4 text-yellow-600 border-gray-300 rounded">

                <input type="hidden"
                    name="checklist[mandatory_tasks][{{ $i }}][text]"
                    value="{{ $task['text'] }}">
            </label>
            @endforeach
        </div>
    </div>
    @endif

    {{-- NOTES SS --}}
    <div class="mb-8">
        <h3 class="text-lg font-semibold text-gray-800 mb-2 flex items-center">
            <span class="w-2 h-2 bg-purple-600 rounded-full mr-2"></span>
            Notes from Sales Superintendent
        </h3>

        <textarea name="notes_ss"
            rows="4"
            class="w-full border rounded p-3 bg-gray-50"
            placeholder="Add notes..."
            {{ $readonly ? 'readonly' : '' }}>{{ old('notes_ss', $checklist->notes_ss) }}</textarea>
    </div>

    {{-- ACTION BUTTONS --}}
    @if(!$readonly)
    <div class="flex justify-end gap-3">

        {{-- CANCEL --}}
        <button
            type="submit"
            name="cancel"
            value="1"
            onclick="return confirm('Yakin ingin menghapus checklist minggu ini?')"
            class="px-4 py-2 rounded border border-red-500 text-red-600 hover:bg-red-50 transition">
            Cancel
        </button>

        {{-- SAVE / SUBMIT --}}
        @if($week == 4)
            <button
                type="submit"
                name="submit_month"
                value="1"
                class="px-5 py-2 rounded bg-green-600 text-white hover:bg-green-700 transition">
                Submit Month {{ $month }}
            </button>
        @else
            <button
                type="submit"
                class="px-5 py-2 rounded bg-blue-600 text-white hover:bg-blue-700 transition">
                Save Checklist
            </button>
        @endif

    </div>
    @else
    <div class="text-gray-500 font-medium">
        Checklist sudah disubmit dan tidak dapat diubah.
    </div>
    @endif

</div>
{{-- END CARD --}}

</form>
</div>
</x-app-layout>