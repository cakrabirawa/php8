<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold">Edit Training Score</h2>
            <a href="{{ route('admin.development.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded text-sm hover:bg-gray-600 transition">
                Back
            </a>
        </div>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto px-4">
        <form action="{{ route('admin.development.update', $score->id) }}" method="POST" class="bg-white p-6 shadow rounded-lg space-y-6">
            @csrf
            @method('PUT')

            {{-- 👤 SECTION 1: EMPLOYEE (READ ONLY) --}}
            <div class="col-span-2">
                <label class="font-bold text-gray-700">Employee</label>
                <div class="mt-1">
                    <select class="w-full border rounded-lg p-2 bg-gray-100 cursor-not-allowed" disabled>
                        @foreach ($employees as $emp)
                            <option value="{{ $emp->employee_id }}"
                                {{ $emp->employee_id == $score->employee_id ? 'selected' : '' }}>
                                {{ $emp->employee_id }} - {{ $emp->name }}
                            </option>
                        @endforeach
                    </select>
                    <input type="hidden" name="employee_id" value="{{ $score->employee_id }}">
                </div>
            </div>

            <hr class="border-gray-100">

            {{-- 📊 SECTION 2: SCORES (0-100) --}}
            <div>
                <h3 class="font-bold text-lg text-gray-800 mb-4 flex items-center">
                    <span class="bg-blue-600 w-2 h-6 rounded mr-2"></span>
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
                            <input type="number" name="{{ $field }}" value="{{ old($field, $score->$field) }}"
                                class="w-full border rounded px-3 py-2 focus:border-blue-500" min="0" max="100">
                        </div>
                        @endforeach
                    </div>

                    {{-- 🔥 RSO GROUP ASSESSMENT (Persis urutan Add Form) --}}
                    <div class="border rounded-xl p-5 bg-gray-50 border-gray-200 shadow-sm">
                        <h4 class="font-bold mb-4 text-orange-700 flex items-center uppercase text-sm tracking-wider">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            RSO Assessment Modules
                        </h4>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4">
                            @foreach([
                                'rso_supervisory_skill' => 'RSO Supervisory Skill',
                                'rso_retail_salesmanship' => 'RSO Retail Salesmanship',
                                'rso_customer_service_loyalty' => 'RSO Customer Service & Loyalty',
                                'rso_product_merchandising' => 'RSO Product & Merchandising',
                                'rso_visual_merchandising' => 'RSO Visual Merchandising',
                                'rso_retail_store_promotion' => 'RSO Retail Store Promotion',
                                'rso_store_financial_perspective' => 'RSO Store Financial Perspective',
                                'rso_store_general_checkup_strategy' => 'RSO Store General Check Up & Strategy',
                            ] as $field => $label)
                            <div>
                                <label class="block text-xs font-bold text-gray-500 mb-1">{{ $label }}</label>
                                <input type="number" name="{{ $field }}" value="{{ old($field, $score->$field) }}"
                                    class="w-full border border-gray-300 rounded px-3 py-2 bg-white focus:ring-orange-200 focus:border-orange-500" min="0" max="100">
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <hr class="border-gray-100">

            {{-- 📝 SECTION 3: TRAINING NOTES --}}
            <div class="space-y-4">
                <h3 class="font-bold text-lg text-gray-800 flex items-center">
                    <span class="bg-gray-400 w-2 h-6 rounded mr-2"></span>
                    Training Notes
                </h3>

                <div class="grid grid-cols-1 gap-4">
                    @foreach([
                        'inhouse_training' => 'In-House Training',
                        'public_training' => 'Public Training',
                        'intensive_training' => 'Intensive Training',
                        'development_program' => 'Development Program'
                    ] as $field => $label)
                    <div>
                        <label class="block text-sm font-semibold text-gray-600 mb-1">{{ $label }}</label>
                        <textarea name="{{ $field }}" rows="2" class="w-full border rounded px-3 py-2 focus:ring-blue-200">{{ old($field, $score->$field) }}</textarea>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- 💾 ACTION BUTTONS --}}
            <div class="flex justify-between items-center pt-6 border-t">
                <button type="button" 
                        onclick="if(confirm('Are you sure you want to delete this record?')) document.getElementById('delete-form').submit();"
                        class="px-4 py-2 bg-red-100 text-red-600 rounded hover:bg-red-600 hover:text-white transition font-medium">
                    Delete Record
                </button>

                <button type="submit" class="px-10 py-3 bg-blue-600 text-white font-bold rounded-lg shadow-lg hover:bg-blue-700 transform hover:scale-105 transition">
                    Save Changes
                </button>
            </div>
        </form>

        {{-- Hidden Delete Form --}}
        <form id="delete-form" action="{{ route('admin.development.destroy', $score->id) }}" method="POST" class="hidden">
            @csrf
            @method('DELETE')
        </form>
    </div>
</x-app-layout>