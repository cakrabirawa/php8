<x-app-layout>
@php
function levelName($level) {
    return match((int)$level) {
        1 => 'Lone Ranger',
        2 => 'Team Player',
        3 => 'Team Leader',
        4 => 'Synergy Maker',
        5 => 'Collaborator',
        6 => 'Ecosystem Builder',
        default => '-'
    };
}
@endphp
<x-slot name="header">
<h2 class="text-xl font-semibold">
My Individual Development Plan
</h2>
</x-slot>

<div class="max-w-6xl mx-auto py-6 px-6">

{{-- BUTTON CREATE --}}
<div class="flex justify-end mb-6">
<a
href="{{ route('sales.idp.create') }}"
class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
>
+ Create IDP
</a>
</div>


@if($idps->count() == 0)

<div class="bg-white shadow rounded-xl p-8 text-center">

<p class="text-gray-500 mb-4">
You haven't created an Individual Development Plan yet.
</p>

<a
href="{{ route('sales.idp.create') }}"
class="bg-blue-600 text-white px-4 py-2 rounded"
>
Create Your First IDP
</a>

</div>

@else

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">

@foreach($idps as $idp)

@php
$statusColor = match($idp->status){
'draft' => 'bg-gray-100 text-gray-600',
'pending' => 'bg-yellow-100 text-yellow-700',
'waiting_hr' => 'bg-blue-100 text-blue-700',
'completed' => 'bg-green-100 text-green-700',
default => 'bg-gray-100 text-gray-600'
};
@endphp

<a href="{{ route('sales.idp.edit',$idp->id) }}">

<div class="bg-white shadow rounded-xl p-6 hover:shadow-lg transition cursor-pointer">

<div class="flex justify-between mb-3">

<h3 class="font-semibold text-lg">
{{ $idp->competency->name ?? '-' }}
</h3>

<span class="text-xs px-3 py-1 rounded {{ $statusColor }}">
{{ ucfirst(str_replace('_',' ',$idp->status)) }}
</span>

</div>


<p class="text-sm text-gray-600 mb-2">
Level:
<strong>{{ levelName($idp->current_level) }}</strong>
→
<strong>{{ levelName($idp->target_level) }}</strong>
</p>
 

<p class="text-sm text-gray-600 mb-3 line-clamp-2">
{{ $idp->target_idp }}
</p>


<div class="border-t pt-3">

<p class="text-sm text-gray-500 mb-2">
Tasks:
</p>

<ul class="list-disc pl-5 text-sm text-gray-700 space-y-1">

@foreach($idp->tasks as $task)

<li>
{{ $task->task }}

@if($task->target_date)
<span class="text-gray-400 text-xs">
({{ \Carbon\Carbon::parse($task->target_date)->format('d M Y') }})
</span>
@endif

</li>

@endforeach

</ul>

</div>

</div>

</a>

@endforeach

</div>

@endif

</div>

</x-app-layout>