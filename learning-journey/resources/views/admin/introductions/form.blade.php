@php
    function levelText($score) {
        return match ((int) $score) {
            1 => 'Lone Ranger',
            2 => 'Team Player',
            3 => 'Team Leader',
            default => '-',
        };
    }

    $mode = $mode ?? 'create';
    $isCreate = $mode === 'create';
    $isEdit   = $mode === 'edit';
    $isShow   = $mode === 'show';
@endphp

<div class="grid grid-cols-2 gap-4">

    {{-- ================= EMPLOYEE ================= --}}
    <div class="col-span-2">
        <label class="font-semibold">Employee</label>

        {{-- CREATE --}}
        @if($isCreate)
        {{-- TAMBAHKAN CLASS RELATIVE DI SINI --}}
            <div class="relative mt-1"> 
                <input type="text"
                    id="employee_search"
                    class="w-full border rounded px-4 py-2 focus:ring-2 focus:ring-blue-500"
                    placeholder="Cari NIK / Nama"
                    autocomplete="off">

                <input type="hidden"
                    name="nik"
                    id="employee_nik"
                    value="{{ old('nik') }}">

                {{-- Hasil Search --}}
                <div id="employee_results"
                    class="absolute left-0 right-0 border bg-white rounded shadow-lg mt-1 hidden z-50 max-h-60 overflow-y-auto">
                    {{-- Data hasil search akan muncul di sini --}}
                </div>
            </div>
        {{-- EDIT & SHOW --}}
        @else
            <input type="text"
                   class="w-full border rounded px-4 py-2 bg-gray-100"
                   value="{{ $introduction->employee?->name ?? '-' }}"
                   readonly>

            <input type="hidden"
                   name="nik"
                   value="{{ $introduction->nik }}">
        @endif
    </div>

    {{-- ================= FGD ANALYTIC ================= --}}
    <div>
        <label>FGD Analytic Score</label>
        <input type="number" min="1" max="3"
               name="fgd_analytic_score"
               class="border p-2 rounded w-full"
               value="{{ old('fgd_analytic_score', $introduction->fgd_analytic_score) }}"
               {{ $isShow ? 'readonly' : '' }}>
    </div>

    <div>
        <label>FGD Analytic Level</label>
        <div id="fgd_analytic_level"
             class="border p-2 rounded w-full bg-gray-100 min-h-[42px] flex items-center">
            {{ $isShow ? levelText($introduction->fgd_analytic_score) : '' }}
        </div>
    </div>

    {{-- ================= FGD BUSINESS ================= --}}
    <div>
        <label>FGD Business Score</label>
        <input type="number" min="1" max="3"
               name="fgd_business_score"
               class="border p-2 rounded w-full"
               value="{{ old('fgd_business_score', $introduction->fgd_business_score) }}"
               {{ $isShow ? 'readonly' : '' }}>
    </div>

    <div>
        <label>FGD Business Level</label>
        <div id="fgd_business_level"
             class="border p-2 rounded w-full bg-gray-100 min-h-[42px] flex items-center">
            {{ $isShow ? levelText($introduction->fgd_business_score) : '' }}
        </div>
    </div>

    {{-- ================= FGD LEADERSHIP ================= --}}
    <div>
        <label>FGD Leadership Score</label>
        <input type="number" min="1" max="3"
               name="fgd_leadership_score"
               class="border p-2 rounded w-full"
               value="{{ old('fgd_leadership_score', $introduction->fgd_leadership_score) }}"
               {{ $isShow ? 'readonly' : '' }}>
    </div>

    <div>
        <label>FGD Leadership Level</label>
        <div id="fgd_leadership_level"
             class="border p-2 rounded w-full bg-gray-100 min-h-[42px] flex items-center">
            {{ $isShow ? levelText($introduction->fgd_leadership_score) : '' }}
        </div>
    </div>

    {{-- ================= INTERVIEW ANALYTIC ================= --}}
    <div>
        <label>Interview Analytic Score</label>
        <input type="number" min="1" max="3"
               name="interview_analytic_score"
               class="border p-2 rounded w-full"
               value="{{ old('interview_analytic_score', $introduction->interview_analytic_score) }}"
               {{ $isShow ? 'readonly' : '' }}>
    </div>

    <div>
        <label>Interview Analytic Level</label>
        <div id="interview_analytic_level"
             class="border p-2 rounded w-full bg-gray-100 min-h-[42px] flex items-center">
            {{ $isShow ? levelText($introduction->interview_analytic_score) : '' }}
        </div>
    </div>

    {{-- ================= INTERVIEW BUSINESS ================= --}}
    <div>
        <label>Interview Business Score</label>
        <input type="number" min="1" max="3"
               name="interview_business_score"
               class="border p-2 rounded w-full"
               value="{{ old('interview_business_score', $introduction->interview_business_score) }}"
               {{ $isShow ? 'readonly' : '' }}>
    </div>

    <div>
        <label>Interview Business Level</label>
        <div id="interview_business_level"
             class="border p-2 rounded w-full bg-gray-100 min-h-[42px] flex items-center">
            {{ $isShow ? levelText($introduction->interview_business_score) : '' }}
        </div>
    </div>

    {{-- ================= INTERVIEW LEADERSHIP ================= --}}
    <div>
        <label>Interview Leadership Score</label>
        <input type="number" min="1" max="3"
               name="interview_leadership_score"
               class="border p-2 rounded w-full"
               value="{{ old('interview_leadership_score', $introduction->interview_leadership_score) }}"
               {{ $isShow ? 'readonly' : '' }}>
    </div>

    <div>
        <label>Interview Leadership Level</label>
        <div id="interview_leadership_level"
             class="border p-2 rounded w-full bg-gray-100 min-h-[42px] flex items-center">
            {{ $isShow ? levelText($introduction->interview_leadership_score) : '' }}
        </div>
    </div>

    {{-- ================= NOTES ================= --}}
    <div class="col-span-2">
        <label>FGD Note</label>
        <textarea name="fgd_note" class="border p-2 rounded w-full" {{ $isShow ? 'readonly' : '' }}>{{ old('fgd_note', $introduction->fgd_note) }}</textarea>
    </div>

    <div class="col-span-2">
        <label>Interview Note</label>
        <textarea name="interview_note" class="border p-2 rounded w-full" {{ $isShow ? 'readonly' : '' }}>{{ old('interview_note', $introduction->interview_note) }}</textarea>
    </div>

    {{-- ================= FINAL ================= --}}
    <div class="col-span-2">
        <label>Rekomendasi</label>
        <textarea name="rekomendasi" class="border p-2 rounded w-full" {{ $isShow ? 'readonly' : '' }}>{{ old('rekomendasi', $introduction->rekomendasi) }}</textarea>
    </div>

    <div>
        <label>PIC</label>
        <input type="text" name="pic" class="border p-2 rounded w-full"
               value="{{ old('pic', $introduction->pic) }}"
               {{ $isShow ? 'readonly' : '' }}>
    </div>

