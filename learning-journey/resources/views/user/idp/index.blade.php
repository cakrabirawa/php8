<x-app-layout>

    <x-slot name="header">
        <h2 class="text-xl font-semibold">
            IDP Review
        </h2>
    </x-slot>

    <div class="max-w-6xl mx-auto py-6 px-6">

        @if($idps->count())

            @php
                $sorted = $idps->sortBy(function ($i) {
                    return $i->status == 'pending' ? 0 : 1;
                });
            @endphp

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">

                @foreach($sorted as $idp)

                    @php
                        $statusColor = match($idp->status){
                            'pending' => 'bg-yellow-50 border-yellow-300',
                            'waiting_hr' => 'bg-blue-50 border-blue-200',
                            'approved' => 'bg-green-50 border-green-200',
                            default => 'bg-white border-gray-200'
                        };

                        $badgeColor = match($idp->status){
                            'pending' => 'bg-yellow-100 text-yellow-700',
                            'waiting_hr' => 'bg-blue-100 text-blue-700',
                            'approved' => 'bg-green-100 text-green-700',
                            default => 'bg-gray-100 text-gray-600'
                        };
                    @endphp


                    <a
                        href="{{ route('user.idp.show',$idp->id) }}"
                        class="block border {{ $statusColor }} shadow rounded-xl p-5 hover:shadow-lg transition"
                    >

                        {{-- HEADER --}}
                        <div class="flex justify-between items-center mb-3">

                            <h3 class="font-semibold text-gray-800">
                                {{ $idp->employee->name ?? '-' }}
                            </h3>

                            <span class="px-3 py-1 text-xs rounded {{ $badgeColor }}">
                                {{ ucfirst(str_replace('_',' ',$idp->status)) }}
                            </span>

                        </div>


                        {{-- COMPETENCY --}}
                        <p class="text-sm text-gray-500">
                            Competency
                        </p>

                        <p class="font-semibold mb-3">
                            {{ $idp->competency->name ?? '-' }}
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

                            @if($idp->status == 'pending')
                                <span class="text-xs font-semibold text-yellow-600">
                                    Needs Review
                                </span>
                            @endif

                        </div>

                    </a>

                @endforeach

            </div>

        @else

            <div class="bg-white shadow rounded-lg p-6 text-center text-gray-500">
                No IDP waiting for review.
            </div>

        @endif

    </div>

</x-app-layout>