<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My To-Do List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <!-- Form Tambah To-Do -->
                <form action="{{ route('todo.store') }}" method="POST" class="flex mb-6">
                    @csrf
                    <input type="text" name="title" placeholder="Tambah tugas baru..." required
                           class="flex-1 rounded-l-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-r-md font-bold text-sm">
                        Tambah
                    </button>
                </form>

                <!-- Daftar To-Do -->
                <div class="space-y-3">
                    @forelse($todos as $todo)
                        <div class="flex items-center justify-between p-3 bg-gray-50 border rounded-md">
                            <div class="flex items-center space-x-3">
                                <!-- Tombol Ceklis (Update Status) -->
                                <form action="{{ route('todo.update', $todo) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="flex items-center">
                                        @if($todo->is_completed)
                                            <span class="text-green-600 font-bold">✓</span>
                                        @else
                                            <span class="text-gray-300 font-bold border-2 border-gray-300 rounded px-1 text-xs">O</span>
                                        @endif
                                    </button>
                                </form>
                                
                                <!-- Judul To-Do -->
                                <span class="{{ $todo->is_completed ? 'line-through text-gray-400' : 'text-gray-800' }}">
                                    {{ $todo->title }}
                                </span>
                            </div>

                            <!-- Tombol Hapus -->
                            <form action="{{ route('todo.destroy', $todo) }}" method="POST" onsubmit="return confirm('Hapus tugas ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 text-sm font-semibold">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    @empty
                        <p class="text-center text-gray-500 py-4">Belum ada tugas hari ini. Silakan tambah di atas!</p>
                    @endforelse
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
