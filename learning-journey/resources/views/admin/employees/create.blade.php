<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Add Sales Superintendent
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto bg-white p-6 shadow rounded">

            <form action="{{ route('admin.employees.store') }}" method="POST" class="space-y-4">
                @csrf

                @include('admin.employees.form')

                <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                    Save
                </button>
            </form>

        </div>
    </div>
</x-app-layout>
