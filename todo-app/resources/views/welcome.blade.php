<x-layout :page-title="$pageTitle ?? 'TailAdmin'">
    {{-- This will dynamically include the view specified by the controller --}}
    @include($pageView)
</x-layout>
