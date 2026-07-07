<div class="min-h-screen flex items-center justify-center bg-slate-100 p-4" x-data="loginForm()" x-init="initCaptcha()">
    <div class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-sm border border-slate-200">
        
        <div class="text-center mb-6">
            <h2 class="text-2xl font-bold text-slate-900">Selamat Datang</h2>
            <p class="text-sm text-slate-500 mt-1">Masuk ke sistem administrator</p>
        </div>

        <!-- Notifikasi Error Global -->
        <template x-if="errorMessage">
            <div class="mb-4 p-3 bg-red-50 text-red-700 text-xs rounded-xl font-medium" x-text="errorMessage"></div>
        </template>

        <form @submit.prevent="submitLogin" class="space-y-4">
            <div>
                <label class="block text-xs font-semibold text-slate-700">Email</label>
                <input type="email" x-model="email" required class="mt-1 w-full rounded-xl border-slate-200 text-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-700">Password</label>
                <input type="password" x-model="password" required class="mt-1 w-full rounded-xl border-slate-200 text-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            <!-- KOMPONEN SLIDER CAPTCHA NATIVE TAILWIND -->
            <div class="pt-2">
                <label class="block text-xs font-semibold text-slate-700 mb-2">Verifikasi Keamanan</label>
                
                <!-- Jalur Track Slider -->
                <div class="relative w-full h-10 bg-slate-100 border border-slate-200 rounded-xl overflow-hidden select-none flex items-center justify-center" id="captcha-track">
                    <span class="text-xs text-slate-400 font-medium" x-show="!isVerified">Geser ke kanan >></span>
                    <span class="text-xs text-emerald-600 font-semibold" x-show="isVerified">✓ Terverifikasi</span>

                    <!-- Area Sorotan Warna Hijau saat Digeser -->
                    <div class="absolute left-0 top-0 h-full bg-indigo-500/10" :style="`width: ${sliderX}px`"></div>

                    <!-- Tombol Geser (Handle Slider) -->
                    <div @mousedown="startDrag" 
                         @touchstart="startDrag"
                         class="absolute left-0 top-0 h-full w-12 bg-indigo-600 hover:bg-indigo-700 rounded-xl flex items-center justify-center cursor-grab active:cursor-grabbing text-white transition-colors shadow-md"
                         :style="`transform: translateX(${sliderX}px)`"
                         :class="isVerified ? 'bg-emerald-600 hover:bg-emerald-600' : ''">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </div>
                </div>
            </div>

            <button type="submit" 
                    :disabled="!isVerified || isSubmitting"
                    class="w-full bg-indigo-600 hover:bg-indigo-700 disabled:bg-slate-300 text-white disabled:text-slate-500 text-sm font-semibold py-3 rounded-xl shadow-md transition pt-3"
                    x-text="isSubmitting ? 'Memproses...' : 'Masuk Sistem'">
            </button>
        </form>
    </div>
</div>
