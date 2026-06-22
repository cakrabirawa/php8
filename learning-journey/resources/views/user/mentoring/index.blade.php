<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Mentoring List</h2>
    </x-slot>

    <div class="py-6 max-w-6xl mx-auto" x-data="{ open: false, selected: null }">

        <a href="{{ route('user.mentoring.create') }}"
           class="mb-4 inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            + Add Mentoring
        </a>

        <div class="bg-white shadow rounded-lg overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="text-left px-4 py-3">Employee</th>
                        <th class="text-left px-4 py-3">Mentor</th>
                        <th class="text-center px-4 py-3">Status</th>
                        <th class="text-center px-4 py-3">Sent</th>
                        <th class="text-center px-4 py-3">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($mentorings as $m)
                        <tr class="border-t hover:bg-gray-50">
                            <td class="px-4 py-3">
                                {{ $m->employee->name ?? '-' }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $m->mentor_name }}
                            </td>

                            <td class="px-4 py-3 text-center">
                                <span class="px-2 py-1 text-xs rounded-full
                                    {{ $m->status === 'verified'
                                        ? 'bg-green-100 text-green-700'
                                        : 'bg-yellow-100 text-yellow-700' }}">
                                    {{ ucfirst($m->status) }}
                                </span>
                            </td>

                            <td class="px-4 py-3 text-center text-gray-600">
                                {{ $m->created_at?->format('d M Y') ?? '-' }}
                            </td>

                            <td class="px-4 py-3 text-center">
                                <button
                                    @click="
                                        open = true;
                                        selected = {
                                            mentor: '{{ $m->mentor_name }}',
                                            notes: @js($m->notes),
                                            notes_hr: @js($m->notes_hr),
                                            status: '{{ ucfirst($m->status) }}',
                                            date: '{{ $m->created_at?->format('d M Y') ?? '-' }}',
                                            score: {{ $m->score ?? 'null' }}
                                        };
                                    "
                                    class="text-blue-600 hover:underline text-sm">
                                    View
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-6 text-center text-gray-500">
                                No mentoring data found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- MODAL --}}
        <div
            x-show="open"
            x-cloak
            class="fixed inset-0 bg-black/50 flex items-center justify-center z-50"
        >
            <div
                @click.away="open = false"
                class="bg-white rounded-lg shadow-lg w-full max-w-lg p-6"
            >
                <h3 class="text-lg font-semibold mb-4">
                    Mentoring Detail
                </h3>

                <div class="space-y-3 text-sm">
                    <p>
                        <span class="font-semibold">Mentor:</span>
                        <span x-text="selected.mentor"></span>
                    </p>

                    <p>
                        <span class="font-semibold">Status:</span>
                        <span x-text="selected.status"></span>
                    </p>

                    <div>
                        <p class="font-semibold mb-1">Mentor Notes</p>
                        <div class="bg-gray-50 border rounded p-3">
                            <p x-text="selected.notes ?? '-'"></p>
                        </div>
                    </div>

                    <p>
                        <span class="font-semibold">Score:</span>
                        <span x-text="selected.score !== null ? selected.score : '-'"></span>
                    </p>

                    <div x-show="selected.notes_hr">
                        <p class="font-semibold mb-1 text-green-700">HR Notes</p>
                        <div class="bg-green-50 border border-green-200 rounded p-3 text-green-800">
                            <p x-text="selected.notes_hr"></p>
                        </div>
                    </div>
                        <p>
                            <span class="font-semibold">Sent:</span>
                            <span x-text="selected.date"></span>
                        </p>
                </div>

                <div class="mt-6 text-right">
                    <button
                        @click="open = false"
                        class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">
                        Close
                    </button>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
