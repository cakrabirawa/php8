
@if ($errors->any())
    <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
        <ul class="list-disc ml-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="text-black">
<div>
    <label class="block">Employee ID</label>
    <input type="text" name="employee_id" value="{{ old('employee_id', $employee->employee_id ?? '') }}" class="border px-3 py-2 rounded w-full">
</div>

<div>
    <label class="block">Name</label>
    <input type="text" name="name" value="{{ old('name', $employee->name ?? '') }}" class="border px-3 py-2 rounded w-full">
</div>

<div>
    <label class="block">Contract Type</label>
    <select name="contract_type" class="border w-full px-3 py-2 rounded">
        <option value="Permanent" {{ old('contract_type', $employee->contract_type ?? '') === 'Permanent' ? 'selected' : '' }}>Permanent</option>
        <option value="Contract" {{ old('contract_type', $employee->contract_type ?? '') === 'Contract' ? 'selected' : '' }}>Contract</option>
    </select>
</div>

<div class="grid grid-cols-1 gap-4">

    <div>
        <label>Store</label>
        <select name="store_id" class="border w-full px-3 py-2 rounded">
            @foreach($stores as $store)
                <option value="{{ $store->id }}"
                    {{ old('store_id', $employee->store_id ?? '') == $store->id ? 'selected' : '' }}>
                    {{ $store->name }}
                </option>
            @endforeach
        </select>
    </div>
</div>

<div class="grid grid-cols-2 gap-4">
    <div>
        <label>Section</label>
        <select name="section_id" class="border w-full px-3 py-2 rounded">
            @foreach($sections as $section)
                <option value="{{ $section->id }}"
                    {{ old('section_id', $employee->section_id ?? '') == $section->id ? 'selected' : '' }}>
                    {{ $section->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label>Job</label>
        <select name="job_id" class="border w-full px-3 py-2 rounded">
            @foreach($jobs as $job)
                <option value="{{ $job->id }}"
                    {{ old('job_id', $employee->job_id ?? '') == $job->id ? 'selected' : '' }}>
                    {{ $job->name }}
                </option>
            @endforeach
        </select>
    </div>
</div>

<div class="grid grid-cols-2 gap-4">
    <div>
        <label>Birthday</label>
        <input type="date" name="birthday" value="{{ old('birthday', $employee->birthday ?? '') }}" class="border px-3 py-2 rounded w-full">
    </div>

    <div>
        <label>Joining Date</label>
        <input type="date" name="joining_date" value="{{ old('joining_date', $employee->joining_date ?? '') }}" class="border px-3 py-2 rounded w-full" required>
    </div>
</div>

<div class="grid grid-cols-2 gap-4">
    <div>
        <label>Initial Employment Date</label>
        <input type="date" name="initial_employment_date" value="{{ old('initial_employment_date', $employee->initial_employment_date ?? '') }}" class="border px-3 py-2 rounded w-full">
    </div>

    <div>
        <label>Permanent Date</label>
        <input type="date" name="permanent_date" value="{{ old('permanent_date', $employee->permanent_date ?? '') }}" class="border px-3 py-2 rounded w-full">
    </div>
</div>

</div>
