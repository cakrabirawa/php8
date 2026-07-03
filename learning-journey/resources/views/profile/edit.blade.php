<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- 🔒 PROFILE (VIEW ONLY) --}}
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">

                    @php
                        $role = auth()->user()->role;
                        $isLoginId = in_array($role, ['user', 'sales_superintendent']);
                    @endphp

                    <h3 class="text-lg font-semibold text-gray-800 mb-4">
                        Profile Information
                    </h3>

                    {{-- NAME --}}
                    <div class="mb-4">
                        <label class="block text-sm text-gray-500">Nama</label>
                        <div class="mt-1 px-3 py-2 border rounded bg-gray-50 text-gray-800">
                            {{ auth()->user()->name }}
                        </div>
                    </div>

                    {{-- LOGIN ID / USERNAME --}}
                    <div class="mb-4">
                        <label class="block text-sm text-gray-500">
                            {{ $isLoginId ? 'LOGIN ID' : 'Username' }}
                        </label>
                        <div class="mt-1 px-3 py-2 border rounded bg-gray-50 text-gray-800">
                            {{ auth()->user()->email }}
                        </div>
                    </div>

                </div>
            </div>

            {{-- 🔑 PASSWORD (MASIH BISA DIUBAH) --}}
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

        </div>
    </div>
</x-app-layout>