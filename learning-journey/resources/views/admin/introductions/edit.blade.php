<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Edit Introduction</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-xl mx-auto bg-white p-6 shadow rounded-md">
            <form method="POST" action="{{ route('admin.introductions.update', $introduction->id) }}">
                @csrf
                @method('PUT')

                @include('admin.introductions.form', [
                    'introduction' => $introduction,
                    'mode' => 'edit'
                ])


                <button class="mt-4 px-5 py-2 bg-yellow-600 text-white rounded">
                    Update
                </button>
            </form>
        </div>
    </div>

    @push('scripts')
    <script>
    document.addEventListener('DOMContentLoaded', function () {

        /* ================= AUTO FILL EMPLOYEE ================= */
        const employee = @json(
            $employees->firstWhere('employee_id', $introduction->nik)
        );

        const searchInput = document.getElementById('employeeSearch');
        const nikHidden   = document.getElementById('nikInput');

        if (employee && searchInput && nikHidden) {
            searchInput.value = employee.employee_id + " - " + employee.name;
            nikHidden.value   = employee.employee_id;
            searchInput.readOnly = true;

            document.getElementById('searchResults')?.remove();
            document.getElementById('searchBtn')?.remove();
        }

        /* ================= SCORE → LEVEL ================= */
        const levelMap = {
            1: 'Lone Ranger',
            2: 'Team Player',
            3: 'Team Leader'
        };

        document.querySelectorAll('.score-input').forEach(input => {
            const target = document.getElementById(input.dataset.target);

            if (input.value && target) {
                target.value = levelMap[input.value] ?? '';
            }

            input.addEventListener('input', function () {
                if (target) target.value = levelMap[this.value] ?? '';
            });
        });
    });
    </script>
    @endpush
</x-app-layout>
