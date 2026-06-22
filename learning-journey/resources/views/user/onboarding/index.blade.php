<x-app-layout>
<div class="max-w-6xl mx-auto px-4 py-6">

    <h1 class="text-2xl font-bold mb-6">Onboarding Checklist</h1>

    @php
        // 🔥 Urutan employee berdasarkan prioritas kerja SM
        $employees = $employees->sortBy(function ($emp) {
            $statuses = collect($emp->months)->pluck('status');

            if ($statuses->contains('pending_sm')) return 1;
            if ($statuses->contains('rejected')) return 2;
            if ($statuses->contains('not_yet') || $statuses->contains('draft')) return 3;
            return 4; // pending & approved
        });
    @endphp

    <div class="space-y-4">

    @forelse($employees as $employee)

        @php
            $statuses = collect($employee->months)->pluck('status');

            if ($statuses->contains('pending_sm')) {
                $mainStatus = 'pending_sm';
                $borderClass = 'border-l-4 border-blue-500';
                $label = 'Waiting SM Confirm';
            } elseif ($statuses->contains('rejected')) {
                $mainStatus = 'rejected';
                $borderClass = 'border-l-4 border-red-500';
                $label = 'Rejected';
            } elseif ($statuses->contains('not_yet') || $statuses->contains('draft')) {
                $mainStatus = 'progress';
                $borderClass = 'border-l-4 border-yellow-400';
                $label = 'Incomplete';
            } else {
                $mainStatus = 'done';
                $borderClass = 'border-l-4 border-gray-300';
                $label = 'Completed';
            }
        @endphp

        <div class="bg-white rounded-xl shadow border {{ $borderClass }} overflow-hidden">

            {{-- EMPLOYEE HEADER --}}
            <button onclick="toggle('emp-{{ $employee->employee_id }}')"
                    class="w-full flex justify-between items-center px-5 py-4 bg-gray-50 hover:bg-gray-100 transition">

                <div class="text-left">
                    <h2 class="font-semibold text-gray-800">
                        {{ $employee->name }}
                    </h2>
                    <span class="text-xs text-gray-500">
                        {{ $label }}
                    </span>
                </div>

                <svg id="icon-emp-{{ $employee->employee_id }}"
                     class="w-5 h-5 text-gray-500 transition-transform duration-200"
                     fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M9 5l7 7-7 7"/>
                </svg>
            </button>

            {{-- MONTH LIST --}}
            <div id="emp-{{ $employee->employee_id }}" class="hidden p-4 space-y-3">

                @foreach($employee->months as $month)

                @php
                    $statusMap = [
                        'not_yet' => ['label' => 'Not Yet', 'class' => 'bg-gray-100 text-gray-500'],
                        'draft' => ['label' => 'On Progress', 'class' => 'bg-blue-100 text-blue-700'],
                        'pending_sm' => ['label' => 'Waiting SM Confirm', 'class' => 'bg-indigo-100 text-indigo-700'],
                        'pending' => ['label' => 'Waiting HR', 'class' => 'bg-yellow-100 text-yellow-700'],
                        'approved' => ['label' => 'Approved', 'class' => 'bg-green-100 text-green-700'],
                        'rejected' => ['label' => 'Rejected', 'class' => 'bg-red-100 text-red-700'],
                    ];
                    $status = $statusMap[$month['status']];
                @endphp

                <a href="{{ route('user.onboarding.review', [$employee->employee_id, $month['month']]) }}"
                   class="flex justify-between items-center p-3 border rounded-lg hover:bg-gray-50 transition">

                    <span class="font-medium text-gray-700">
                        Month {{ $month['month'] }}
                    </span>

                    <span class="text-xs px-2 py-1 rounded-full {{ $status['class'] }}">
                        {{ $status['label'] }}
                    </span>

                </a>

                @endforeach

            </div>

        </div>

    @empty
        <p class="text-gray-500">No employees found.</p>
    @endforelse

    </div>
</div>

{{-- TOGGLE SCRIPT --}}
<script>
function toggle(id) {
    const el = document.getElementById(id);
    const icon = document.getElementById('icon-' + id);

    el.classList.toggle('hidden');
    icon.classList.toggle('rotate-90');
}
</script>

</x-app-layout>