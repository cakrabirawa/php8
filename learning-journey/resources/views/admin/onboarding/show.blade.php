<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Onboarding Detail – Month {{ $checklist->month }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            {{-- APPROVE / REJECT 1 BULAN + Notes HR --}}
            <div class="bg-white shadow-md rounded-lg p-6 mb-8 border">

                <form action="{{ route('admin.checklist.updateMonthStatus') }}" method="POST">
                    @csrf
                    <input type="hidden" name="employee_id" value="{{ $checklist->employee_id }}">
                    <input type="hidden" name="month" value="{{ $checklist->month }}">

                    @php
                        $monthStatus = $allChecklists->first()->status ?? 'pending';
                    @endphp

                    {{-- Notes HR --}}
                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-1">
                            Notes HR
                        </label>

                    <textarea
                        name="notes_hr"
                        id="notes_hr"
                        rows="4"
                        @if($monthStatus === 'approved') readonly @endif
                        class="border rounded p-3 w-full {{ $monthStatus === 'approved' ? 'bg-gray-100 text-gray-500 cursor-not-allowed' : '' }}"
                    >{{ trim($allChecklists->first()->notes_hr ?? '') }}</textarea>


                        @if($monthStatus === 'approved')
                            <p class="text-xs text-gray-500 mt-1">
                                Notes HR tidak dapat diubah karena checklist sudah approved.
                            </p>
                        @endif
                    </div>
                    {{-- Approve / Reject --}}
                    @if($monthStatus !== 'approved')
                        <div class="flex gap-3">
                            <button name="status" value="approved"
                                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                                Approve
                            </button>

                            <button name="status" value="rejected"
                                class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                                Reject
                            </button>
                        </div>
                    @endif

                </form>
            </div>

        <div class="max-w-6xl mx-auto px-6">

            @php
                $notesSM = $allChecklists->first()->notes_store_manager ?? '-';
                $scoreSM = $allChecklists->first()->score ?? '-';
            @endphp

            {{-- NOTES STORE MANAGER --}}
            <div class="bg-white shadow-md rounded-lg p-6 mb-8 border">
                <h3 class="text-lg font-semibold text-gray-800 mb-2 flex items-center">
                    <span class="w-2 h-2 bg-green-600 rounded-full mr-2"></span>
                    Notes from Store Manager
                </h3>

                <div class="bg-gray-50 p-4 border rounded text-gray-700">
                    {{ $notesSM }}
                </div>
            </div>

            <div class="bg-white shadow-md rounded-lg p-6 mb-8 border">

            <h3 class="text-lg font-semibold text-gray-800 mb-3 flex items-center">
                <span class="w-2 h-2 bg-blue-600 rounded-full mr-2"></span>
                Store Manager Score
            </h3>

            <div class="flex items-center gap-4">

                <div class="w-full bg-gray-200 rounded-full h-4">
                    <div 
                        class="bg-blue-600 h-4 rounded-full"
                        style="width: {{ $scoreSM }}%">
                    </div>
                </div>

                <span class="font-semibold text-gray-700">
                    {{ $scoreSM }} / 100
                </span>

            </div>

        </div>

            {{-- LOOP SEMUA MINGGU --}}
            @foreach ($allChecklists as $weekChecklist)

                {{-- CARD PER WEEK --}}
                <div class="bg-white shadow-md rounded-lg p-6 mb-8">

                    @php
                        $data = $weekChecklist->checklist_json ?? [];
                    @endphp

                    {{-- HEADER INFO --}}
                    <div class="mb-6 border-b pb-4">
                        <h1 class="text-2xl font-bold text-gray-900">
                            Week {{ $weekChecklist->week }} — {{ $data['title'] ?? 'No Title' }}
                        </h1>

                        <div class="text-sm text-gray-500 mt-1">
                            Employee:
                            <span class="font-semibold text-gray-700">
                                {{ $weekChecklist->employee->name ?? 'Unknown Employee' }}
                            </span>
                            <br>
                            Month:
                            <span class="font-semibold text-gray-700">
                                {{ $weekChecklist->month }}
                            </span>
                        </div>
                    </div>

                    {{-- CHECKLIST ITEMS --}}
                    @if (!empty($data['items']))
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-800 mb-3 flex items-center">
                                <span class="w-2 h-2 bg-blue-600 rounded-full mr-2"></span>
                                Checklist Items
                            </h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                @foreach ($data['items'] as $item)
                                    <div class="p-4 border rounded-lg bg-gray-50 flex items-center justify-between">
                                        <div class="text-gray-700 font-semibold">
                                            {{ $item['text'] ?? '-' }}
                                        </div>

                                        <input type="checkbox" disabled
                                            {{ !empty($item['checked']) && $item['checked'] ? 'checked' : '' }}
                                            class="h-4 w-4 text-blue-600 border-gray-300 rounded">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- MANDATORY TASKS --}}
                    @if (!empty($data['mandatory_tasks']))
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-800 mb-3 flex items-center">
                                <span class="w-2 h-2 bg-yellow-500 rounded-full mr-2"></span>
                                Mandatory Tasks
                            </h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                @foreach ($data['mandatory_tasks'] as $task)
                                    <div class="p-4 border rounded-lg bg-gray-50 flex items-center justify-between">
                                        <div class="text-gray-700 font-semibold">
                                            {{ $task['text'] ?? '-' }}
                                        </div>

                                        <input type="checkbox" disabled
                                            {{ !empty($task['checked']) && $task['checked'] ? 'checked' : '' }}
                                            class="h-4 w-4 text-yellow-600 border-gray-300 rounded">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- META INFO --}}
                    <div class="space-y-1 text-sm text-gray-500">
                        <div>
                            <span class="font-semibold text-gray-700">Filled At:</span>
                            {{ $weekChecklist->created_at->format('d M Y, H:i') }}
                        </div>

                        <div>
                            <span class="font-semibold text-gray-700">Last Changes:</span>
                            {{ $weekChecklist->updated_at->format('d M Y, H:i') }}
                        </div>

                        <div>
                            <span class="font-semibold text-gray-700">Filled By:</span>
                            {{ $weekChecklist->filled_by ?: '-' }}
                        </div>
                    </div>

                </div>
                {{-- END CARD --}}

            @endforeach

        </div>
        {{-- END WRAPPER --}}


    <script>
    document.querySelectorAll('button[name="status"]').forEach(btn => {
        btn.addEventListener('click', function (e) {
            if (this.value === 'rejected') {
                const notes = document.getElementById('notes_hr').value.trim();
                if (!notes) {
                    e.preventDefault();
                    alert('Notes HR wajib diisi jika checklist direject.');
                }
            }
        });
    });
    </script>
</x-app-layout>
