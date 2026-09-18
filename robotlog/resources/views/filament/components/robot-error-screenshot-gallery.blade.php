@php
    $fileName = $getState();
    $record = $getRecord();
    $url = null;

    if ($record && !empty($record->file_name)) {
        $url = $record->image_url ?? route('robot.error_screenshot', ['filename' => basename($record->file_name)]);
    }
@endphp

<div class="w-full">
    @if ($url)
        <div x-data="{ open: false }" class="relative inline-block">
            <button type="button" x-on:click="open = true"
                class="group block overflow-hidden rounded-lg border border-gray-200 bg-white p-0.5 shadow-sm transition hover:shadow-md dark:border-gray-700 dark:bg-gray-900">
                <div class="relative h-16 w-20 overflow-hidden bg-gray-100 sm:h-20 sm:w-24 dark:bg-gray-800">
                    <img src="{{ $url }}" alt="Screenshot robot"
                        class="h-full w-full object-cover transition duration-200 group-hover:scale-105" />
                </div>
            </button>

            <div x-show="open" x-transition x-cloak
                class="fixed inset-0 z-50 flex items-center justify-center bg-black/75 p-4" style="display: none;"
                x-on:click.self="open = false">
                <div
                    class="relative max-h-[90vh] max-w-6xl overflow-hidden rounded-2xl bg-white shadow-2xl dark:bg-gray-900">
                    <button type="button" x-on:click="open = false"
                        class="absolute right-3 top-3 z-10 inline-flex h-9 w-9 items-center justify-center rounded-full bg-white/90 text-lg font-semibold text-gray-800 shadow hover:bg-white"
                        aria-label="Close image">
                        ×
                    </button>

                    <img src="{{ $url }}" alt="Preview screenshot robot"
                        class="max-h-[90vh] w-auto max-w-full object-contain" />
                </div>
            </div>
        </div>
    @else
        <div
            class="flex h-32 w-52 items-center justify-center rounded-xl border border-dashed border-gray-300 bg-gray-50 text-sm text-gray-400 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-500">
            Tidak ada gambar
        </div>
    @endif
</div>
