<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Add Employee Evaluation</h2>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto">

        {{-- 🔴 GLOBAL ERROR --}}
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <strong>Failed!</strong> Please fix the following errors:
                <ul class="mt-2 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.evaluations.store') }}">
            @csrf

        {{-- EMPLOYEE SEARCH --}}
        <div class="mb-4 relative">
            <label class="block mb-1">Employee</label>

            {{-- hidden input --}}
            <input type="hidden" name="employee_id" id="employee_id" value="{{ old('employee_id') }}">

            {{-- input search --}}
            <input
                type="text"
                id="employeeSearch"
                placeholder="Type Employee ID or Name..."
                class="border p-2 w-full rounded @error('employee_id') border-red-500 @enderror"
                autocomplete="off"
                value="{{ old('employee_id') ? old('employee_id') : '' }}"
            >

            {{-- result dropdown --}}
            <div
                id="employeeSearchResults"
                class="hidden absolute w-full bg-white border rounded shadow mt-1 z-50">
            </div>

            {{-- field error --}}
            @error('employee_id')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

    {{-- ================= KPI CURRENT YEAR ================= --}}
    <div class="mt-6">
        <h3 class="font-semibold mb-3">KPI – Current Year</h3>

        {{-- KPI ASPECTS --}}
        <div class="grid grid-cols-3 gap-4">
            <div>
                <label class="block mb-1">Business Score</label>
                <input type="number" step="0.01" name="business_score"
                    class="border p-2 w-full rounded"
                    value="{{ old('business_score') }}">
            </div>

            <div>
                <label class="block mb-1">Behavior Score</label>
                <input type="number" step="0.01" name="behavior_score"
                    class="border p-2 w-full rounded"
                    value="{{ old('behavior_score') }}">
            </div>

            <div>
                <label class="block mb-1">PA Score</label>
                <input type="number" step="0.01" name="pa_score"
                    class="border p-2 w-full rounded"
                    value="{{ old('pa_score') }}">
            </div>
        </div>

        {{-- KPI PERIOD --}}
        <div class="mt-4">
            <label class="block font-semibold mb-2">KPI Period</label>

            <div class="flex gap-6">
                <label class="flex items-center gap-2">
                    <input type="radio" name="kpi_period" value="june"
                        {{ old('kpi_period') === 'june' ? 'checked' : '' }}>
                    June
                </label>

                <label class="flex items-center gap-2">
                    <input type="radio" name="kpi_period" value="december"
                        {{ old('kpi_period') === 'december' ? 'checked' : '' }}>
                    December
                </label>
            </div>

            @error('kpi_period')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
    </div>


    {{-- ================= ASSESSMENT ================= --}}
    <div class="mt-6">
        <label class="block mb-1">Assessment Link</label>
        <input type="text" name="assessment_link"
            class="border p-2 w-full rounded"
            value="{{ old('assessment_link') }}">
    </div>

    {{-- ================= ACTION ================= --}}
    <button
        type="submit"
        class="mt-6 bg-blue-600 text-white px-5 py-2 rounded"
        onclick="
            if (!document.getElementById('employee_id').value) {
                alert('Please select an employee from the list');
                return false;
            }
        "
    >
        Save
    </button>


        </form>
    </div>

    {{-- SEARCH SCRIPT --}}
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const input = document.getElementById('employeeSearch');
        const hiddenInput = document.getElementById('employee_id');
        const resultsBox = document.getElementById('employeeSearchResults');

        const SEARCH_URL = "{{ route('admin.search.employees') }}";

        async function fetchResults() {
            const q = input.value.trim();

            if (q.length < 1) {
                resultsBox.classList.add('hidden');
                resultsBox.innerHTML = '';
                return;
            }

            try {
                const res = await fetch(SEARCH_URL + '?q=' + encodeURIComponent(q), {
                    headers: { 'Accept': 'application/json' }
                });

                const data = await res.json();

                if (!Array.isArray(data) || data.length === 0) {
                    resultsBox.innerHTML =
                        "<div class='p-3 text-gray-500'>No results</div>";
                } else {
                    resultsBox.innerHTML = data.map(item => `
                        <div
                            class="p-2 border-b hover:bg-gray-100 cursor-pointer"
                            onclick="selectEmployee('${item.employee_id}', '${item.name}')"
                        >
                            <strong>${item.employee_id}</strong> - ${item.name}
                        </div>
                    `).join('');
                }

                resultsBox.classList.remove('hidden');

            } catch (err) {
                console.error(err);
            }
        }

        input.addEventListener('keyup', fetchResults);

        document.addEventListener('click', function (e) {
            if (!input.contains(e.target) && !resultsBox.contains(e.target)) {
                resultsBox.classList.add('hidden');
            }
        });

        window.selectEmployee = function (id, name) {
            input.value = `${id} - ${name}`;
            hiddenInput.value = id;
            resultsBox.classList.add('hidden');
        };
    });
    </script>

</x-app-layout>
