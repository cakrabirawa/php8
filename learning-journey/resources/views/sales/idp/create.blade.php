<x-app-layout>

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

@if(session('error'))
<div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
{{ session('error') }}
</div>
@endif


<form method="POST" action="{{ route('sales.idp.store') }}">
@csrf


<div class="bg-white shadow rounded-xl p-6 space-y-6">

{{-- COMPETENCY --}}
<div>

<label class="font-semibold">
Competency
</label>

<select name="competency_id" class="w-full border rounded p-2 mt-1" required>

<option value="">Select Competency</option>

@foreach($competencies as $competency)

<option value="{{ $competency->id }}">
{{ $competency->name }}
</option>

@endforeach

</select>

</div>



{{-- LEVEL --}}
<div class="grid grid-cols-2 gap-4">

<div>

<label class="font-semibold">
Current Level
</label>

<select name="current_level" class="w-full border rounded p-2 mt-1" required>

<option value="1">Lone Ranger</option>
<option value="2">Team Player</option>
<option value="3">Team Leader</option>
<option value="4">Synergy Maker</option>
<option value="5">Collaborator</option>
<option value="6">Ecosystem Builder</option>

</select>

</div>


<div>

<label class="font-semibold">
Target Level
</label>

<select name="target_level" class="w-full border rounded p-2 mt-1" required>

<option value="1">Lone Ranger</option>
<option value="2">Team Player</option>
<option value="3">Team Leader</option>
<option value="4">Synergy Maker</option>
<option value="5">Collaborator</option>
<option value="6">Ecosystem Builder</option>

</select>

</div>

</div>



{{-- TARGET IDP --}}
<div>

<label class="font-semibold">
Target IDP
</label>

<textarea
name="target_idp"
rows="3"
class="w-full border rounded p-2 mt-1"
required
></textarea>

</div>



{{-- MENTOR --}}
<div class="grid grid-cols-2 gap-4">

<div>

<label class="font-semibold">
Mentor
</label>

<input
type="text"
name="mentor_name"
class="w-full border rounded p-2 mt-1 "
required
>

</div>


<div>

<label class="font-semibold">
First Meeting
</label>

<input
type="date"
name="first_meeting_date"
class="w-full border rounded p-2 mt-1"
required
>

</div>

</div>

</div>



{{-- TASK SECTION --}}
<div class="bg-white shadow rounded-xl p-6 mt-6">

<div class="flex justify-between mb-4">

<h3 class="font-semibold text-lg">
Development Tasks
</h3>

<button
type="button"
onclick="addTask()"
class="bg-blue-600 text-white px-3 py-1 rounded"
>
+ Add Task
</button>

</div>


<div id="tasks">

<div class="grid grid-cols-5 gap-3 mb-3">

<input
type="text"
name="tasks[]"  
placeholder="Task"
class="border rounded p-2 w-full"
>

<select name="categories[]" class="border rounded p-2 w-full" required>
    <option value="">Category</option>
    <option value="knowledge">Knowledge</option>
    <option value="experiential_learning">Experiential Learning</option>
    <option value="mentoring">Mentoring</option>
</select>

<input
type="text"
name="task_notes[]"
placeholder="Notes (Sales Superintendent)"
class="border rounded p-2 w-full"
>

<input
type="date"
name="target_dates[]"
class="border rounded p-2 w-full"
required
>

<input
type="text"
name="evidence_links[]"
placeholder="Evidence Link"
class="border rounded p-2 w-full"
>

</div>

</div>

</div>



<button
class="mt-6 bg-green-600 text-white px-6 py-2 rounded"
>
Save IDP
</button>

</form>

</div>



<script>
function addTask() {
    let html = `
    <div class="grid grid-cols-5 gap-3 mb-3">

        <input type="text" name="tasks[]" placeholder="Task" class="border rounded p-2 w-full" required>

        <select name="categories[]" required class="border rounded p-2 w-full">
            <option value="">Category</option>
            <option value="knowledge">Knowledge</option>
            <option value="experiential_learning">Experiential Learning</option>
            <option value="mentoring">Mentoring</option>
        </select>

        <input type="text" name="task_notes[]" placeholder="Notes" class="border rounded p-2 w-full">

        <input type="date" name="target_dates[]" class="border rounded p-2 w-full " required>

        <input type="text" name="evidence_links[]" placeholder="Evidence Link" class="border rounded p-2 w-full">

    </div>
    `;

    document.getElementById('tasks').insertAdjacentHTML('beforeend', html);
}
</script>

</x-app-layout>