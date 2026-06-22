<x-app-layout>

    <x-slot name="header">
        <h2 class="text-xl font-semibold">
            Competency Management
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto py-6 px-6 space-y-6">

        {{-- ALERT --}}
        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 text-red-700 p-3 rounded">
                {{ session('error') }}
            </div>
        @endif


        {{-- ADD COMPETENCY --}}
        <div class="bg-white shadow rounded-xl p-5">

            <h3 class="font-semibold mb-3">Add Competency</h3>

            <form method="POST" action="{{ route('admin.competency.store') }}" class="flex gap-3">
                @csrf

                <input
                    type="text"
                    name="name"
                    placeholder="Contoh: leadership skill"
                    class="w-full border rounded-lg px-3 py-2"
                    required
                >

                <button class="px-4 bg-green-600 text-white rounded-lg hover:bg-green-700">
                    Add
                </button>

            </form>

        </div>


        {{-- LIST --}}
        <div class="bg-white shadow rounded-xl p-5">

            <h3 class="font-semibold mb-4">Competency List</h3>

            <div class="space-y-3">

                @foreach($competencies as $comp)

                    <div class="flex justify-between items-center border rounded-lg px-4 py-2">

                        <div>
                            <p class="font-medium">
                                {{ ucwords(str_replace('_',' ', $comp->name)) }}
                            </p>

                            <p class="text-xs text-gray-400">
                                {{ $comp->slug }}
                            </p>
                        </div>

                        <div class="flex items-center gap-3">

                            <form method="POST" action="{{ route('admin.competency.delete', $comp->id) }}">
                                @csrf
                                @method('DELETE')

                                <button
                                    onclick="return confirm('Yakin hapus competency ini?')"
                                    class="text-red-500 hover:text-red-700 text-sm"
                                >
                                    Delete
                                </button>
                            </form>

                        </div>

                    </div>

                @endforeach

            </div>

        </div>

    </div>

</x-app-layout>