</div>

@if (!$isShow)
<script>
const employeeInput = document.getElementById('employee_search');
const results = document.getElementById('employee_results');
const nikInput = document.getElementById('employee_nik');

if (employeeInput) {
    employeeInput.addEventListener('input', () => {
        const q = employeeInput.value;

        if (q.length < 2) {
            results.classList.add('hidden');
            return;
        }

        fetch(`{{ route('admin.search.employees') }}?q=${q}`)
            .then(res => res.json())
            .then(data => {
                results.innerHTML = '';
                data.forEach(emp => {
                    const item = document.createElement('div');
                    item.className = 'px-3 py-2 hover:bg-gray-100 cursor-pointer';
                    item.innerText = `${emp.employee_id} - ${emp.name}`;
                    item.onclick = () => {
                        employeeInput.value = emp.name;
                        nikInput.value = emp.employee_id;
                        results.classList.add('hidden');
                    };
                    results.appendChild(item);
                });
                results.classList.remove('hidden');
            });
    });
}
function levelText(score) {
    switch (parseInt(score)) {
        case 1: return 'Lone Ranger';
        case 2: return 'Team Player';
        case 3: return 'Team Leader';
        default: return '';
    }
}

function bindScore(inputName, levelId) {
    const input = document.querySelector(`[name="${inputName}"]`);
    const level = document.getElementById(levelId);

    if (!input || !level) return;

    const update = () => {
        level.textContent = levelText(input.value);
    };

    input.addEventListener('input', update);
    update(); // auto-fill saat edit
}

bindScore('fgd_analytic_score', 'fgd_analytic_level');
bindScore('fgd_business_score', 'fgd_business_level');
bindScore('fgd_leadership_score', 'fgd_leadership_level');
bindScore('interview_analytic_score', 'interview_analytic_level');
bindScore('interview_business_score', 'interview_business_level');
bindScore('interview_leadership_score', 'interview_leadership_level');
</script>
@endif