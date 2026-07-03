<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-center">
            {{ $introduction->employee->name ?? '-' }}
        </h2>
    </x-slot>

    <div class="py-6 flex justify-center">
        <div class="w-full max-w-4xl bg-white p-6 shadow rounded">

            <h3 class="text-lg font-semibold mb-4">
                Interview & FGD Result
            </h3>

            @include('admin.introductions.form', [
                'introduction' => $introduction,
                'mode' => 'show'
            ])


            <div class="mt-6 text-center">
                <a href="{{ route('admin.introductions.index') }}"
                   class="text-blue-600 hover:underline">
                    ← Back
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
