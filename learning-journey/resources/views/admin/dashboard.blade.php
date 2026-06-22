<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl md:text-2xl font-semibold">
            Learning Journey — Dashboard
        </h2>
    </x-slot>

    <div class="py-4 md:py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">

            {{-- SUMMARY CARDS --}}
            <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                <div class="p-4 bg-white rounded-xl shadow-sm">
                    <div class="text-xs md:text-sm text-gray-500">Total Employees</div>
                    <div class="text-xl md:text-2xl font-bold">
                        {{ $totalEmployees }}
                    </div>
                </div>

                <div class="p-4 bg-white rounded-xl shadow-sm">
                    <div class="text-xs md:text-sm text-gray-500">
                        Avg Completed Months
                    </div>
                    <div class="text-xl md:text-2xl font-bold">
                        {{ $avgCompletedMonths }} / 6
                    </div>
                    <div class="text-xs text-gray-400">
                        {{ $overallCompletionPercent }}% complete
                    </div>
                </div>

                <div class="p-4 bg-white rounded-xl shadow-sm">
                    <div class="text-xs md:text-sm text-gray-500">
                        Avg KPI (June)
                    </div>
                    <div class="text-xl md:text-2xl font-bold">
                        {{ round($kpiJuneAvg, 1) }}
                    </div>
                </div>

                <div class="p-4 bg-white rounded-xl shadow-sm">
                    <div class="text-xs md: text-sm text-gray-500">
                        Avg KPI (December)
                    </div>
                    <div class="text-xl md:text-2xl font-bold">
                        {{ round($kpiDecAvg, 1) }}
                    </div>
                </div>
            </div>

            {{-- CHARTS --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">

                {{-- BAR CHART --}}
                <div class="lg:col-span-2 bg-white rounded-xl shadow-sm p-4">
                    <h3 class="font-semibold mb-3 text-sm md:text-base">
                        Employee Onboarding Progress (6 Months)
                    </h3>

                    <div class="relative h-[260px] md:h-[220px]">
                        <canvas id="monthProgressChart"></canvas>
                    </div>
                </div>

            {{-- LEARNING & DEVELOPMENT SUMMARY --}}
            <div class="bg-white rounded-xl shadow-sm p-4">
                <h3 class="font-semibold mb-3 text-sm md:text-base">
                    Learning & Development Summary
                </h3>

                <div class="text-sm text-gray-600">
                    Employees with Development Program
                </div>
                <div class="text-xl font-bold mb-4 flex items-center gap-2">
                    {{ $employeesWithDevelopmentProgram }}
                    <div class="w-full bg-gray-200 rounded-full h-2 mt-1">
                        <div class="bg-blue-600 h-1 rounded-full"
                            style="width: {{ $developmentProgramPercent }}%">
                        </div>
                    </div>
                </div>

                <div class="text-sm text-gray-600">
                    Avg Learning Hours 
                </div>
                <div class="text-xl font-bold">
                    {{ $avgLearningHours }}
                </div>
            </div>


            </div>

            {{-- QUICK METRICS --}}
            <div class="bg-white rounded-xl shadow-sm p-4 mb-6">
                <h3 class="font-semibold mb-4 text-sm md:text-base">
                    Quick Metrics (Monthly Completion)
                </h3>

                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-6 gap-4">
                    @for ($m = 1; $m <= 6; $m++)
                        <div class="p-3 border rounded-lg text-center">
                            <div class="text-xs text-gray-500">
                                Month {{ $m }}
                            </div>
                            <div class="text-lg font-bold">
                                {{ $monthProgressPercent[$m] }}%
                            </div>
                        </div>
                    @endfor
                </div>
            </div>

        </div>
    </div>

    {{-- CHART SCRIPT --}}
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            const ctx = document.getElementById('monthProgressChart').getContext('2d');

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Month 1', 'Month 2', 'Month 3', 'Month 4', 'Month 5', 'Month 6'],
                    datasets: [{
                        label: 'Completion (%)',
                        data: [
                            @for ($m = 1; $m <= 6; $m++)
                                {{ $monthProgressPercent[$m] }}@if ($m < 6), @endif
                            @endfor
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 100
                        }
                    }
                }
            });
        </script>
    @endpush
</x-app-layout>
