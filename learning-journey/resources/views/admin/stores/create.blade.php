<x-app-layout>
    <x-slot name="header">Add Store</x-slot>

    <div class="py-6 flex justify-center">
        <div class="w-full max-w-md bg-white p-6 shadow rounded">

            <form method="POST" action="{{ route('admin.stores.store') }}" class="space-y-4">
                @csrf

                @include('admin.stores.form')

                <div class="text-center">
                    <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Save
                    </button>
                </div>

            </form>

        </div>
    </div>
</x-app-layout>
