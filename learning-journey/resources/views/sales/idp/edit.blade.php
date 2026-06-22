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
Individual Development Plan
</h2>
</x-slot>


<div class="max-w-5xl mx-auto py-6 px-6">


@if(session('success'))
<div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
{{ session('success') }}
</div>
@endif


{{-- ================= IDP INFORMATION ================= --}}
<div class="bg-white shadow rounded-xl p-6 space-y-6">

<h3 class="font-semibold text-lg">
IDP Information
</h3>


<div class="grid grid-cols-2 gap-6">

<div>
<p class="text-sm text-gray-500">Competency</p>
<p class="font-semibold">
{{ $idp->competency->name ?? '-' }}
</p>
</div>

<div>
<p class="text-sm text-gray-500">Status</p>

@php
$statusColor = match($idp->status){
'draft' => 'bg-gray-100 text-gray-600',
'pending' => 'bg-yellow-100 text-yellow-700',
'waiting_hr' => 'bg-blue-100 text-blue-700',
'completed' => 'bg-green-100 text-green-700',
default => 'bg-gray-100 text-gray-600'
};
@endphp

<span class="px-3 py-1 text-sm rounded {{ $statusColor }}">
{{ ucfirst(str_replace('_',' ',$idp->status)) }}
</span>

</div>

</div>


{{-- LEVEL --}}
<div class="flex items-center gap-3">

<span class="px-2 py-1 bg-gray-100 rounded text-sm">
{{ levelName($idp->current_level) }}
</span>

<span class="text-gray-400">→</span>

<span class="px-2 py-1 bg-blue-100 text-blue-700 rounded text-sm">
{{ levelName($idp->target_level) }}
</span>

</div>


<div>
<p class="text-sm text-gray-500">Target IDP</p>
<p class="text-gray-800">
{{ $idp->target_idp }}
</p>
</div>


<div class="grid grid-cols-2 gap-6">

<div>
<p class="text-sm text-gray-500">Mentor</p>
<p class="font-semibold">
{{ $idp->mentor_name ?? '-' }}
</p>
</div>

<div>
<p class="text-sm text-gray-500">First Meeting</p>
<p class="font-semibold">
{{ $idp->first_meeting_date ? \Carbon\Carbon::parse($idp->first_meeting_date)->translatedFormat('d F Y') : '-' }}
</p>
</div>

</div>

</div>


@php
    $total = $idp->tasks->count();
    $completed = $idp->tasks->where('status','completed')->count();
    $percent = $total ? round(($completed / $total) * 100) : 0;
@endphp

<div class="bg-white shadow rounded-xl p-4 mt-6 mb-6">

    <p class="text-sm text-gray-600 mb-1">
        Progress: {{ $completed }} / {{ $total }} tasks
    </p>

    <div class="w-full bg-gray-200 rounded-full h-3">
        <div class="bg-green-500 h-3 rounded-full" style="width: {{ $percent }}%"></div>
    </div>

</div>

{{-- ================= TASK SECTION ================= --}}
<div class="bg-white shadow rounded-xl p-6 mt-6">

<h3 class="font-semibold text-lg mb-4">
Development Tasks
</h3>


@if($idp->tasks->count())

<div class="space-y-4">

@foreach($idp->tasks as $task)

<div class="border rounded-lg p-4">

<form method="POST" action="{{ route('sales.idp.task.update',$task->id) }}">
@csrf
@method('PUT')

<div class="flex justify-between items-start gap-6">


<div class="flex-1 space-y-2">

@php
$categoryColor = match($task->category){
    'knowledge' => 'bg-blue-100 text-blue-700',
    'experiential_learning' => 'bg-purple-100 text-purple-700',
    'mentoring' => 'bg-green-100 text-green-700',
    default => 'bg-gray-100 text-gray-600'
};
@endphp

<span class="text-xs px-2 py-1 rounded {{ $categoryColor }}">
    {{ ucfirst(str_replace('_',' ',$task->category)) }}
</span>

<p class="font-semibold text-gray-800">
{{ $task->task }}
</p>

