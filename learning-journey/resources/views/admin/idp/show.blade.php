<x-app-layout>

    <x-slot name="header">
        <h2 class="text-xl font-semibold">
            IDP Review
        </h2>
    </x-slot>

    <div class="max-w-5xl mx-auto py-6 px-6 space-y-6">


        {{-- ================= EMPLOYEE INFO ================= --}}
        <div class="bg-white shadow rounded-xl p-6">

            <h3 class="font-semibold text-lg mb-4">
                Employee Information
            </h3>

            <div class="grid grid-cols-2 gap-6">

                <div>
                    <p class="text-sm text-gray-500">Name</p>
                    <p class="font-semibold">
                        {{ $idp->employee->name ?? '-' }}
                    </p>
                </div>

                <div>
                    <p class="text-sm text-gray-500">Employee ID</p>
                    <p class="font-semibold">
                        {{ $idp->employee->employee_id ?? '-' }}
                    </p>
                </div>

            </div>

        </div>



        {{-- ================= IDP INFORMATION ================= --}}
        <div class="bg-white shadow rounded-xl p-6 space-y-5">

            <h3 class="font-semibold text-lg">
                IDP Information
            </h3>

        <div>
            <p class="text-sm text-gray-500">Competency</p>
            <p class="font-semibold">
                {{ ucwords(str_replace('_',' ', $idp->competency?->name ?? '-')) }}
            </p>
        </div>


            <div class="grid grid-cols-2 gap-6">

                <div>
                    <p class="text-sm text-gray-500">Current Level</p>
                    <p class="font-semibold">
                        {{ $currentLevel }}
                    </p>
                </div>

                <div>
                    <p class="text-sm text-gray-500">Target Level</p>
                    <p class="font-semibold">
                        {{ $targetLevel }}
                    </p>
                </div>

            </div>


            <div>
                <p class="text-sm text-gray-500">Target Development</p>
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

        <div class="bg-white shadow rounded-xl p-4">

            <p class="text-sm text-gray-600 mb-1">
                Progress: {{ $completed }} / {{ $total }} tasks
            </p>

            <div class="w-full bg-gray-200 rounded-full h-3">
                <div class="bg-green-500 h-3 rounded-full" style="width: {{ $percent }}%"></div>
            </div>

        {{-- ================= TASK LIST ================= --}}
        <div class="bg-white shadow rounded-xl p-6">

            <h3 class="font-semibold text-lg mb-4">
                Development Tasks
            </h3>

            @if($idp->tasks->count())

                <div class="space-y-4">

                    @foreach($idp->tasks as $task)

                        @php
                            $statusColor = match($task->status){
                                'pending' => 'bg-gray-100 text-gray-600',
                                'ongoing' => 'bg-yellow-100 text-yellow-700',
                                'completed' => 'bg-green-100 text-green-700',
                                default => 'bg-gray-100 text-gray-600'
                            };
                        @endphp

                        <div class="border rounded-lg p-4 flex justify-between items-start">

                            <div class="space-y-2">

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
                                <div class="bg-gray-50 border border-gray-200 rounded p-2 text-sm text-gray-700">
                                    <span class="text-xs text-gray-500 block mb-1">
                                        Notes from Sales Superintendent
                                    </span>
                                    {{ $task->notes_ss }}
                                </div>
                                @endif
                                {{-- FEEDBACK STORE MANAGER --}}
                                @if($task->feedback_sm)
                                <div class="bg-yellow-50 border border-yellow-200 rounded p-2 text-sm text-gray-700">
                                    <span class="text-xs text-yellow-700 block mb-1">
                                        Feedback from Store Manager
                                    </span>
                                    {{ $task->feedback_sm }}
                                </div>
                                @endif

                                {{-- FEEDBACK HR --}}
                                @if($task->feedback_hr)
                                <div class="bg-blue-50 border border-blue-200 rounded p-2 text-sm text-gray-700">
                                    <span class="text-xs text-blue-700 block mb-1">
                                        Feedback from HR
                                    </span>
                                    {{ $task->feedback_hr }}
                                </div>
                                @endif
                                @if($task->target_date)
                                    <span class="text-xs px-2 py-1 rounded bg-indigo-100 text-indigo-700">
                                        {{ $task->target_date->format('d M Y') }}
                                    </span>
                                @endif


                                @if($task->evidence_link)
                                    <div>
                                        <a
                                            href="{{ $task->evidence_link }}"
                                            target="_blank"
                                            class="text-blue-600 text-xs underline"
                                        >
                                            View Evidence
                                        </a>
                                    </div>
                                @endif

                            </div>


                            <div>
                                <span class="px-3 py-1 text-xs rounded {{ $statusColor }}">
                                    {{ ucfirst($task->status) }}
                                </span>
                            </div>

                        </div>

                    @endforeach

                </div>

            @else

                <p class="text-gray-400 text-sm">
                    No development tasks.
                </p>

            @endif

        </div>







        {{-- HR APPROVAL --}}
        @if($idp->status == 'waiting_hr')
        {{-- ================= FEEDBACK FORM ================= --}}
        <div class="bg-white shadow rounded-xl p-6">

            <h3 class="font-semibold text-lg mb-5">
                Feedback & Approval
            </h3>
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-5">

                    <form method="POST" action="{{ route('admin.idp.approve',$idp->id) }}">

                        @csrf

                        <textarea
                            name="feedback"
                            required
                            rows="4"
                            class="w-full border rounded-lg p-3"
                            placeholder="Write HR feedback..."
                        ></textarea>

                        <button
                            class="mt-4 bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg"
                        >
                            Approve as HR
                        </button>

                    </form>

                </div>

            @endif

        </div>

    </div>

</x-app-layout>