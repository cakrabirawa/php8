<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Employee Evaluation Detail</h2>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto">

        {{-- SUCCESS MESSAGE --}}
        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 border-l-4 border-green-500 text-green-700">
                {{ session('success') }}
            </div>
        @endif

        {{-- ================= EMPLOYEE INFO ================= --}}
        <div class="mb-6">
            <label class="block text-sm text-gray-500">Employee</label>
            <div class="border p-2 rounded bg-gray-50">
                {{ $employee_evaluation->employee->employee_id }} - 
                {{ $employee_evaluation->employee->name }}
            </div>
        </div>

        {{-- ================= LATEST KPI ================= --}}
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

        {{-- ================= KPI SUMMARY ================= --}}
        <div class="mt-6">
            <h3 class="font-semibold mb-3">KPI Summary</h3>

            <div class="grid grid-cols-2 md:grid-cols-3 gap-4 text-sm">
                <div>
                    <div class="text-gray-500">KPI June</div>
                    <div class="font-semibold">
                        {{ $employee_evaluation->kpi_june ?? '-' }}
                    </div>
                </div>

                <div>
                    <div class="text-gray-500">KPI December</div>
                    <div class="font-semibold">
                        {{ $employee_evaluation->kpi_december ?? '-' }}
                    </div>
                </div>
            </div>
        </div>

        {{-- ================= ASSESSMENT ================= --}}
        <div class="mt-6">
            <div class="text-gray-500 mb-1">Assessment Link</div>

            @if($employee_evaluation->assessment_link)
                <a href="{{ $employee_evaluation->assessment_link }}"
                   target="_blank"
                   class="text-blue-600 underline">
                    Open Assessment
                </a>
            @else
                <div class="text-gray-400">No assessment available</div>
            @endif
        </div>

        {{-- ================= ACTION ================= --}}
        <div class="mt-8 flex justify-center gap-3">

            <a href="{{ url()->previous() }}"
            class="px-4 py-2 border rounded-lg">
                ← Back
            </a>

            @if(in_array(auth()->user()->role, ['admin','editor']))
                <a href="{{ route('admin.evaluations.edit', $employee_evaluation->id) }}"
                class="px-4 py-2 bg-blue-600 text-white rounded-lg">
                    Edit
                </a>
            @endif

        </div>
    </div>
</x-app-layout>