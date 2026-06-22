<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            <!-- LEFT -->
            <div class="flex items-center">

                <!-- Logo -->
                <a href="{{ route('dashboard') }}" class="flex items-center">
                    <img src="{{ asset('image/logo.png') }}" alt="Logo" class="w-10 h-9">
                </a>

                <!-- Desktop Menu -->
                <div class="hidden sm:flex sm:items-center sm:ms-6 gap-6 text-[13px]">
                    <x-nav-link :href="route('user.dashboard')" :active="request()->routeIs('user.dashboard.*')">
                        Dashboard
                    </x-nav-link>
                    <x-nav-link :href="route('user.onboarding.index')" :active="request()->routeIs('user.onboarding.*')">
                        Onboarding Checklist
                    </x-nav-link>
                    <x-nav-link :href="route('user.mentoring.index')" :active="request()->routeIs('user.mentoring.*')">
                        Mentoring
                    </x-nav-link>
                    <x-nav-link :href="route('user.idp.index')" :active="request()->routeIs('user.idp.*')">
                        IDP Review
                    </x-nav-link>
                    <x-nav-link href="https://classroom.google.com/c/NzU4OTM0MTA0NzE2?cjc=t5snjb7p" target="_blank">
                        New Journey at Gramedia
                    </x-nav-link>
                    <x-nav-link href="https://classroom.google.com/c/NzU4OTMwMTA4MDU4?cjc=xq5iehjy" target="_blank">
                        Ruang Tumbuh Bersama
                    </x-nav-link>
                </div>
            </div>

            <!-- RIGHT DESKTOP -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                        class="inline-flex items-center max-w-[220px] px-3 py-2 text-sm font-medium text-gray-600 hover:text-gray-800">
                            <span class="truncate whitespace-nowrap overflow-hidden">
                                {{ Auth::user()->name }}
                            </span>

                            <svg class="ml-1 h-4 w-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            Profile
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                Log Out
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- MOBILE BUTTON -->
            <div class="flex items-center sm:hidden">
                <button @click="open = !open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-500 hover:bg-gray-100 focus:outline-none">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path x-bind:class="open ? 'hidden' : 'inline-flex'"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16" />
                        <path x-bind:class="open ? 'inline-flex' : 'hidden'"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

        </div>
    </div>

    <!-- MOBILE MENU -->
    <div
        x-bind:class="open ? 'block' : 'hidden'"
        class="sm:hidden bg-white border-t border-gray-200"
    >
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('user.dashboard')">
                Dashboard
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('user.onboarding.index')">
                Onboarding Checklist
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('user.mentoring.index')">
                Mentoring
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('user.idp.index')">
                IDP Review
            </x-responsive-nav-link>
        </div>

        <!-- MOBILE USER -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">
                    {{ Auth::user()->name }}
                </div>
                <div class="font-medium text-sm text-gray-500">
                    {{ Auth::user()->email }}
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    Profile
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        Log Out
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
