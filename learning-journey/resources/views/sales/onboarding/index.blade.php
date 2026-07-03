<x-app-layout>
<div class="max-w-6xl mx-auto px-4 py-6">

    {{-- GRID 2 KOLOM --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

    @foreach($employees as $employee)
        @foreach($employee->months as $month)

        @php
            // 1. Logika Status Map
            $statusMap = [
                'not_yet'    => ['label' => 'Not Yet', 'class' => 'bg-gray-100 text-gray-500'],
                'draft'      => ['label' => 'On Progress', 'class' => 'bg-blue-100 text-blue-700'],
                'pending_sm' => ['label' => 'Waiting SM Approval', 'class' => 'bg-orange-100 text-orange-700'],
                'pending'    => ['label' => 'Waiting HR Approval', 'class' => 'bg-yellow-100 text-yellow-700'],
                'approved'   => ['label' => 'Approved', 'class' => 'bg-green-100 text-green-700'],
                'rejected'   => ['label' => 'Rejected', 'class' => 'bg-red-100 text-red-700'],
                'generated'  => ['label' => 'GENERATED', 'class' => 'bg-purple-100 text-purple-700'],
            ];

            // Paksa status tampilan jika month 0 atau status asli DB adalah 'generated'
            $isGeneratedInit = ($month['status'] === 'generated' || $month['month'] == 0);
            $statusCode = $isGeneratedInit ? 'generated' : $month['status'];
            $currentStatus = $statusMap[$statusCode] ?? $statusMap['not_yet'];

            // Logika Akses: Bulan bisa dibuka jika tidak dikunci oleh urutan (locked by order)
            $monthLockedByOrder = $month['locked'] ?? false;
            $canOpen = !$monthLockedByOrder; 
        @endphp

            <div class="bg-white rounded-2xl shadow-md border border-gray-200 overflow-hidden mb-2">

                {{-- MONTH HEADER --}}
                <button
                    onclick="{{ $canOpen ? "toggleMonth('month-{$employee->employee_id}-{$month['month']}')" : "" }}"
                    class="w-full flex justify-between items-center px-6 py-5 transition border-b
                        {{ !$canOpen ? 'bg-gray-100 cursor-not-allowed opacity-70' : 'bg-white hover:bg-gray-50' }}"
                >
                    <div class="text-left">
                        <h2 class="text-xl font-bold text-gray-800">
                            Month {{ $month['month'] }}
                        </h2> 

                        {{-- STATUS BADGE --}}
                        <span class="text-[10px] uppercase tracking-wider font-bold px-2 py-0.5 rounded-full {{ $currentStatus['class'] }}">
                            {{ $currentStatus['label'] }}
                        </span>
                    </div>

                    @if($canOpen)
                    <svg id="icon-month-{{ $employee->employee_id }}-{{ $month['month'] }}"
                         class="w-5 h-5 text-gray-500 transition-transform duration-200"
                         fill="none" stroke="currentColor" stroke-width="2"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                    </svg>
                    @else
                        {{-- Icon Gembok jika bulan memang dikunci urutannya --}}
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                    @endif
                </button>

                {{-- WEEK LIST --}}
                <div id="month-{{ $employee->employee_id }}-{{ $month['month'] }}"
                     class="hidden bg-gray-50">

                    @foreach($month['weeks'] as $week)
                    @php
                        $canClickWeek = $canOpen;

                        // ambil status dari controller
                        $status = $week['fill_status'] ?? 'ready';
                        $label  = $week['fill_label'] ?? 'Ready to Fill';
                    @endphp

                    @if($canClickWeek)
                    <a href="{{ route('sales.show', [$employee->employee_id, $month['month'], $week['week']]) }}"
                    class="flex justify-between items-center px-6 py-4 border-t hover:bg-blue-50 transition group">
                    @else
                    <div class="flex justify-between items-center px-6 py-4 border-t bg-gray-100/50">
                    @endif

                        <span class="text-gray-700 font-medium {{ $canClickWeek ? 'group-hover:text-blue-700' : '' }}">
                            Week {{ $week['week'] }}
                        </span>

                        <span class="text-xs px-3 py-1 rounded-full font-semibold
                            @if($status=='filled')
                                bg-green-100 text-green-700
                            @elseif($status=='incomplete')
                                bg-yellow-100 text-yellow-700
                            @else
                                bg-blue-100 text-blue-700
                            @endif">

                            {{ $label }}
                        </span>

                    @if($canClickWeek)
                    </a>
                    @else
                    </div>
                    @endif

                    @endforeach
                </div>
            </div>

        @endforeach
    @endforeach

    </div>
</div>

{{-- TOGGLE SCRIPT --}}
<script>
function toggleMonth(id) {
    const el = document.getElementById(id);
    const icon = document.getElementById('icon-' + id);

    if (!el) return;

    el.classList.toggle('hidden');
    if(icon) {
        icon.classList.toggle('rotate-90');
    }
}
</script>
</x-app-layout>