<x-app-layout>
         @php
        function scoreLevel($score) {
            if ($score === null) return '-';

            return match ((int)$score) {
                1 => 'Lone Ranger',
                2 => 'Team Player',
                3 => 'Team Leader',
                default => '-'
            };
        }

        function scoreBadgeClass($score) {
            return match ((int)$score) {
                1 => 'bg-red-100 text-red-700',
                2 => 'bg-yellow-100 text-yellow-700',
                3 => 'bg-green-100 text-green-700',
                default => 'bg-gray-100 text-gray-500'
            };
        }
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
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold">
                Learning Journey Report
            </h2>
            @if(auth()->user()->role === 'admin')
            <a href="{{ route('admin.employees.report.pdf', $employee) }}"
               class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                Download PDF
            </a>
            @endif
        </div>
    </x-slot>

<div class="py-6 max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-6">

    {{-- ================= LEFT COLUMN ================= --}}
    <div class="space-y-6">

    
        {{-- ================= USER ACCOUNT ================= --}}
        <div class="bg-white shadow rounded-xl p-6 border border-gray-100">
            <h3 class="text-lg font-semibold mb-4 text-center">User Account</h3>

            <div class="max-w-md mx-auto">
                <div class="grid grid-cols-2 gap-8 text-sm text-center">

                    {{-- NAME --}}
                    <div>
                        <p class="text-gray-500 text-xs uppercase tracking-wide">Name</p>
                        <p class="font-semibold text-gray-800 mt-1">
                            {{ $userAccount->name ?? '-' }}
                        </p>
                    </div>

                    {{-- LOGIN ID --}}
                    <div>
                        <p class="text-gray-500 text-xs uppercase tracking-wide">Login ID</p>
                        <p class="font-semibold text-gray-800 mt-1">
                            {{ $userAccount->email ?? '-' }}
                        </p>
                    </div>

                </div>
            </div>

            {{-- ACTION --}}
            @if(auth()->user()->role === 'admin')
            <div class="mt-6 flex flex-col items-center gap-3 border-t pt-4">

                <form method="POST" action="{{ route('admin.users.reset-password', $employee->employee_id) }}">
                    @csrf
                    @method('PUT')

                    <button type="submit"
                        onclick="return confirm('Reset password ke default (12345678)?')"
                        class="bg-yellow-500 text-white px-5 py-2 rounded-lg hover:bg-yellow-600 transition">
                        🔄 Reset Password
                    </button>
                </form>

            </div>
            @endif
        </div>


        {{-- ================= EMPLOYEE INFO ================= --}}
        <div class="bg-white shadow rounded p-6">
            <h3 class="text-lg font-semibold mb-4">Employee Information</h3>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
        <div>
            <p class="text-gray-500">Employee ID</p>
            <p class="font-semibold">{{ $employee->employee_id }}</p>
        </div>

        <div>
            <p class="text-gray-500">Name</p>
            <p class="font-semibold">{{ $employee->name }}</p>
        </div>

        <div>
            <p class="text-gray-500">Contract Type</p>
            <p class="font-semibold">{{ $employee->contract_type ?? '-' }}</p>
        </div>

        <div>
            <p class="text-gray-500">Division</p>
            <p class="font-semibold">{{ $employee->region->name ?? '-' }}</p>
        </div>

        <div>
            <p class="text-gray-500">Store</p>
            <p class="font-semibold">{{ $employee->store->name ?? '-' }}</p>
        </div>

        <div>
            <p class="text-gray-500">Section</p>
            <p class="font-semibold">{{ $employee->section->name ?? '-' }}</p>
        </div>

        <div>
            <p class="text-gray-500">Job</p>
            <p class="font-semibold">{{ $employee->job->name ?? '-' }}</p>
        </div>

        <div>
            <p class="text-gray-500">Birthday</p>
            <p class="font-semibold">
                {{ $employee->birthday ? \Carbon\Carbon::parse($employee->birthday)->format('d M Y') : '-' }}
            </p>
        </div>

        <div>
            <p class="text-gray-500">Joining Date</p>
            <p class="font-semibold">
                {{ $employee->joining_date ? \Carbon\Carbon::parse($employee->joining_date)->format('d M Y') : '-' }}
            </p>
        </div>

        <div>
            <p class="text-gray-500">Initial Employment</p>
            <p class="font-semibold">
                {{ $employee->initial_employment_date
                    ? \Carbon\Carbon::parse($employee->initial_employment_date)->format('d M Y')
                    : '-' }}
            </p>
        </div>

        <div>
            <p class="text-gray-500">Permanent Date</p>
            <p class="font-semibold">
                {{ $employee->permanent_date
                    ? \Carbon\Carbon::parse($employee->permanent_date)->format('d M Y')
                    : '-' }}
            </p>
        </div>
            </div>
        </div>


        {{-- ================= INTRODUCTION ================= --}}
    <div class="bg-white shadow rounded p-6 space-y-6">
        <h3 class="text-lg font-semibold">Introduction Assessment</h3>

        <div class="overflow-x-auto">
            <table class="w-full text-sm border">
                <thead class="bg-gray-100 text-center">
                    <tr>
                        <th class="p-2 border text-left"></th>
                        <th class="p-2 border">Analytic</th>
                        <th class="p-2 border">Business</th>
                        <th class="p-2 border">Leadership</th>
                    </tr>
                </thead>
                <tbody>
                    @if($introduction)
                        <tr>
                            <td class="p-2 border font-semibold">FGD</td>
                            <td class="p-2 border text-center">{{ $introduction->fgd_analytic_score ?? '-' }}</td>
                            <td class="p-2 border text-center">{{ $introduction->fgd_business_score ?? '-' }}</td>
                            <td class="p-2 border text-center">{{ $introduction->fgd_leadership_score ?? '-' }}</td>
                        </tr>

                        <tr>
                            <td class="p-2 border font-semibold">Interview</td>
                            <td class="p-2 border text-center">{{ $introduction->interview_analytic_score ?? '-' }}</td>
                            <td class="p-2 border text-center">{{ $introduction->interview_business_score ?? '-' }}</td>
                            <td class="p-2 border text-center">{{ $introduction->interview_leadership_score ?? '-' }}</td>
                        </tr>
                    @else
                        <tr>
                            <td colspan="4" class="p-4 text-center text-gray-400">
                                No Data Available
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        {{-- NOTES --}}
        @if($introduction)
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
            <div>
                <p class="text-gray-500 mb-1">Recommendation</p>
                <p class="font-medium">{{ $introduction->rekomendasi ?? '-' }}</p>
            </div>
            <div>
                <p class="text-gray-500 mb-1">FGD Note</p>
                <p>{{ $introduction->fgd_note ?? '-' }}</p>
            </div>
            <div>
                <p class="text-gray-500 mb-1">Interview Note</p>
                <p>{{ $introduction->interview_note ?? '-' }}</p>
            </div>
        </div>
        @endif
    </div>

        {{-- ================= ONBOARDING ================= --}}
        <div class="bg-white shadow rounded p-6">
            <h3 class="text-lg font-semibold mb-4">Onboarding Checklist (6 Months)</h3>
            @if($isAutoGenerated)
                <div class="mb-3 inline-flex items-center gap-2 px-3 py-1 rounded bg-blue-100 text-blue-800 text-sm">
                    Auto generated onboarding checklist
                </div>
            @endif
            <canvas id="onboardingChart" height="120"></canvas>
        </div>
                
        {{-- ================= IDP ================= --}}
        <div class="bg-white shadow rounded-xl p-6">
            <h3 class="text-lg font-semibold mb-5">Individual Development Plan</h3>

            @if($idps->count())

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

                    <div class="border border-gray-200 rounded-xl p-4 mb-4 hover:shadow-sm transition">

                        {{-- HEADER --}}
                        <div class="flex justify-between items-start mb-3">
                            
                            <div>
                                <p class="font-semibold text-gray-800">
                                    {{ $idp->competency?->name ?? '-' }}
                                </p>

                                {{-- LEVEL --}}
                                <div class="flex items-center gap-2 mt-1 text-xs">

                                    <span class="px-2 py-1 rounded bg-gray-10 text-gray-700">
                                        {{ levelName($idp->current_level) }}
                                    </span>

                                    <span class="text-gray-400">→</span>

                                    <span class="px-2 py-1 rounded bg-gray-100 text-gray-700">
                                        {{ levelName($idp->target_level) }}
                                    </span>

                                </div>

                                {{-- TARGET --}}
                                <p class="text-xs text-gray-500 mt-2">
                                    {{ $idp->target_idp }}
                                </p>
                            </div>

                            <span class="text-xs px-3 py-1 rounded-full {{ $statusColor }}">
                                {{ ucfirst(str_replace('_',' ',$idp->status)) }}
                            </span>

                        </div>

                        {{-- TASK LIST --}}
                        <div class="space-y-2">

                            @foreach($idp->tasks as $task)

                                @php
                                    $taskStatusColor = match($task->status){
                                        'pending' => 'bg-gray-100 text-gray-600',
                                        'ongoing' => 'bg-yellow-100 text-yellow-700',
                                        'completed' => 'bg-green-100 text-green-700',
                                        default => 'bg-gray-100 text-gray-600'
                                    };

                                    $categoryColor = match($task->category){
                                        'knowledge' => 'bg-blue-100 text-blue-700',
                                        'experiential_learning' => 'bg-purple-100 text-purple-700',
                                        'mentoring' => 'bg-green-100 text-green-700',
                                        default => 'bg-gray-100 text-gray-600'
                                    };
                                @endphp

                                <div class="flex justify-between items-center border rounded-lg px-3 py-2 bg-gray-50">

                                    <div class="flex-1">

                                        <div class="flex justify-between items-center mb-1">

                                            {{-- LEFT (CATEGORY) --}}
                                            <span class="text-[11px] px-2 py-1 rounded {{ $categoryColor }}">
                                                {{ ucfirst(str_replace('_',' ',$task->category)) }}
                                            </span>

                                            {{-- RIGHT (STATUS) --}}
                                            <span class="text-[11px] px-2 py-1 rounded {{ $taskStatusColor }}">
                                                {{ ucfirst($task->status) }}
                                            </span>

                                        </div>

                                        <p class="text-sm text-gray-800">
                                            {{ $task->task }}
                                        </p>

                                    </div>

                                </div>

                            @endforeach

                        </div>

                    </div>

                @endforeach

            @else
                <p class="text-gray-400 text-sm">No IDP data</p>
            @endif
        </div>
    </div>

    {{-- ================= RIGHT COLUMN ================= --}}
    <div class="space-y-6">

        {{-- ================= DEVELOPMENT ================= --}}
        <div class="grid grid-cols-1 gap-6 bg-white shadow rounded p-6">

            {{-- Chart Section --}}
            <div class="bg-gray-50 border rounded-lg p-4 flex justify-center">
                @if($development)
                    <canvas id="developmentChart" class="h-[300px]"></canvas>
                @else
                    <span class="text-gray-500 italic">No Chart Data</span>
                @endif
            </div>

            {{-- CONTENT --}}
            <div class="space-y-6">

                {{-- 📊 RSO ASSESSMENT --}}
                <div class="overflow-x-auto">
                    <h3 class="text-sm font-bold text-gray-700 mb-2 uppercase tracking-wider flex items-center">
                        <span class="w-2 h-4 bg-orange-500 mr-2 rounded-sm"></span>
                        RSO Assessment
                    </h3>

                    <table class="w-full text-sm border">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="p-2 border text-left">Competency</th>
                                <th class="p-2 border text-center w-24">Score</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($development)
                                <tr><td class="p-2 border italic text-gray-600">Supervisory Skill</td><td class="p-2 border text-center font-semibold">{{ $development->rso_supervisory_skill ?? '-' }}</td></tr>
                                <tr><td class="p-2 border italic text-gray-600">Retail Salesmanship</td><td class="p-2 border text-center font-semibold">{{ $development->rso_retail_salesmanship ?? '-' }}</td></tr>
                                <tr><td class="p-2 border italic text-gray-600">Customer Service Loyalty</td><td class="p-2 border text-center font-semibold">{{ $development->rso_customer_service_loyalty ?? '-' }}</td></tr>
                                <tr><td class="p-2 border italic text-gray-600">Product Merchandising</td><td class="p-2 border text-center font-semibold">{{ $development->rso_product_merchandising ?? '-' }}</td></tr>
                                <tr><td class="p-2 border italic text-gray-600">Visual Merchandising</td><td class="p-2 border text-center font-semibold">{{ $development->rso_visual_merchandising ?? '-' }}</td></tr>
                                <tr><td class="p-2 border italic text-gray-600">Retail Store Promotion</td><td class="p-2 border text-center font-semibold">{{ $development->rso_retail_store_promotion ?? '-' }}</td></tr>
                                <tr><td class="p-2 border italic text-gray-600">Financial Perspective</td><td class="p-2 border text-center font-semibold">{{ $development->rso_store_financial_perspective ?? '-' }}</td></tr>
                                <tr><td class="p-2 border italic text-gray-600">General Strategy</td><td class="p-2 border text-center font-semibold">{{ $development->rso_store_general_checkup_strategy ?? '-' }}</td></tr>
                            @else
                                <tr>
                                    <td colspan="2" class="p-4 text-center text-gray-400">
                                        No Data Available
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                {{-- 📋 GENERAL --}}
                <div class="overflow-x-auto">
                    <h3 class="text-sm font-bold text-gray-700 mb-2 uppercase tracking-wider flex items-center">
                        <span class="w-2 h-4 bg-blue-600 mr-2 rounded-sm"></span>
                        General Metrics & Training
                    </h3>

                    <table class="w-full text-sm border">
                        <tbody>
                            @if($development)
                                <tr class="bg-blue-50/30">
                                    <td class="p-2 border font-semibold w-1/3">Gramedia Daily's Store</td>
                                    <td class="p-2 border font-bold text-blue-700">{{ $development->gramedia_daily_store ?? '0' }}</td>
                                </tr>
                                <tr>
                                    <td class="p-2 border font-semibold">Learning Hours</td>
                                    <td class="p-2 border">{{ $development->learning_hours ?? '-' }}</td>
                                </tr>
                                <tr class="bg-gray-50">
                                    <td class="p-2 border font-semibold">Nilai NGECAS</td>
                                    <td class="p-2 border">{{ $development->nilai_ngecas ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="p-2 border font-semibold">In-house Training</td>
                                    <td class="p-2 border text-gray-600">{{ $development->inhouse_training ?? '-' }}</td>
                                </tr>
                                <tr class="bg-gray-50">
                                    <td class="p-2 border font-semibold">Public Training</td>
                                    <td class="p-2 border text-gray-600">{{ $development->public_training ?? '-' }}</td>
                                </tr>
                                <tr class="bg-gray-50">
                                    <td class="p-2 border font-semibold">Intensive Training</td>
                                    <td class="p-2 border text-gray-600">{{ $development->intensive_training ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="p-2 border font-semibold text-blue-600">Development Program</td>
                                    <td class="p-2 border font-medium">
                                        {{ $development->development_program ?? '-' }}
                                    </td>
                                </tr>
                            @else
                                <tr>
                                    <td colspan="2" class="p-4 text-center text-gray-400">
                                        No Data Available
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

            </div> {{-- END CONTENT --}}
        </div> {{-- END DEVELOPMENT --}}
               {{-- ================= MENTORING ================= --}}
    <div class="bg-white shadow rounded p-6">
        <h3 class="text-lg font-semibold mb-4">Mentoring Records</h3>

        @if($mentoring->count())
            <div class="overflow-x-auto">
                <table class="w-full text-sm border">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-2 border">Date</th>
                            <th class="p-2 border">Mentor</th>
                            <th class="p-2 border">Store</th>
                            <th class="p-2 border">Notes</th>
                            <th class="p-2 border">HR Notes</th>
                            <th class="p-2 border text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($mentoring as $m)
                            <tr>
                                <td class="p-2 border">
                                    {{ $m->created_at?->format('d M Y') ?? '-' }}
                                </td>
                                <td class="p-2 border">
                                    {{ $m->mentor_name ?? '-' }}
                                </td>
                                <td class="p-2 border">
                                    {{ $m->store->name ?? '-' }}
                                </td>
                                <td class="p-2 border">
                                    {{ $m->notes ?? '-' }}
                                </td>
                                <td class="p-2 border">
                                    {{ $m->notes_hr ?? '-' }}
                                </td>
                                <td class="p-2 border text-center">
                                    {{ ucfirst($m->status) }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="p-4 text-center text-gray-400">
                                    No Data Available
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

                <div class="mt-4 text-sm text-gray-700">
                    <strong>Total Mentoring:</strong>
                    {{ $mentoring->count() }} |
                    <strong>Verified:</strong>
                    {{ $mentoring->where('status','verified')->count() }}
                </div>
            @else
                <p class="text-gray-400">No mentoring records available</p>
            @endif
        </div>

        @php
            $latestPeriod = $evaluation?->kpi_december !== null ? 'December' : 'June';
        @endphp

        {{-- ================= KPI ================= --}}
        <div class="bg-white shadow rounded p-6 space-y-4">
            <h3 class="text-lg font-semibold">Performance (KPI)</h3>

            {{-- KPI CHART --}}
            <canvas id="kpiChart" height="120"></canvas>

            {{-- ================= KPI DATA ================= --}}
            @if($evaluation)

                <div class="overflow-x-auto mt-4">
                    <table class="w-full text-sm border">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="p-2 border">Aspect</th>
                                <th class="p-2 border text-center">Latest</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="p-2 border">Business</td>
                                <td class="p-2 border text-center">{{ $evaluation->business_score ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="p-2 border">Behavior</td>
                                <td class="p-2 border text-center">{{ $evaluation->behavior_score ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="p-2 border">PA</td>
                                <td class="p-2 border text-center">{{ $evaluation->pa_score ?? '-' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                {{-- TOTAL KPI --}}
                <div class="overflow-x-auto mt-4">
                    <table class="w-full text-sm border">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="p-2 border">Period</th>
                                <th class="p-2 border text-center">Total KPI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="p-2 border">June</td>
                                <td class="p-2 border text-center">{{ $evaluation->kpi_june ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="p-2 border">December</td>
                                <td class="p-2 border text-center">{{ $evaluation->kpi_december ?? '-' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            @else
                <p class="text-gray-400 text-sm">No KPI data available</p>
            @endif


            {{-- ================= ASSESSMENT (DIPISAH TOTAL) ================= --}}
            @if(optional($evaluation)->assessment_link)
                <div class="mt-3">
                    <p class="text-sm">
                        <strong>Assessment Link:</strong>
                        <a href="{{ $evaluation->assessment_link }}"
                        target="_blank"
                        class="text-blue-600 underline">
                            View Assessment
                        </a>
                    </p>
                </div>
            @endif

            </div>
        </div>

        </div>
        </div>
    </div>

</div>
</div> {{-- END RIGHT COLUMN --}}

    {{-- ================= CHART JS ================= --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

      <script>
        // ================= ONBOARDING =================
        const onboardingData = @json($onboardingData);


        new Chart(document.getElementById('onboardingChart'), {
            type: 'bar',
            data: {
                labels: ['Month 1','Month 2','Month 3','Month 4','Month 5','Month 6'],
                datasets: [{
                    label: 'Completion (%)',
                    data: onboardingData,
                    backgroundColor: '#4f46e5'
                }]
            },
            options: {
                scales: {
                    y: { beginAtZero: true, max: 100 }
                }
            }
        });

        // ================= KPI =================
        new Chart(document.getElementById('kpiChart'), {
            type: 'line',
            data: {
                labels: ['June', 'December'],
                datasets: [{
                    label: 'KPI Score',
                    data: [
                        {{ $evaluation->kpi_june ?? 0 }},
                        {{ $evaluation->kpi_december ?? 0 }}
                    ],
                    borderColor: '#16a34a',
                    backgroundColor: 'rgba(22,163,74,0.2)',
                    tension: 0.3,
                    fill: true
                }]
            },
            options: {
                scales: {
                    y: { beginAtZero: true, max: 500 }
                }
            }
        });

      
  @if($development)
    new Chart(document.getElementById('developmentChart'), {
        type: 'bar',
        data: {
            labels: [
                'Supervisory Skill',
                'Retail Salesmanship',
                'Customer Service Loyalty',
                'Product Merchandising',
                'Visual Merchandising',
                'Retail Store Promotion',
                'Financial Perspective',
                'General Strategy'
            ],
            datasets: [{
                label: 'Score',
                data: [
                    {{ $development->rso_supervisory_skill ?? 0 }},
                    {{ $development->rso_retail_salesmanship ?? 0 }},
                    {{ $development->rso_customer_service_loyalty ?? 0 }},
                    {{ $development->rso_product_merchandising ?? 0 }},
                    {{ $development->rso_visual_merchandising ?? 0 }},
                    {{ $development->rso_retail_store_promotion ?? 0 }},
                    {{ $development->rso_store_financial_perspective ?? 0 }},
                    {{ $development->rso_store_general_checkup_strategy ?? 0 }},
                ],
                backgroundColor: '#f97316', // Orange khas RSO
                borderRadius: 4,
                barThickness: 12
            }]
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            maintainAspectRatio: false,
            
            // Tambahkan bagian ini untuk memunculkan tulisan di atas grafik
            plugins: {
                title: {
                    display: true,
                    text: 'RSO ASSESSMENT',
                    align: 'start', // Tulisan rata kiri (sejajar dengan label)
                    color: '#9a3412', // Warna orange gelap agar kontras
                    font: {
                        size: 13,
                        weight: 'bold',
                        family: 'sans-serif'
                    },
                    padding: {
                        top: 0,
                        bottom: 15 // Jarak tulisan ke grafik
                    }
                },
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: '#1f2937'
                }
            },

            scales: {
                x: {
                    beginAtZero: true,
                    max: 100,
                    grid: { color: '#f3f4f6' },
                    ticks: { font: { size: 10 } }
                },
                y: {
                    grid: { display: false },
                    ticks: {
                        autoSkip: false,
                        color: '#374151',
                        font: {
                            size: 11,
                            weight: '600'
                        }
                    }
                }
            }
        }
    });
    @endif
    </script>

</x-app-layout>
