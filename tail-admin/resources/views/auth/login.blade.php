<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" x-data="loginForm()">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <!-- Captcha Slider -->
        <div class="mt-4">
            <x-input-label for="captcha" value="Geser untuk verifikasi" />
            <div class="relative w-full h-12 bg-gray-200 rounded-lg mt-1 flex items-center">
                <div class="absolute top-0 left-0 h-full bg-indigo-500 rounded-lg" :style="`width: ${sliderValue}%`"></div>
                <input type="range" id="captcha_slider" min="0" max="100" x-model="sliderValue" class="w-full h-full opacity-0 cursor-pointer" style="z-index: 10;">
                <div class="absolute inset-0 flex items-center justify-center text-white font-semibold pointer-events-none">
                    <span x-show="sliderValue < 98">Geser ke kanan</span>
                    <span x-show="sliderValue >= 98">✓ Terverifikasi</span>
                </div>
            </div>
            <input type="hidden" name="captcha" x-model="sliderValue">
            <x-input-error :messages="$errors->get('captcha')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>

    <script>
        function loginForm() {
            return {
                sliderValue: 0,
                init() {
                    // Tidak perlu lagi mengambil target dari server
                    // Reset slider jika ada error validasi dari server
                    @if($errors->has('captcha'))
                        this.sliderValue = 0;
                    @endif
                }
            }
        }
    </script>
</x-guest-layout>
