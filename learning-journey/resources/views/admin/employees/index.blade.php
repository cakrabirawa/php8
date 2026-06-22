<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Sales Superintendent List
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Search & Filter -->
    <form method="GET" class="mb-4" id="employeeSearchForm">
        <div class="flex items-center justify-between">

            <!-- LEFT: Search + Filter -->
            <div class="flex gap-3 items-end">

                <!-- SEARCH -->
                <div class="relative">
                    <input 
                        type="text"
                        name="search"
                        id="employeeSearch"
                        value="{{ $search }}"
                        placeholder="Search Name, ID, Store..."
                        class="border px-4 py-2 rounded w-80 text-black"
                        autocomplete="off"
                    >

                    <div 
                        id="searchResults"
                        class="hidden absolute w-full bg-white border rounded shadow mt-1 z-50">
                    </div>
                </div>

                <!-- REGION -->
                <select 
                    name="region" 
                    id="regionFilter"
                    class="border px-4 py-2 rounded w-56 text-black">
                    <option value=""> All Divisions </option>
                    @foreach($regions as $region)
                        <option value="{{ $region->id }}" 
                            {{ $filterRegion == $region->id ? 'selected' : '' }}>
                            {{ $region->name }}
                        </option>
                    @endforeach
                </select>
                <button 
                    class="border border-green-700 bg-gray-800 text-white px-4 py-2 rounded hover:bg-gray-900 transition">
                    Search
                </button>

            </div>

            @if(in_array(auth()->user()->role, ['admin']))
            <div class="flex gap-2">
            <button 
                type="button"
                onclick="openImportModal()"
                class="border border-blue-600 bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700 transition">
                Import CSV
            </button>

            <!-- RIGHT: Add Employee -->
            <a href="{{ route('admin.employees.create') }}" 
                class="border border-green-700 text-white px-5 py-2 rounded bg-green-500 hover:bg-green-700 transition">
                Add Sales Superintendent
            </a>
            </div>
            @endif
        </div>
    </form>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-3">
            {{ session('success') }}
        </div>
    @endif

    @if(session('warning'))
        <div class="bg-yellow-100 text-yellow-800 p-3 rounded mb-3">
            {{ session('warning') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 text-red-800 p-3 rounded mb-3">
            {{ session('error') }}
        </div>
    @endif

    @if(session('errors_import') && count(session('errors_import')) > 0)
    <div class="bg-red-100 text-red-800 p-4 rounded mb-4">

        <h4 class="font-semibold mb-2">
            Import Errors ({{ count(session('errors_import')) }})
        </h4>

        <div class="max-h-40 overflow-y-auto text-sm">
            <ul class="list-disc ml-5 space-y-1">
                @foreach(session('errors_import') as $err)
                    <li>
                        <b>{{ $err['employee_id'] }}</b> - {{ $err['name'] }}
                        → {{ $err['issue'] }}
                    </li>
                @endforeach
            </ul>
        </div>

    </div>
@endif

@php
function sort_link($column) {
    $currentSort = request('sort');

    if ($currentSort === $column.'_asc') {
        return $column.'_desc';
    } else {
        return $column.'_asc';
    }
}
@endphp

 <!-- TABLE -->
<div class="bg-white shadow-md rounded-xl overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full text-sm text-gray-700">
            
            <thead class="bg-gray-100 text-gray-600 uppercase text-xs tracking-wider">
            <tr>

                <!-- EMPLOYEE ID -->
                <th class="px-4 py-3 text-left">
                    <a href="?{{ http_build_query(array_merge(request()->all(), ['sort' => sort_link('employee_id')])) }}">
                        Employee ID
                        @if(request('sort') == 'employee_id_asc')
                            <span class="text-xs">▲</span>
                        @elseif(request('sort') == 'employee_id_desc')
                            <span class="text-xs">▼</span>
                        @endif
                    </a>
                </th>

                <!-- NAME -->
                <th class="px-4 py-3 text-left">
                    <a href="?{{ http_build_query(array_merge(request()->all(), ['sort' => sort_link('name')])) }}">
                        Name
                        @if(request('sort') == 'name_asc')
                            <span class="text-xs">▲</span>
                        @elseif(request('sort') == 'name_desc')
                            <span class="text-xs">▼</span>
                        @endif
                    </a>
                </th>

                <!-- CONTRACT (NO SORT) -->
                <th class="px-4 py-3 text-left">Contract</th>

                <!-- REGION -->
                <th class="px-4 py-3 text-left">
                    <a href="?{{ http_build_query(array_merge(request()->all(), ['sort' => sort_link('region')])) }}">
                        Division
                        @if(request('sort') == 'region_asc')
                            <span class="text-xs">▲</span>
                        @elseif(request('sort') == 'region_desc')
                            <span class="text-xs">▼</span>
                        @endif
                    </a>
                </th>

                <!-- STORE -->
                <th class="px-4 py-3 text-left">
                    <a href="?{{ http_build_query(array_merge(request()->all(), ['sort' => sort_link('store')])) }}">
                        Store
                        @if(request('sort') == 'store_asc')
                            <span class="text-xs">▲</span>
                        @elseif(request('sort') == 'store_desc')
                            <span class="text-xs">▼</span>
                        @endif
                    </a>
                </th>

                <!-- JOINING DATE -->
                <th class="px-4 py-3 text-left">
                    <a href="?{{ http_build_query(array_merge(request()->all(), ['sort' => sort_link('joining_date')])) }}">
                        Joining Date
                        @if(request('sort') == 'joining_date_asc')
                            <span class="text-xs">▲</span>
                        @elseif(request('sort') == 'joining_date_desc')
                            <span class="text-xs">▼</span>
                        @endif
                    </a>
                </th>

                @if(in_array(auth()->user()->role, ['admin']))
                    <th class="px-4 py-3 text-left">Actions</th>
                @endif

            </tr>
</thead>

            <tbody class="divide-y divide-gray-200">
            @foreach($employees as $emp)
                <tr
                    onclick="window.location='{{ route('admin.employees.report.show', $emp) }}'"
                    class="cursor-pointer group
                           hover:bg-blue-50
                           transition duration-200"
                >
                    <td class="px-4 py-3 font-medium text-gray-900 group-hover:text-blue-700 transition">
                        {{ $emp->employee_id }}
                    </td>

                    <td class="px-4 py-3 font-medium text-gray-900 group-hover:text-blue-700 transition">
                        {{ $emp->name }}
                    </td>

                    <td class="px-4 py-3">
                        <span class="px-2 py-1 text-xs rounded-full
                            {{ $emp->contract_type === 'Permanent'
                                ? 'bg-green-100 text-green-700'
                                : 'bg-yellow-100 text-yellow-700' }}">
                            {{ $emp->contract_type }}
                        </span>
                    </td>

                    <td class="px-4 py-3 text-center">
                        {{ $emp->region->short_name ?? '-' }}
                    </td>

                    <td class="px-4 py-3">
                        {{ $emp->store->name?? '-' }}
                    </td>

                    <td class="px-4 py-3 text-gray-600">
                        {{ \Carbon\Carbon::parse($emp->joining_date)->format('d M Y') }}
                    </td>

                    {{-- ACTION COLUMN --}}
                    @if(in_array(auth()->user()->role, ['admin']))
                    <td class="px-4 py-3" onclick="event.stopPropagation();">
                        <div class="flex gap-2">

                            <a href="{{ route('admin.employees.edit', $emp->employee_id) }}"
                               class="px-3 py-1 text-xs border border-yellow-500 text-yellow-600 rounded
                                      hover:bg-yellow-500 hover:text-white transition">
                                Edit
                            </a>

                            <form action="{{ route('admin.employees.destroy', $emp->employee_id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="px-3 py-1 text-xs border border-red-500 text-red-600 rounded
                                               hover:bg-red-500 hover:text-white transition">
                                    Delete
                                </button>
                            </form>

                        </div>
                    </td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="p-4 border-t">
        {{ $employees->links() }}
    </div>
</div>


        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const input = document.getElementById('employeeSearch');
        const resultsBox = document.getElementById('searchResults');
        const form = document.getElementById('employeeSearchForm');

        const SEARCH_URL = "{{ route('admin.search.employees') }}";

        async function fetchResults() {
            const q = input.value.trim();

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
                    resultsBox.innerHTML =
                        "<div class='p-3 text-gray-500'>No results</div>";
                } else {
                    resultsBox.innerHTML = data.map(item => `
                        <div
                            class="p-2 border-b hover:bg-gray-100 cursor-pointer"
                            onclick="selectEmployee('${item.employee_id}')"
                        >
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

        document.addEventListener('click', function(e) {
            if (!input.contains(e.target) && !resultsBox.contains(e.target)) {
                resultsBox.classList.add("hidden");
            }
        });

        window.selectEmployee = function(value) {
            input.value = value;
            resultsBox.classList.add("hidden");
            form.submit();
        };
    });

    function openImportModal() {
        document.getElementById('importModal').classList.remove('hidden');
        document.getElementById('importModal').classList.add('flex');
    }

    function closeImportModal() {
        document.getElementById('importModal').classList.add('hidden');
        document.getElementById('importModal').classList.remove('flex');
    }

    function confirmImport() {
        if (confirm('Are you sure you want to import this CSV data?')) {
            document.getElementById('importForm').submit();
        }
    }
    </script>
<!-- IMPORT CSV MODAL -->
<div id="importModal"
     class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">

    <div class="bg-white rounded-lg w-full max-w-md p-6 text-black">
        <h3 class="text-lg font-semibold mb-2">Import Employees (CSV)</h3>

        <p class="text-sm text-gray-600 mb-4">
            Format CSV:
            employee_id, name, contract_type, store name, birthday date, initial_employment_date, joining_date, permanent date
        </p>
        <a href="{{ asset('templates/Employees.csv') }}"
            download
            class="inline-block mb-3 text-sm text-blue-600 hover:underline">
                Download CSV Template
        </a>


        <form id="importForm"
              action="{{ route('admin.employees.import') }}"
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

</x-app-layout>
