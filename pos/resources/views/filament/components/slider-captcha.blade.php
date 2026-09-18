<div style="margin-top: 20px; margin-bottom: 12px; width: 100%;">
    <div x-data="{
        unlocked: false,
        failed: false,
        targetKey: '',
        options: [],
        lastClickTime: 0,
    
        // Data bank simbol (Aman dari pembacaan teks HTML murni)
        icons: {
            k: '🔑',
            c: '👑',
            b: '🔔',
            t: '🏆'
        },
        labels: {
            k: 'Kunci',
            c: 'Mahkota',
            b: 'Lonceng',
            t: 'Piala'
        },
    
        init() {
            this.generateCaptcha();
            this.$watch('unlocked', value => {
                if (value) {
                    // Set nilai input untuk validasi Livewire backend
                    this.$refs.captchaInput.value = '1';
                    this.$refs.captchaInput.dispatchEvent(new Event('input'));
    
                    // OTOMATIS KLIK SIGN IN: Mencari tombol submit di dalam form login Filament
                    setTimeout(() => {
                        let loginForm = this.$refs.captchaInput.closest('form');
                        if (loginForm) {
                            let submitButton = loginForm.querySelector('button[type=\'submit\']');
                            if (submitButton) submitButton.click();
                        }
                    }, 600); // Jeda 600ms agar user sempat melihat tanda centang sukses
                }
            });
        },
    
        generateCaptcha() {
            this.unlocked = false;
            this.failed = false;
            let keys = Object.keys(this.icons);
    
            // Tentukan target rahasia acak
            this.targetKey = keys[Math.floor(Math.random() * keys.length)];
    
            // Acak urutan tombol opsi pilihan di bawah
            this.options = keys.map(key => ({ key: key, icon: this.icons[key] }))
                .sort(() => Math.random() - 0.5);
    
            // Tunggu elemen DOM selesai dimuat, lalu gambar ke Canvas bitmap
            this.$nextTick(() => {
                this.renderCanvasIcons();
            });
        },
    
        renderCanvasIcons() {
            // 1. Gambar target utama di atas (Presisi di Tengah)
            let targetCanvas = this.$refs.targetCanvas;
            if (targetCanvas) {
                let ctx = targetCanvas.getContext('2d');
                ctx.clearRect(0, 0, 70, 70);
                ctx.font = '32px sans-serif';
                ctx.textAlign = 'center';
                ctx.textBaseline = 'middle';
    
                ctx.save();
                ctx.translate(35, 35);
                // Distorsi rotasi ringan acak agar bot scanner bingung
                ctx.rotate((Math.random() * 0.2 - 0.1));
                ctx.fillText(this.icons[this.targetKey], 0, 0);
                ctx.restore();
            }
    
            // 2. Gambar opsi-opsi tombol pilihan di bawah
            this.options.forEach((opt) => {
                let optCanvas = document.getElementById('opt-canvas-' + opt.key);
                if (optCanvas) {
                    let ctx = optCanvas.getContext('2d');
                    ctx.clearRect(0, 0, 54, 54);
                    ctx.font = '26px sans-serif';
                    ctx.textAlign = 'center';
                    ctx.textBaseline = 'middle';
    
                    ctx.save();
                    ctx.translate(27, 27);
                    let randomAngle = (Math.random() * 0.4 - 0.2);
                    ctx.rotate(randomAngle);
                    ctx.fillText(opt.icon, 0, 0);
                    ctx.restore();
                }
            });
        },
    
        checkAnswer(selectedKey) {
            if (this.unlocked || this.failed) return;
    
            // Deteksi Kecepatan Klik (Anti Brute-Force Bot)
            let currentTime = new Date().getTime();
            if (this.lastClickTime > 0 && (currentTime - this.lastClickTime) < 250) {
                this.generateCaptcha();
                return;
            }
            this.lastClickTime = currentTime;
    
            if (selectedKey === this.targetKey) {
                this.unlocked = true;
                this.failed = false;
            } else {
                this.failed = true;
                // Kunci tombol sejenak, lalu acak ulang polanya
                setTimeout(() => { this.generateCaptcha(); }, 1200);
            }
        }
    }"
        style="width: 100%; background: #ffffff; border: 1px solid #e2e8f0; border-radius: 16px; padding: 22px; box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.05); box-sizing: border-box; font-family: inherit;">

        <!-- INPUT TERSEMBUNYI UNTUK DIKIRIM KE BACKEND -->
        <input type="hidden" id="captcha_unlocked" x-ref="captchaInput" wire:model.defer="data.captcha_unlocked"
            value="0">

        <!-- KOTAK ATAS: TARGET VERIFIKASI (SUDAH CENTERED) -->
        <div
            style="text-align: center; margin-bottom: 22px; display: flex; flex-direction: column; align-items: center; justify-content: center; width: 100%;">
            <span
                style="font-size: 12px; font-weight: 600; color: #94a3b8; display: block; margin-bottom: 12px; text-transform: uppercase; letter-spacing: 0.5px;">
                Validasi Keamanan Sistem
            </span>

            <!-- Lingkaran Bingkai Target Tengah Semesta -->
            <div style="display: flex; position: relative; align-items: center; justify-content: center; width: 72px; height: 72px; background-color: #f8fafc; border: 1px solid #e2e8f0; border-radius: 50%; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); box-shadow: inset 0 2px 4px 0 rgba(0, 0, 0, 0.03); margin: 0 auto 14px auto;"
                :style="unlocked ? 'background-color: #dcfce7; border-color: #22c55e;' : (failed ?
                    'background-color: #fee2e2; border-color: #ef4444;' : '')">

                <!-- Canvas Gambar Ikon Target Utama -->
                <canvas x-show="!unlocked && !failed" x-ref="targetCanvas" width="70" height="70"
                    style="width:70px; height:70px; pointer-events: none; display: block; margin: 0 auto;"></canvas>

                <!-- Status Sukses Centang Hijau -->
                <span x-show="unlocked"
                    style="display: none; color: #16a34a; align-items: center; justify-content: center;">
                    <svg xmlns="http://w3.org" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        style="width: 32px; height: 32px;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                    </svg>
                </span>

                <!-- Status Gagal Silang Merah -->
                <span x-show="failed"
                    style="display: none; color: #dc2626; align-items: center; justify-content: center;">
                    <svg xmlns="http://w3.org" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        style="width: 32px; height: 32px;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </span>
            </div>

            <!-- Teks Intruksi Dinamis -->
            <div style="font-size: 14px; font-weight: 600; color: #334155; width: 100%; text-align: center;">
                <span x-show="!unlocked && !failed">Cari & ketuk ikon kembaran di bawah:</span>
                <span x-show="unlocked" style="color: #16a34a; display: none;">Manusia Terverifikasi</span>
                <span x-show="failed" style="color: #dc2626; display: none;">Salah, Mengacak Ulang...</span>
            </div>
        </div>

        <!-- BARISAN OPSI TOMBOL CANVAS PILIHAN (BAWAH) -->
        <div style="display: flex; justify-content: center; gap: 12px; margin-top: 16px; width: 100%;">
            <template x-for="item in options" :key="item.key">
                <button type="button" @click="checkAnswer(item.key)" :disabled="unlocked || failed"
                    style="width: 56px; height: 56px; background: #ffffff; border: 1px solid #e2e8f0; border-radius: 12px; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1); outline: none; box-sizing: border-box; shadow: 0 1px 3px 0 rgba(0,0,0,0.05);"
                    :style="unlocked ? 'opacity: 0.3; cursor: default; background: #f8fafc;' : ''"
                    onmouseover="this.style.borderColor='#4f46e5'; this.style.boxShadow='0 4px 12px rgba(79, 70, 229, 0.12)'; this.style.transform='translateY(-1px)';"
                    onmouseout="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none'; this.style.transform='translateY(0)';">

                    <!-- Element Canvas Gambar Tombol Pilihan -->
                    <canvas :id="'opt-canvas-' + item.key" width="54" height="54"
                        style="width:54px; height:54px; pointer-events: none; display: block;"></canvas>
                </button>
            </template>
        </div>
    </div>
</div>
