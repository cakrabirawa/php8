<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Add Introduction</h2>
    </x-slot>

    <div class="py-6 flex justify-center">
        <div class="max-w-4xl mx-auto bg-white p-6 shadow rounded-md">
            @if ($errors->any())
                <div class="mb-4 rounded bg-red-100 border border-red-400 text-red-700 px-4 py-3">
                    <strong>Gagal menyimpan data:</strong>
                    <ul class="list-disc pl-5 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ route('admin.introductions.store') }}">
                @csrf
                @include('admin.introductions.form', [
                    'introduction' => $introduction,
                    'mode' => 'create'
                ])

                <div class="mt-6">
                    <button class="w-full bg-green-700 text-white py-2 rounded">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
