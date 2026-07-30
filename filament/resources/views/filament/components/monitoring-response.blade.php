<div class="space-y-3 p-2">
    <div class="text-sm font-medium text-gray-500 dark:text-gray-400">
        Log ID: <span class="font-mono text-gray-900 dark:text-white">#{{ $record->id }}</span>
    </div>

    <div class="rounded-lg bg-gray-50 p-4 font-mono text-xs dark:bg-zinc-900 overflow-x-auto">
        @if(is_array($response))
            <pre class="text-gray-900 dark:text-gray-100">{{ json_encode($response, JSON_PRETTY_PRINT) }}</pre>
        @else
            <p class="text-danger-600 dark:text-danger-400">{{ $response }}</p>
        @endif
    </div>
</div>
