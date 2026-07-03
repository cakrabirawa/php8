<x-app-layout>
    <x-slot name="header">Edit Store</x-slot>

    <div class="py-6">
        <div class="max-w-xl mx-auto bg-white p-6 shadow rounded">

            {{-- UPDATE STORE --}}
            <form method="POST" action="{{ route('admin.stores.update', $store->id) }}" class="space-y-4">
                @csrf
                @method('PUT')

                {{-- ACCOUNT INFO --}}
                <div class="border rounded p-4 bg-gray-50">
                    <h3 class="text-sm font-semibold mb-3 text-gray-700">Store Account</h3>

                    <div>
                        <label class="text-sm text-gray-600">Login ID</label>
                        <input type="text"
                            value="{{ $store->user->email ?? '-' }}"
                            class="w-full bg-gray-100 border-gray-300 rounded"
                            disabled>
                    </div>
                </div>

                {{-- STORE FORM --}}
                @include('admin.stores.form')

                <button
                    class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition shadow">
                    Update
                </button>
            </form>

            {{-- RESET PASSWORD --}}
            @if($store->user)
                <hr class="my-6">

                <form method="POST"
                    action="{{ route('admin.stores.reset-password', $store->id) }}"
                    onsubmit="return confirm('Reset password store ini ke default?');">
                    @csrf

                    <button
                        class="w-full bg-red-600 text-white px-6 py-2 rounded-lg
                               hover:bg-red-700 transition shadow">
                        Reset Password Store
                    </button>
                </form>
            @endif

        </div>
    </div>
</x-app-layout>
