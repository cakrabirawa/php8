<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">
                    Edit Checklist Template
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    Month {{ $template->month }} • Week {{ $template->week }}
                </p>
            </div>

            {{-- TEMPLATE SELECTOR --}}
            <form method="GET" id="templateForm"
                class="flex items-center gap-2">

            <select id="monthSelect"
                    class="border rounded-lg px-6 py-2 text-sm">
                @for($m = 1; $m <= 6; $m++)
                    <option value="{{ $m }}" 
                        {{ (int)($month ?? 1) === $m ? 'selected' : '' }}>
                        Month {{ $m }}
                    </option>
                @endfor
            </select>

            <select id="weekSelect"
                    class="border rounded-lg px-6 py-2 text-sm">
                @for($w = 1; $w <= 4; $w++)
                    <option value="{{ $w }}" 
                        {{ (int)($week ?? 1) === $w ? 'selected' : '' }}>
                        Week {{ $w }}
                    </option>
                @endfor
            </select>

                <button type="button"
                        onclick="goToTemplate()"
                        class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 text-sm">
                    Edit Template
                </button>
            </form>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-6">

            {{-- SUCCESS ALERT --}}
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-50 border border-green-300 text-green-700 rounded-xl shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow-lg rounded-2xl p-8 border border-gray-100">

                <form method="POST"
                      action="{{ route('admin.onboarding.template.update', $template->id) }}">
                    @csrf
                    @method('PUT')

                    {{-- ================= TITLE SECTION ================= --}}
                    <div class="mb-10">
                        <label class="block text-sm font-semibold text-gray-600 mb-2">
                            Template Title
                        </label>

                        <input type="text"
                               name="title"
                               value="{{ $template->template_json['title'] ?? '' }}"
                               class="w-full border border-gray-300 rounded-xl px-4 py-3 
                                      focus:ring-2 focus:ring-indigo-200 
                                      focus:border-indigo-500 transition">

                        <p class="text-xs text-gray-400 mt-2">
                            This title will appear in onboarding checklist.
                        </p>
                    </div>

                    {{-- ================= ITEMS SECTION ================= --}}
                    <div>
                        <div class="flex justify-between items-center mb-4">
                            <label class="text-sm font-semibold text-gray-600">
                                Checklist Items
                            </label>

                            <button type="button"
                                    onclick="addItem()"
                                    class="bg-indigo-600 text-white text-sm px-4 py-2 rounded-lg hover:bg-indigo-700 transition">
                                + Add Item
                            </button>
                        </div>

                        <div id="items-wrapper" class="space-y-3">
                            @foreach($template->template_json['items'] ?? [] as $item)
                                <div class="flex items-center gap-3 bg-gray-50 border border-gray-200 rounded-xl p-3 hover:shadow-sm transition">
                                    
                                    <div class="flex-1">
                                        <input type="text"
                                               name="items[]"
                                               value="{{ is_array($item) ? ($item['text'] ?? '') : $item }}"
                                               class="w-full bg-white border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 transition">
                                    </div>

                                    <button type="button"
                                            onclick="this.parentElement.remove()"
                                            class="bg-red-100 text-red-600 px-3 py-2 rounded-lg hover:bg-red-200 transition text-sm">
                                        Remove
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- ================= MANDATORY TASKS ================= --}}
                    <div class="mt-10">
                        <div class="flex justify-between items-center mb-4">
                            
                            <div>
                                <label class="text-sm font-semibold text-gray-700">
                                    Mandatory Learning / Tasks
                                </label>

                                <p class="text-xs text-gray-400 mt-1">
                                    Required learning materials or mandatory activities for employees.
                                </p>
                            </div>

                            <button type="button"
                                    onclick="addMandatoryTask()"
                                    class="bg-indigo-600 text-white text-sm px-4 py-2 rounded-lg hover:bg-indigo-700 transition">
                                + Add Mandatory Task
                            </button>
                        </div>

                        <div id="mandatory-wrapper" class="space-y-3">

                            @foreach($template->template_json['mandatory_tasks'] ?? [] as $task)

                                <div class="flex items-center gap-3 bg-gray-50 border border-gray-200 rounded-xl p-3 hover:shadow-sm transition">

                                    {{-- ICON --}}
                                    <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-indigo-100 text-indigo-600">
                                        📘
                                    </div>

                                    {{-- INPUT --}}
                                    <div class="flex-1">
                                        <input type="text"
                                            name="mandatory_tasks[]"
                                            value="{{ is_array($task) ? ($task['text'] ?? '') : $task }}"
                                            placeholder="Enter mandatory task..."
                                            class="w-full bg-white border border-gray-300 rounded-lg px-3 py-2 
                                                    focus:ring-2 focus:ring-indigo-200 
                                                    focus:border-indigo-500 transition">
                                    </div>

                                    {{-- REMOVE --}}
                                    <button type="button"
                                            onclick="this.parentElement.remove()"
                                            class="bg-gray-100 text-gray-600 px-3 py-2 rounded-lg hover:bg-gray-200 transition text-sm">
                                        Remove
                                    </button>

                                </div>

                            @endforeach

                        </div>
                    </div>

                    {{-- ================= ACTION BUTTON ================= --}}
                    <div class="mt-10 flex justify-end">
                        <button type="submit"
                                class="bg-green-600 text-white px-6 py-3 rounded-xl font-semibold hover:bg-green-700 transition shadow-md">
                            Save Changes
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    {{-- ================= JS ================= --}}
    <script>
        function addItem() {
            let wrapper = document.getElementById('items-wrapper');
            wrapper.insertAdjacentHTML('beforeend', `
                <div class="flex items-center gap-3 bg-gray-50 border border-gray-200 rounded-xl p-3 hover:shadow-sm transition">
                    <div class="flex-1">
                        <input type="text"
                               name="items[]"
                               class="w-full bg-white border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 transition">
                    </div>

                    <button type="button"
                            onclick="this.parentElement.remove()"
                            class="bg-red-100 text-red-600 px-3 py-2 rounded-lg hover:bg-red-200 transition text-sm">
                        Remove
                    </button>
                </div>
            `);
        }

        function addMandatoryTask() {
            let wrapper = document.getElementById('mandatory-wrapper');

            wrapper.insertAdjacentHTML('beforeend', `
                <div class="flex items-center gap-3 bg-gray-50 border border-gray-200 rounded-xl p-3 hover:shadow-sm transition">

                    <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-indigo-100 text-indigo-600">
                        📘
                    </div>

                    <div class="flex-1">
                        <input type="text"
                            name="mandatory_tasks[]"
                            placeholder="Enter mandatory task..."
                            class="w-full bg-white border border-gray-300 rounded-lg px-3 py-2 
                                    focus:ring-2 focus:ring-indigo-200 
                                    focus:border-indigo-500 transition">
                    </div>

                    <button type="button"
                            onclick="this.parentElement.remove()"
                            class="bg-gray-100 text-gray-600 px-3 py-2 rounded-lg hover:bg-gray-200 transition text-sm">
                        Remove
                    </button>

                </div>
            `);
        }

        function goToTemplate() {
        let month = document.getElementById('monthSelect').value;
        let week = document.getElementById('weekSelect').value;

        let url = `/admin/onboarding/template/${month}/${week}/edit`;
        window.location.href = url;
        }
    </script>
</x-app-layout>