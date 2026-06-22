<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Add Employee Training Score</h2>
    </x-slot>

    <div class="py-6 max-w-3xl mx-auto px-4">
        <form action="{{ route('admin.development.store') }}" method="POST" class="space-y-6 bg-white p-6 shadow rounded-lg border border-gray-100">
            @csrf

            {{-- 🔍 SECTION 1: SEARCH EMPLOYEE --}}
            <div class="col-span-2">
                <label class="font-semibold text-gray-700">Search Employee</label>
                <div class="relative mt-1">
                    <input 
                        type="text" 
                        id="employeeSearch"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                        placeholder="Ketik Employee ID atau Nama..."
                        autocomplete="off"
                    >
                    <input type="hidden" name="employee_id" id="employeeIdInput" required>

                    <button 
                        type="button"
                        id="searchBtn"
                        class="absolute right-3 top-2.5 text-gray-400 hover:text-blue-600 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                </div>

                <div id="searchResults" class="mt-2 bg-white shadow-xl border rounded-lg hidden overflow-hidden z-50 relative"></div>

                @if ($errors->has('employee_id'))
                    <p class="text-red-600 text-sm mt-1 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                        Isi field ini dengan memilih karyawan dari hasil pencarian.
                    </p>
                @endif
            </div>

            <hr class="border-gray-100">

            {{-- 📊 SECTION 2: SCORES --}}
            <div>
                <h3 class="font-bold text-lg text-gray-800 mb-4 flex items-center">
                    <span class="bg-blue-600 w-1.5 h-6 rounded-full mr-2"></span>
                    Scores (0–100)
                </h3>

                <div class="space-y-6">
                    {{-- 🔹 GENERAL SCORES --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        @foreach([
                            'gramedia_daily_store' => "Gramedia Daily's Store",
                            'learning_hours' => 'Learning Hours',
                            'nilai_ngecas' => 'Nilai NGECAS'
                        ] as $field => $label)
                        <div>
                            <label class="block text-sm font-semibold text-gray-600 mb-1">{{ $label }}</label>
                            <input type="number" name="{{ $field }}" value="{{ old($field) }}"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 outline-none" 
                                min="0" max="100" placeholder="0">
                        </div>
                        @endforeach
                    </div>

                    {{-- 🔥 RSO ASSESSMENT GROUP --}}
                    <div class="border rounded-xl p-5 bg-gray-50 border-gray-200">
                        <h4 class="font-bold mb-4 text-orange-700 flex items-center uppercase text-xs tracking-wider">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                            RSO Assessment
                        </h4>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4">
                            @php
                                $rsoFields = [
                                    'rso_supervisory_skill' => 'RSO Supervisory Skill',
                                    'rso_retail_salesmanship' => 'RSO Retail Salesmanship',
                                    'rso_customer_service_loyalty' => 'RSO Customer Service & Loyalty',
                                    'rso_product_merchandising' => 'RSO Product & Merchandising',
                                    'rso_visual_merchandising' => 'RSO Visual Merchandising',
                                    'rso_retail_store_promotion' => 'RSO Retail Store Promotion',
                                    'rso_store_financial_perspective' => 'RSO Store Financial Perspective',
                                    'rso_store_general_checkup_strategy' => 'RSO Store General Check Up & Strategy',
                                ];
                            @endphp

                            @foreach($rsoFields as $field => $label)
                            <div>
                                <label class="block text-xs font-bold text-gray-500 mb-1 uppercase">{{ $label }}</label>
                                <input type="number" name="{{ $field }}" value="{{ old($field) }}"
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 bg-white focus:ring-2 focus:ring-orange-400 outline-none" 
                                    min="0" max="100" placeholder="0">
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <hr class="border-gray-100">

            {{-- 📝 SECTION 3: TRAINING NOTES --}}
            <div>
                <h3 class="font-bold text-lg text-gray-800 mb-4 flex items-center">
                    <span class="bg-gray-400 w-1.5 h-6 rounded-full mr-2"></span>
                    Training Notes
                </h3>
                
                <div class="space-y-4">
                    @foreach([
                        'inhouse_training' => 'In-House Training',
                        'public_training' => 'Public Training',
                        'intensive_training' => 'Intensive Training',
                        'development_program' => 'Development Program'
                    ] as $field => $label)
                    <div>
                        <label class="block text-sm font-semibold text-gray-600 mb-1">{{ $label }}</label>
                        <textarea name="{{ $field }}" rows="2" 
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 outline-none placeholder-gray-300"
                            placeholder="Tambahkan catatan untuk {{ strtolower($label) }}...">{{ old($field) }}</textarea>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- 💾 SUBMIT BUTTON --}}
            <div class="pt-4">
                <button type="submit" class="w-full md:w-auto px-12 py-3 bg-blue-600 text-white font-bold rounded-lg shadow-lg hover:bg-blue-700 transform active:scale-95 transition duration-150">
                    Save Record
                </button>
            </div>
        </form>
    </div>

    {{-- 📜 SEARCH SCRIPT --}}
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const input = document.getElementById('employeeSearch');
        const resultsBox = document.getElementById('searchResults');
        const btn = document.getElementById('searchBtn');
        const employeeIdInput = document.getElementById('employeeIdInput');

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

                if (!res.ok) throw new Error('Network response was not ok');

                const data = await res.json();

                if (!Array.isArray(data) || data.length === 0) {
                    resultsBox.innerHTML = "<p class='p-3 text-gray-500 text-sm italic'>Karyawan tidak ditemukan...</p>";
                } else {
                    resultsBox.innerHTML = data.map(item => `
                        <div class="p-3 border-b last:border-0 hover:bg-blue-50 cursor-pointer transition flex justify-between items-center"
                            onclick="selectEmployee('${item.employee_id}', '${item.name}')">
                            <div>
                                <span class="font-bold text-blue-700">${item.employee_id}</span>
                                <span class="text-gray-600 ml-2">— ${item.name}</span>
                            </div>
                            <span class="text-xs text-gray-400">Pilih</span>
                        </div>
                    `).join('');
                }
                resultsBox.classList.remove("hidden");
            } catch (err) {
                resultsBox.innerHTML = "<p class='p-3 text-red-500 text-sm'>Gagal mengambil data.</p>";
                resultsBox.classList.remove("hidden");
            }
        }

        input.addEventListener('keyup', fetchResults);
        btn.addEventListener('click', (e) => { e.preventDefault(); fetchResults(); });

        window.selectEmployee = function(employee_id, name) {
            input.value = `${employee_id} - ${name}`;
            employeeIdInput.value = employee_id;
            resultsBox.classList.add("hidden");
            input.classList.add('bg-blue-50', 'border-blue-300');
        };

        // Menutup hasil pencarian jika klik di luar
        document.addEventListener('click', function (e) {
            if (!input.contains(e.target) && !resultsBox.contains(e.target)) {
                resultsBox.classList.add("hidden");
            }
        });
    });
    </script>
</x-app-layout>