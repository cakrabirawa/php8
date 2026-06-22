<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            <!-- LEFT -->
            <div class="flex items-center">

                <!-- Logo -->
                <a href="{{ route('sales.report.show') }}" class="flex items-center">
                    <img src="{{ asset('image/logo.png') }}" alt="Logo" class="w-10 h-9">
                </a>

                <!-- Desktop Menu -->
                <div class="hidden sm:flex sm:items-center sm:ms-10 space-x-8">
                    <x-nav-link :href="route('sales.report.show')" :active="request()->routeIs('sales.report.*')">
                        Dashboard
                    </x-nav-link>
                    <x-nav-link :href="route('sales.onboarding.index')" :active="request()->routeIs('sales.onboarding.*')">
                        Onboarding Checklist
                    </x-nav-link>
                    <x-nav-link :href="route('sales.idp.index')" :active="request()->routeIs('sales.idp.*')">
                        Individual Development Plan
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
                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-600 hover:text-gray-800">
                            {{ Auth::user()->name }}
                            <svg class="ml-1 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
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
        x-cloak
        x-show="open"
        x-transition
        @click.away="open=false"
        class="sm:hidden absolute top-16 left-0 w-full z-50 bg-gray-50 shadow-xl border-t">

        <!-- User Card -->
        <div class="p-4">
            <div class="bg-white rounded-2xl shadow p-4 mb-4">
                <div class="font-semibold text-gray-800 text-lg">
                    {{ Auth::user()->name }}
                </div>

                <div class="text-sm text-gray-500">
                    {{ Auth::user()->email }}
                </div>
            </div>

            <!-- Menu -->
            <div class="space-y-3">

                <a href="{{ route('sales.report.show') }}"
                class="flex items-center justify-between bg-white rounded-xl p-4 shadow-sm hover:shadow transition">
                    <span>📊 Dashboard</span>
                    <span>›</span>
                </a>

                <a href="{{ route('sales.onboarding.index') }}"
                class="flex items-center justify-between bg-white rounded-xl p-4 shadow-sm hover:shadow transition">
                    <span>📝 Onboarding Checklist</span>
                    <span>›</span>
                </a>

                <a href="{{ route('sales.idp.index') }}"
                class="flex items-center justify-between bg-white rounded-xl p-4 shadow-sm hover:shadow transition">
                    <span>🎯 Individual Development Plan</span>
                    <span>›</span>
                </a>

                <a href="https://classroom.google.com/c/NzU4OTM0MTA0NzE2?cjc=t5snjb7p"
                target="_blank"
                class="flex items-center justify-between bg-white rounded-xl p-4 shadow-sm hover:shadow transition">
                    <span>📚 New Journey at Gramedia</span>
                    <span>↗</span>
                </a>

                <a href="https://classroom.google.com/c/NzU4OTMwMTA4MDU4?cjc=xq5iehjy"
                target="_blank"
                class="flex items-center justify-between bg-white rounded-xl p-4 shadow-sm hover:shadow transition">
                    <span>🌱 Ruang Tumbuh Bersama</span>
                    <span>↗</span>
                </a>

                <a href="{{ route('profile.edit') }}"
                class="flex items-center justify-between bg-white rounded-xl p-4 shadow-sm hover:shadow transition">
                    <span>👤 Profile</span>
                    <span>›</span>
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button
                        type="submit"
                        class="w-full bg-red-500 text-white rounded-xl p-4 mt-3 font-semibold hover:bg-red-600 transition">
                        Logout
                    </button>
                </form>

            </div>
        </div>
    </div>
</nav>
