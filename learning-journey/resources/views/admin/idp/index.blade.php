<x-app-layout>

    <x-slot name="header">
        <h2 class="text-xl font-semibold">
            HR IDP Approval
        </h2>
    </x-slot>

    <div class="max-w-6xl mx-auto py-6 px-6 space-y-6">


        {{-- SEARCH --}}
        <div class="flex justify-between items-center">

            <form method="GET" class="flex items-center gap-3">
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search name / employee ID..."
                    class="w-full md:w-96 border rounded-lg px-4 py-2 focus:ring focus:ring-blue-200"
                >

                <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    Search
                </button>
            </form>

            <a href="{{ route('admin.competency.index') }}"
            class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                Manage Competency
            </a>

        </div>



        @if($idps->count())

            @php
                $sorted = $idps->sortByDesc(function ($idp) {
                    return $idp->status === 'waiting_hr';
                });
            @endphp


            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">

                @foreach($sorted as $idp)

                    @php
                        $statusColor = match ($idp->status) {
                            'waiting_hr' => 'bg-blue-50 border-blue-300',
                            'approved' => 'bg-green-50 border-green-200',
                            default => 'bg-white border-gray-200'
                        };

                        $badgeColor = match ($idp->status) {
                            'waiting_hr' => 'bg-blue-100 text-blue-700',
                            'approved' => 'bg-green-100 text-green-700',
                            default => 'bg-gray-100 text-gray-600'
                        };
                    @endphp


                    <a
                        href="{{ route('admin.idp.show', $idp->id) }}"
                        class="block border {{ $statusColor }} shadow rounded-xl p-5 hover:shadow-lg transition"
                    >


                        {{-- HEADER --}}
                        <div class="flex justify-between items-center mb-3">

                            <h3 class="font-semibold text-gray-800">
                                {{ $idp->employee->name ?? '-' }}
                            </h3>

                            <span class="px-3 py-1 text-xs rounded {{ $badgeColor }}">
                                {{ ucfirst(str_replace('_', ' ', $idp->status)) }}
                            </span>

                        </div>


                        {{-- EMPLOYEE ID --}}
                        <p class="text-xs text-gray-400 mb-2">
                            Employee ID : {{ $idp->employee->employee_id ?? '-' }}
                        </p>


                        {{-- COMPETENCY --}}
                        <p class="text-sm text-gray-500">
                            Competency
                        </p>

                        <p class="font-semibold mb-3">
                            {{ ucwords(str_replace('_',' ', $idp->competency?->name ?? '-')) }}
                        </p>


                        {{-- TARGET --}}
                        <p class="text-sm text-gray-500">
                            Target IDP
                        </p>

                        <p class="text-sm text-gray-700 line-clamp-3">
                            {{ $idp->target_idp }}
                        </p>


                        {{-- FOOTER --}}
                        <div class="flex justify-between items-center mt-4">

                            <span class="text-xs text-gray-400">
                                {{ $idp->created_at->format('d M Y') }}
                            </span>

                            @if($idp->status == 'waiting_hr')
                                <span class="text-xs font-semibold text-blue-600">
                                    Needs HR Approval
                                </span>
                            @endif

                        </div>

                    </a>

                @endforeach

            </div>


        @else

            <div class="bg-white shadow rounded-lg p-6 text-center text-gray-500">
                No IDP found.
            </div>

        @endif


    </div>

</x-app-layout>