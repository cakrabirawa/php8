<x-app-layout>

    <x-slot name="header">
        <h2 class="text-xl font-semibold">
            Developer Mode
        </h2>
    </x-slot>

    <div class="max-w-6xl mx-auto py-6 px-6 space-y-6">

        {{-- NOTIFICATIONS --}}
        @if(session('success'))
            <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-300 text-red-800 px-4 py-3 rounded">
                {{ session('error') }}
            </div>
        @endif


        {{-- IMPORT SQL --}}
        <div class="bg-white shadow rounded-xl p-6">

            <h3 class="font-semibold mb-4">
                Import SQL
            </h3>

            <p class="text-sm text-gray-500 mb-3">
                Upload .sql file to import data (Employees, Stores, Introductions, Evaluations, Training Scores, etc.)
            </p>

            <form
                method="POST"
                action="{{ route('admin.dev.import') }}"
                enctype="multipart/form-data"
                class="flex items-center gap-3"
            >
                @csrf

                <input
                    type="file"
                    name="sql_file"
                    accept=".sql"
                    class="border rounded p-2"
                >

                <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Import SQL
                </button>

            </form>

        </div>


        {{-- EXPORT SQL --}}
        <div class="bg-white shadow rounded-xl p-6">

            <h3 class="font-semibold mb-4">
                Export SQL
            </h3>

            <div class="flex flex-wrap gap-2">

                <a
                    href="{{ route('admin.dev.export','employees') }}"
                    class="bg-green-600 text-white px-3 py-2 rounded"
                >
                    Employees
                </a>

                <a
                    href="{{ route('admin.dev.export','stores') }}"
                    class="bg-green-600 text-white px-3 py-2 rounded"
                >
                    Stores
                </a>

                <a
                    href="{{ route('admin.dev.export','introductions') }}"
                    class="bg-green-600 text-white px-3 py-2 rounded"
                >
                    Introductions
                </a>

                <a
                    href="{{ route('admin.dev.export','employee_evaluations') }}"
                    class="bg-green-600 text-white px-3 py-2 rounded"
                >
                    Employee Evaluations
                </a>

                <a
                    href="{{ route('admin.dev.export','employee_training_scores') }}"
                    class="bg-green-600 text-white px-3 py-2 rounded"
                >
                    Training Scores
                </a>

                <a
                    href="{{ route('admin.dev.export','mentorings') }}"
                    class="bg-green-600 text-white px-3 py-2 rounded"
                >
                    Mentorings
                </a>

                <a
                    href="{{ route('admin.dev.export','onboarding_checklists') }}"
                    class="bg-green-600 text-white px-3 py-2 rounded"
                >
                    Checklist
                </a>

                <a
                    href="{{ route('admin.dev.export','individual_development_plans') }}"
                    class="bg-green-600 text-white px-3 py-2 rounded"
                >
                    IDP
                </a>

                <a
                    href="{{ route('admin.dev.export','idp_tasks') }}"
                    class="bg-green-600 text-white px-3 py-2 rounded"
                >
                    IDP Tasks
                </a>

            </div>

        </div>

{{-- ================= USERS MANAGEMENT ================= --}}
<div class="bg-white shadow rounded-xl p-6">

    <h3 class="font-semibold mb-4">
        Editor & Viewer Accounts
    </h3>

    {{-- CREATE USER --}}
    <form method="POST" action="{{ route('admin.dev.user.store') }}" class="grid grid-cols-1 md:grid-cols-4 gap-3 mb-6">
        @csrf

        <input type="text" name="name" placeholder="Name" class="border rounded p-2" required>
        <input type="email" name="email" placeholder="Email" class="border rounded p-2" required>

        <select name="role" class="border rounded p-2" required>
            <option value="admin">Admin</option>
            <option value="editor">Editor</option>
            <option value="viewer">Viewer</option>
        </select>

        <button class="bg-blue-600 text-white rounded px-4 py-2">
            Add User
        </button>
    </form>

    {{-- LIST USERS --}}
    <div class="overflow-x-auto">
        <table class="w-full text-sm border">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-2 border">Name</th>
                    <th class="p-2 border">Email</th>
                    <th class="p-2 border">Role</th>
                    <th class="p-2 border">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    @if(in_array($user->role, ['admin','editor','viewer']))
                    <tr>
                        <td class="p-2 border">{{ $user->name }}</td>
                        <td class="p-2 border">{{ $user->email }}</td>
                        <td class="p-2 border">
                            @if($user->role=='admin')
                                <span class="px-2 py-1 rounded bg-purple-100 text-purple-700 text-xs font-semibold">
                                    Admin
                                </span>
                            @elseif($user->role=='editor')
                                <span class="px-2 py-1 rounded bg-blue-100 text-blue-700 text-xs font-semibold">
                                    Editor
                                </span>
                            @else
                                <span class="px-2 py-1 rounded bg-green-100 text-green-700 text-xs font-semibold">
                                    Viewer
                                </span>
                            @endif
                        </td>
                        <td class="p-2 border flex gap-2">

                            {{-- RESET PASSWORD --}}
                            <form method="POST" action="{{ route('admin.dev.user.reset', $user->id) }}">
                                @csrf
                                <button class="bg-yellow-500 text-white px-2 py-1 rounded text-xs">
                                    Reset Password
                                </button>
                            </form>

                            {{-- DELETE --}}
                            <form method="POST" action="{{ route('admin.dev.user.delete', $user->id) }}">
                                @csrf
                                @method('DELETE')
                                <button class="bg-red-600 text-white px-2 py-1 rounded text-xs">
                                    Delete
                                </button>
                            </form>

                        </td>
                    </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>

</div>




</x-app-layout>