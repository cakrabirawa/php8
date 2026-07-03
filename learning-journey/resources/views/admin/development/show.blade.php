<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Training Score Details</h2>
    </x-slot>

    <div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">

        <h3 class="text-lg font-semibold mb-4">
            {{ $score->employee->name }} — {{ $score->employee->store->name }}
        </h3>

        <table class="table-auto w-full text-sm">
            <tr><th class="p-2 border">Gramedia Daily Store</th><td class="p-2 border">{{ $score->gramedia_daily_store }}</td></tr>
            <tr><th class="p-2 border">Supervisory Skill</th><td class="p-2 border">{{ $score->rso_supervisory_skill }}</td></tr>
            <tr><th class="p-2 border">Retail Salesmanship</th><td class="p-2 border">{{ $score->rso_retail_salesmanship }}</td></tr>
            <tr><th class="p-2 border">Customer Service Loyalty</th><td class="p-2 border">{{ $score->rso_customer_service_loyalty }}</td></tr>
            <tr><th class="p-2 border">Product Merchandising</th><td class="p-2 border">{{ $score->rso_product_merchandising }}</td></tr>
            <tr><th class="p-2 border">Visual Merchandising</th><td class="p-2 border">{{ $score->rso_visual_merchandising }}</td></tr>
            <tr><th class="p-2 border">Retail Store Promotion</th><td class="p-2 border">{{ $score->rso_retail_store_promotion }}</td></tr>
            <tr><th class="p-2 border">Financial Perspective</th><td class="p-2 border">{{ $score->rso_store_financial_perspective }}</td></tr>
            <tr><th class="p-2 border">General Checkup Strategy</th><td class="p-2 border">{{ $score->rso_store_general_checkup_strategy }}</td></tr>

            <tr><th class="p-2 border">Learning Hours</th><td class="p-2 border">{{ $score->learning_hours }}</td></tr>
            <tr><th class="p-2 border">Nilai NGECAS</th><td class="p-2 border">{{ $score->nilai_ngecas }}</td></tr>

            <tr><th class="p-2 border">In-House Training</th><td class="p-2 border">{{ $score->inhouse_training }}</td></tr>
            <tr><th class="p-2 border">Public Training</th><td class="p-2 border">{{ $score->public_training }}</td></tr>
            <tr><th class="p-2 border">Intensive Training</th><td class="p-2 border">{{ $score->intensive_training }}</td></tr>
            <tr><th class="p-2 border">Development Program</th><td class="p-2 border">{{ $score->development_program }}</td></tr>
        </table>

        <a href="{{ route('admin.development.index') }}"
            class="mt-4 inline-block px-4 py-2 bg-gray-700 text-white rounded">← Back</a>

    </div>
</x-app-layout>
