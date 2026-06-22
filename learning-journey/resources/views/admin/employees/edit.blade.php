<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Sales Superintendent
        </h2>
    </x-slot>

    <div class="py-8 flex justify-center">
        <div class="w-full max-w-xl bg-white p-8 shadow-md rounded-lg">

            <form action="{{ route('admin.employees.update', $employee->employee_id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                @include('admin.employees.form', ['employee' => $employee])

                <div class="flex justify-end">
                    <button 
                        class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition shadow">
                        Update Employee
                    </button>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>
