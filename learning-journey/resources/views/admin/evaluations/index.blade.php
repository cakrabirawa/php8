<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Employee Evaluation</h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-6 py-6">

        {{-- SUCCESS MESSAGE --}}
        @if(session('success'))
            <div class="mb-4 p-4 rounded bg-green-100 border border-green-300 text-green-800">
                {{ session('success') }}
            </div>
        @endif  
        @if (session('errors_import') && count(session('errors_import')) > 0)
            <div class="mb-4 p-4 rounded bg-red-100 border border-red-300 text-red-800">
                <strong>
                    Data Skipped ({{ count(session('errors_import')) }}):
                </strong>

                <div 
                    class="mt-2 border rounded p-2 bg-white text-sm"
                    style="max-height: 200px; overflow-y: auto;"
                >
                    <ul class="list-disc list-inside">
                        @foreach (session('errors_import') as $err)
                            <li>
                                {{ $err['employee_id'] }} - {{ $err['issue'] }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

    {{-- 1. HIDDEN RESET FORM (Letakkan di luar form search agar tidak konflik) --}}
    <form id="realResetKpiForm" action="{{ route('admin.evaluations.reset') }}" method="POST" class="hidden">
        @csrf
        @method('PUT')
    </form>

    {{-- 2. 🔎 SEARCH + ACTION AREA --}}
    <form method="GET" class="mb-6" id="evaluationSearchForm">
        <div class="flex items-end justify-between gap-6">

            {{-- LEFT SIDE --}}
            <div class="flex items-end gap-3">
                {{-- SEARCH --}}
                <div class="relative w-80">
                    <input type="text" 
                        id="employeeSearchIndex"
                        class="w-full border rounded px-4 py-2"
                        placeholder="Employee ID / Name..."
                    >
                    <div id="searchResultsIndex" class="mt-1 bg-white shadow rounded hidden absolute w-full z-50"></div>
                </div>

                {{-- SORT --}}
                <div class="flex flex-col">
                    <label class="text-xs font-semibold text-gray-500 mb-1">
                        Sort By
                    </label>
                    <select name="sort"
                        class="border border-gray-300 rounded-lg px-4 py-2 text-sm shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">Default</option>
                        <optgroup label="KPI">
                            <option value="kpi_june_desc" {{ request('sort')=='kpi_june_desc' ? 'selected' : '' }}>KPI June — Highest</option>
                            <option value="kpi_june_asc" {{ request('sort')=='kpi_june_asc' ? 'selected' : '' }}>KPI June — Lowest</option>
                            <option value="kpi_december_desc" {{ request('sort')=='kpi_december_desc' ? 'selected' : '' }}>KPI December — Highest</option>
                            <option value="kpi_december_asc" {{ request('sort')=='kpi_december_asc' ? 'selected' : '' }}>KPI December — Lowest</option>
                        </optgroup>
                        <optgroup label="Onboarding Progress">
                            <option value="onboarding_fast" {{ request('sort')=='onboarding_fast' ? 'selected' : '' }}>🚀 Tercepat</option>
                            <option value="onboarding_slow" {{ request('sort')=='onboarding_slow' ? 'selected' : '' }}>🐢 Terlambat</option>
                        </optgroup>
                    </select>
                </div>

                {{-- SEARCH BUTTON --}}
                <button type="submit"
                    class="px-6 py-2 bg-gray-900 text-white rounded-lg hover:bg-gray-800 transition">
                    Search
                </button>
            </div>

            {{-- RIGHT SIDE --}}
            <div class="flex items-end gap-3">
                {{-- Tombol Reset (Memanggil form di luar menggunakan JS) --}}
                @if(in_array(auth()->user()->role, ['admin','editor']))
                <button type="button"
                    onclick="if(confirm('Apakah Anda yakin ingin menghapus SEMUA data skor KPI (Business, Behavior, PA, June, Dec)? Tindakan ini tidak dapat dibatalkan.')) document.getElementById('realResetKpiForm').submit();"
                    class="px-4 py-2 bg-red-50 text-red-600 border border-red-200 rounded-lg hover:bg-red-600 hover:text-white transition font-medium">
                    Reset All KPI
                </button>

                <button type="button"
                    onclick="openImportModal()"
                    class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                    Import KPI
                </button>

                <a href="{{ route('admin.evaluations.create') }}"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                    + Add KPI
                </a>
                @endif
                <a href="{{ route('admin.evaluations.export', request()->query()) }}"
                    class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                    Export CSV
                </a>
            </div>

        </div>
    </form>

        {{-- ✅ TABLE CARD --}}
        <div class="bg-white shadow-md rounded-xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-gray-700">
                    <thead class="bg-gray-100 text-gray-600 uppercase text-xs tracking-wider">
                        <tr>
                            <th class="px-4 py-3 text-left">Employee</th>
                            <th class="px-4 py-3 text-left">Store</th>
                            <th class="px-4 py-3 text-left">Introduction</th>
                            <th class="px-4 py-3 text-left">Checklist</th>
                            <th class="px-4 py-3 text-left">KPI June</th>
                            <th class="px-4 py-3 text-left">KPI December</th>
                            <th class="px-4 py-3 text-left">Mentoring</th>
                            <th class="px-4 py-3 text-left">Development</th>
                            <th class="px-4 py-3 text-left">Assessment</th>
                            <th class="px-4 py-3 text-left">Actions</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200">
                        @foreach($evaluations as $eval)
                        @php $emp = $eval->employee; @endphp

                        @php
                            $role = auth()->user()->role;

                            $route = match($role) {
                                'viewer' => route('admin.evaluations.show', $eval->id),
                                default => route('admin.evaluations.edit', $eval->id),
                            };
                        @endphp

                        <tr
                            onclick="window.location='{{ $route }}'"
                            class="cursor-pointer hover:bg-blue-50 transition group"
                        >
                            <td class="px-4 py-3 font-medium text-gray-900 group-hover:text-blue-700">
                                {{ $emp->employee_id }} - {{ $emp->name }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $emp->store->short_name ?? $emp->store->name ?? '-' }}
                            </td>

                            <td class="px-4 py-3">{{ $eval->intro_status }}</td>
                            <td class="px-4 py-3">
                                @php
                                    // FORCE GRAY kalau ada month 0 (auto full)
                                    if ($eval->employee->onboardingChecklists
                                        ->contains(fn($c) => $c->month == 0)) {
                                        $eval->checklist_color = 'gray';
                                    }

                                    $colorClass = match($eval->checklist_color ?? 'gray') {
                                        'red' => 'bg-red-100 text-red-700 ring-1 ring-red-300',
                                        'green' => 'bg-green-100 text-green-700 ring-1 ring-green-300',
                                        'blue' => 'bg-blue-100 text-blue-700 ring-1 ring-blue-300',
                                        default => 'bg-gray-100 text-gray-600 ring-1 ring-gray-300'
                                    };
                                @endphp

                                <div class="flex items-center gap-2">
                                    <span class="px-3 py-1 rounded-full text-sm font-semibold {{ $colorClass }}">
                                        {{ $eval->checklist_summary }}
                                    </span>
                                </div>
                            </td>
                            <td class="px-4 py-3 font-semibold text-indigo-600">
                                {{ $eval->kpi_june }}
                            </td>

                            <td class="px-4 py-3 font-semibold text-indigo-600">
                                {{ $eval->kpi_december }}
                            </td>

                            <td class="px-4 py-3">
                                @if($eval->total_mentoring > 0)
                                    <span class="text-green-600 font-semibold">
                                        {{ $eval->total_mentoring }}x
                                    </span>
                                @else
                                    <span class="text-gray-400">0</span>
                                @endif
                            </td>

                            <td class="px-4 py-3">
                                @if($eval->avg_development)
                                    <span class="font-semibold">
                                        {{ $eval->avg_development }}
                                    </span>
                                @else
                                    <span class="text-red-500">Pending</span>
                                @endif
                            </td>

                            <td class="px-4 py-3">
                                @if($eval->assessment_link)
                                    <a href="{{ $eval->assessment_link }}"
                                       class="text-blue-600 underline"
                                       target="_blank">
                                        View
                                    </a>
                                @else
                                    -
                                @endif
                            </td>

                            <td class="px-4 py-3" onclick="event.stopPropagation();">

                            @if(in_array(auth()->user()->role, ['admin','editor']))
                                <form action="{{ route('admin.evaluations.destroy', $eval->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Delete?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">
                                        Delete
                                    </button>
                                </form>
                            @endif

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="p-4 border-t">
                {{ $evaluations->links() }}
            </div>
        </div>
    </div>

    {{-- 🔥 IMPORT MODAL --}}
    <div id="importModal"
         class="fixed inset-0 bg-black bg-opacity-40 hidden items-center justify-center z-50">

        <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
            <h3 class="text-lg font-semibold mb-4">Import KPI CSV</h3>

            <form id="importForm" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- TEMPLATE DOWNLOAD --}}
                <div class="mb-4 space-y-2 text-sm">
                    <p class="text-gray-600 font-medium">Download Template:</p>

                    <a href="{{ route('admin.evaluations.template', 'kpi') }}"
                       class="block text-indigo-600 hover:underline">
                        ⬇ Template Import KPI
                    </a>

                    <a href="{{ route('admin.evaluations.template', 'assessment') }}"
                       class="block text-green-600 hover:underline">
                        ⬇ Template Import Assessment
                    </a>
                </div>

                <label class="block text-sm font-medium mb-1">
                    Choose CSV File
                </label>

                <input type="file" name="file" required
                       class="w-full border px-3 py-2 rounded mb-4">

                <div class="flex justify-end gap-2">
                    <button type="button"
                            onclick="closeImportModal()"
                            class="px-4 py-2 border rounded">
                        Cancel
                    </button>

                    <button type="button"
                            onclick="submitImport('june')"
                            class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                        Import KPI June
                    </button>

                    <button type="button"
                            onclick="submitImport('december')"
                            class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700">
                        Import KPI December
                    </button>

                    <button type="button"
                            onclick="submitAssessmentImport()"
                            class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                        Import Assessment
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- 🔥 MODAL SCRIPT --}}
    <script>
         document.addEventListener('DOMContentLoaded', function () {
            const input = document.getElementById('employeeSearchIndex');
            const resultsBox = document.getElementById('searchResultsIndex');

            const SEARCH_URL = "{{ route('admin.search.employees') }}";

            async function fetchResults() {
                let q = input.value.trim();
                if (q.length < 1) {
                    resultsBox.innerHTML = "";
                    resultsBox.classList.add("hidden");
                    return;
                }

                try {
                    const res = await fetch(SEARCH_URL + '?q=' + encodeURIComponent(q), {
                        headers: { 'Accept': 'application/json' }
                    });

                    const data = await res.json();

                    if (!Array.isArray(data) || data.length === 0) {
                        resultsBox.innerHTML = "<p class='p-3 text-gray-500'>No results</p>";
                    } else {
                        resultsBox.innerHTML = data.map(item => `
                            <div class="p-2 border-b hover:bg-gray-100 cursor-pointer"
                                onclick="selectEmployeeIndex('${item.employee_id}', '${item.employee_id}', '${item.name}')">
                                <strong>${item.employee_id}</strong> - ${item.name}
                            </div>
                        `).join('');
                    }

                    resultsBox.classList.remove("hidden");

                } catch (err) {
                    console.error(err);
                }
            }

            input.addEventListener('keyup', fetchResults);
        });

        window.selectEmployeeIndex = function(employeeId) {
            window.location.href =
                "{{ route('admin.evaluations.index') }}" + "?search=" + employeeId;
        };

        function openImportModal() {
            const modal = document.getElementById('importModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeImportModal() {
            const modal = document.getElementById('importModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        function submitImport(period) {
            const form = document.getElementById('importForm');
            form.action = `/admin/employee-evaluations/import/${period}`;
            form.submit();
        }

        function submitAssessmentImport() {
            const form = document.getElementById('importForm');
            form.action = "{{ route('admin.employee-evaluations.import-assessment') }}";
            form.submit();
        }
    </script>
</x-app-layout>