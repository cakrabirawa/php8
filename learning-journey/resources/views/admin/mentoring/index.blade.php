<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Mentoring Verification
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4">

        <form method="GET" class="mb-6">
            <div class="flex items-center gap-3">
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search name / employee ID / store..."
                    class="w-full md:w-96 border rounded-lg px-4 py-2 focus:ring focus:ring-blue-200"
                >

                <button
                    type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    Search
                </button>
            </div>
        </form>

            {{-- GRID: HP 1 kolom, Tablet 2 kolom, Desktop 3 kolom --}}
            <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-3 gap-6">

                @foreach ($mentorings as $m)
                    <div class="bg-white border rounded-xl shadow-sm hover:shadow-md transition p-6">

                        {{-- Header Card --}}
                        <div class="mb-4">
                            <h3 class="text-xl font-semibold text-gray-900">
                                {{ $m->employee->name ?? 'Nama tidak ditemukan' }}
                            </h3>
 
                            <p class="text-gray-500 text-sm">
                                Employee ID: 
                                <span class="font-medium text-gray-700">{{ $m->employee_id }}</span>
                            </p>
                        </div>

                        {{-- Store --}}
                        <p class="text-gray-600 mb-3">
                            Store: 
                            <span class="font-medium text-gray-800">{{ trim($m->store?->name ?? '-') }}</span>
                        </p>

                        {{-- Status --}}
                        <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full
                            {{ $m->status == 'pending' 
                                ? 'bg-yellow-100 text-yellow-700' 
                                : 'bg-green-100 text-green-700' }}">
                            {{ ucfirst($m->status) }}
                        </span>

                        {{-- Button --}}
                        <div class="mt-5">
                            <a href="{{ route('admin.mentoring.show', $m->employee_id) }}"
                                class="w-full inline-block text-center bg-blue-600 hover:bg-blue-700 text-white font-medium px-4 py-2 rounded-lg">
                                View Details
                            </a>
                        </div>

                    </div>
                @endforeach

            </div>

            {{-- PAGINATION --}}
            <div class="mt-8">
                {{ $mentorings->links() }}
            </div>

        </div>
    </div>
</x-app-layout>