@if($task->notes_ss)
<div class="text-sm text-gray-600 bg-gray-50 border rounded p-2">
<span class="text-xs text-gray-500">Notes (Sales Superintendent)</span><br>
{{ $task->notes_ss }}
</div>
@endif
{{-- FEEDBACK STORE MANAGER --}}
@if($task->feedback_sm)
<div class="text-sm bg-yellow-50 border border-yellow-200 rounded p-2">
    <span class="text-xs text-yellow-700 block mb-1">
        Feedback Store Manager
    </span>
    {{ $task->feedback_sm }}
</div>
@endif

{{-- FEEDBACK HR --}}
@if($task->feedback_hr)
<div class="text-sm bg-blue-50 border border-blue-200 rounded p-2">
    <span class="text-xs text-blue-700 block mb-1">
        Feedback HR
    </span>
    {{ $task->feedback_hr }}
</div>
@endif

@php
$isOverdue = $task->target_date && \Carbon\Carbon::parse($task->target_date)->isPast() && $task->status !== 'completed';
@endphp

@if($task->target_date)
<span class="text-xs px-2 py-1 rounded
{{ $isOverdue ? 'bg-red-100 text-red-700' : 'bg-indigo-100 text-indigo-700' }}">
{{ \Carbon\Carbon::parse($task->target_date)->format('d M Y') }}
</span>
@endif


<div>

<label class="text-xs text-gray-400 block mb-1">
Evidence Link
</label>

@if($task->status === 'completed')

<input
type="text"
value="{{ $task->evidence_link }}"
class="border rounded p-1 text-sm w-72 bg-gray-100 cursor-not-allowed"
disabled
>

@if($task->evidence_link)
<a
href="{{ $task->evidence_link }}"
target="_blank"
class="text-blue-600 text-xs underline block mt-1"
>
Open Evidence
</a>
@endif

@else

<input
type="text"
name="evidence_link"
value="{{ $task->evidence_link }}"
placeholder="Paste evidence link"
class="border rounded p-1 text-sm w-72"
>

@endif

</div>

</div>


<div class="flex items-center">

@if($task->status === 'completed')

<span class="text-xs px-3 py-1 rounded bg-green-100 text-green-700">
Completed
</span>

@else

<select
name="status"
onchange="this.form.submit()"
class="text-xs border rounded px-3 py-1

@if($task->status=='pending') bg-gray-100 text-gray-600
@elseif($task->status=='ongoing') bg-yellow-100 text-yellow-700
@endif
">

<option value="pending" {{ $task->status=='pending'?'selected':'' }}>
Pending
</option>

<option value="ongoing" {{ $task->status=='ongoing'?'selected':'' }}>
Ongoing
</option>

<option value="completed">
Completed
</option>

</select>

@endif

</div>

</div>

</form>


@if($task->status !== 'completed')

<form
method="POST"
action="{{ route('sales.idp.task.delete',$task->id) }}"
onsubmit="return confirm('Delete this task?')"
>

@csrf
@method('DELETE')

<button class="text-red-500 text-xs ml-2">
Delete
</button>

</form>

@endif

</div>

@endforeach

</div>

@else

<p class="text-gray-400 text-sm">
No tasks added yet.
</p>

@endif



<hr class="my-6">


<h4 class="font-semibold mb-3">
Add New Task
</h4>


<form method="POST" action="{{ route('sales.idp.task.store',$idp->id) }}">
@csrf

<div class="grid grid-cols-5 gap-3">

<input
type="text"
name="task"
placeholder="Task description"
required
class="border rounded p-2"
>

<select name="category" class="border rounded p-2 w-full" required>
    <option value="">Category</option>
    <option value="knowledge">Knowledge</option>
    <option value="experiential_learning">Experiential Learning</option>
    <option value="mentoring">Mentoring</option>
</select>

<input
type="text"
name="notes_ss"
placeholder="Notes (Sales Superintendent)"
class="border rounded p-2"
>

<input
type="date"
name="target_date"
class="border rounded p-2"
required
>

<input
type="text"
name="evidence_link"
placeholder="Evidence link"
class="border rounded p-2"
>

</div>

<button class="mt-4 bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
Add Task
</button>

</form>

</div>

</div>

</x-app-layout>