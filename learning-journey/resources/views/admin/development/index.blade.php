<x-app-layout>
        <x-slot name="header">
            <h2 class="text-xl font-semibold">Employee Training Scores</h2>
        </x-slot>
        <div class="max-w-7xl mx-auto px-6 py-6">
                    @if (session('success'))
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
        @if (session('error'))
            <div class="mb-4 p-4 rounded bg-red-100 border border-red-300 text-red-800">
                {{ session('error') }}
            </div>
        @endif

        @if (session('warning'))
            <div class="mb-4 p-4 rounded bg-yellow-100 border border-yellow-300 text-yellow-800">
                {{ session('warning') }}
            </div>
        @endif
        <div class="flex items-center justify-between mb-4">
            <!-- SEARCH BOX -->
            <div class="w-80">
                <label class="font-semibold">Search Employee</label>

                <div class="relative mt-1">
                    <input type="text" 
                        id="employeeSearchIndex"
                        class="w-full border rounded px-4 py-2"
                        placeholder="Employee ID / Name..."
                    >
                    <div id="searchResultsIndex" class="mt-1 bg-white shadow rounded hidden absolute w-full z-50"></div>
                </div>
            </div>

            <div class="flex items-center gap-2">

                <button
                    type="button"
                    onclick="openImportModal()"
                    class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition">
                    Import CSV
                </button>

                <a href="{{ route('admin.development.create') }}"
                class="px-4 py-2 bg-green-600 text-white rounded hover:bg-blue-700 transition">
                    + Add Training Score
                </a>
            </div>
        </div>


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
                "{{ route('admin.development.index') }}" + "?search=" + employeeId;
        };
        </script>


<div class="bg-white shadow-md rounded-xl overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full text-sm text-gray-700">

            <thead class="bg-gray-100 text-gray-600 uppercase text-xs tracking-wider">
                <tr>
                    <th class="px-4 py-3 text-left">Employee</th>
                    <th class="px-4 py-3 text-left">Store</th>
                    <th class="px-4 py-3 text-left">Gramedia Daily Store</th>
                    <th class="px-4 py-3 text-left">Avg RSO Score</th>
                    <th class="px-4 py-3 text-left">Learning Hours</th>
                    <th class="px-4 py-3 text-left">Nilai NGECAS</th>
                    <th class="px-4 py-3 text-left">Actions</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200">
            @foreach ($scores as $score)
                <tr
                    onclick="window.location='{{ route('admin.development.show', $score->id) }}'"
                    class="cursor-pointer hover:bg-blue-50 transition duration-200 group"
                >

                    <td class="px-4 py-3 font-medium text-gray-900 group-hover:text-blue-700 transition">
                        {{ $score->employee->name ?? '-' }}
                    </td>

                    <td class="px-4 py-3 group-hover:text-blue-700 transition">
                        {{ $score->employee->store->short_name ?? $score->employee->store->name ?? '-' }}
                    </td>

                    <td class="px-4 py-3 group-hover:text-blue-700 transition">
                        {{ $score->gramedia_daily_store }}
                    </td>

                    <td class="px-4 py-3 font-semibold text-indigo-600">
                        {{ $score->rso_average }}
                    </td>

                    <td class="px-4 py-3 group-hover:text-blue-700 transition">
                        {{ $score->learning_hours }}
                    </td>

                    <td class="px-4 py-3 group-hover:text-blue-700 transition">
                        {{ $score->nilai_ngecas }}
                    </td>

                    {{-- ACTION --}}
                    <td class="px-4 py-3" onclick="event.stopPropagation();">
                        <div class="flex gap-2">

                            <a href="{{ route('admin.development.edit', $score->id) }}"
                            class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600 transition">
                                Edit
                            </a>

                            <form action="{{ route('admin.development.destroy', $score->id) }}"
                                method="POST"
                                onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700 transition">
                                    Delete
                                </button>
                            </form>

                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>

        </table>
    </div>

    <div class="p-4 border-t">
        {{ $scores->links() }}
    </div>
</div>

<!-- IMPORT CSV MODAL -->
<div id="importModal"
     class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">

    <div class="bg-white rounded-lg w-full max-w-md p-6 text-black">
        <h3 class="text-lg font-semibold mb-2">Import Training Score (CSV)</h3>

        <p class="text-sm text-gray-600 mb-4">
            Format CSV:
            employee_id, gramedia_daily_store, rso_supervisory_skill,
            rso_retail_salesmanship, rso_customer_service_loyalty,
            rso_product_merchandising, rso_visual_merchandising,
            rso_retail_store_promotion, rso_store_financial_perspective,
            rso_store_general_checkup_strategy, learning_hours,
            nilai_ngecas, inhouse_training, public_training, intensive_training,
            development_program.
        </p>

        <a href="{{ asset('templates/Employee_Training_Score.csv') }}"
           download
           class="inline-block mb-3 text-sm text-blue-600 hover:underline">
            Download CSV Template
        </a>

        <form id="importForm"
              action="{{ route('admin.development.import') }}"
              method="POST"
              enctype="multipart/form-data">
            @csrf

            <input
                type="file"
                name="file"
                accept=".csv"
                required
                class="border w-full px-3 py-2 rounded mb-4"
            >

            <div class="flex justify-end gap-3">
                <button
                    type="button"
                    onclick="closeImportModal()"
                    class="px-4 py-2 border rounded hover:bg-gray-100">
                    Cancel
                </button>

                <button
                    type="button"
                    onclick="confirmImport()"
                    class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Import
                </button>
            </div>
        </form>
    </div>
</div>
</div>

<script>
function openImportModal() {
    document.getElementById('importModal').classList.remove('hidden');
    document.getElementById('importModal').classList.add('flex');
}

function closeImportModal() {
    document.getElementById('importModal').classList.add('hidden');
    document.getElementById('importModal').classList.remove('flex');
}

function confirmImport() {
    document.getElementById('importForm').submit();
}
</script>

</x-app-layout>
