<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            <div class="flex items-center">

                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="#">
                        <img src="{{ asset('image/logo.png') }}" class="w-10 h-9">
                    </a>
                </div>

                <!-- Menu -->
                <div class="hidden sm:flex sm:items-center sm:ms-10 space-x-8">

                    <x-nav-link href="#">
                        Dashboard
                    </x-nav-link>
 
                    <x-nav-link :href="route('admin.employees.index')" :active="request()->routeIs('admin.employees.*')">
                        {{ __('Employees') }}
                    </x-nav-link>

                    <x-nav-link :href="route('admin.evaluations.index')">
                        {{ __('Evaluation') }}
                    </x-nav-link>

                </div>
            </div>

            <!-- User -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">

                    <x-slot name="trigger">
                        <button class="px-3 py-2 text-sm text-gray-600">
                            {{ Auth::user()->name }}
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
                                Logout
                            </x-dropdown-link>
                        </form>
                    </x-slot>

                </x-dropdown>
            </div>

        </div>
    </div>
</nav>