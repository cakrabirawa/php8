<script>
    // FUNGSI UNTUK MENANGANI FORM LOGIN & SLIDER CAPTCHA
    function loginForm() {
        return {
            email: '',
            password: '',
            sliderX: 0,
            isDragging: false,
            isVerified: false,
            isSubmitting: false,
            errorMessage: '',
            startX: 0,
            maxSlider: 236, // Lebar track (284px) dikurangi lebar handle (48px)

            initCaptcha() {
                fetch('/api/captcha/generate');
            },
            startDrag(e) {
                if (this.isVerified) return;
                this.isDragging = true;
                this.startX = e.type === 'touchstart' ? e.touches[0].clientX : e.clientX;
                
                // Daftarkan event global agar geseran mulus meskipun keluar dari area box
                document.addEventListener('mousemove', this.moveDrag.bind(this));
                document.addEventListener('mouseup', this.stopDrag.bind(this));
                document.addEventListener('touchmove', this.moveDrag.bind(this), { passive: false });
                document.addEventListener('touchend', this.stopDrag.bind(this));
            },
            moveDrag(e) {
                if (!this.isDragging) return;
                if (e.type === 'touchmove') e.preventDefault(); // Mencegah scroll layar pada mobile
                
                let currentClientX = e.type === 'touchmove' ? e.touches[0].clientX : e.clientX;
                let deltaX = currentClientX - this.startX;
                
                // Batasi pergerakan agar tidak keluar dari jalur trek kiri & kanan
                this.sliderX = Math.max(0, Math.min(deltaX, this.maxSlider));

                // Jika user menggeser sampai ujung kanan, anggap lolos verifikasi frontend sementara
                if (this.sliderX >= this.maxSlider) {
                    this.isVerified = true;
                    this.isDragging = false;
                }
            },
            stopDrag() {
                this.isDragging = false;
                // Jika dilepas sebelum ujung kanan, kembalikan posisi slider ke awal (reset)
                if (!this.isVerified) {
                    this.sliderX = 0;
                }
            },
            async submitLogin() {
                if (!this.isVerified) return;
                this.isSubmitting = true;
                this.errorMessage = '';

                let res = await fetch('/api/login', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    body: JSON.stringify({
                        email: this.email,
                        password: this.password,
                        user_x: this.sliderX // Kirim data koordinat untuk divalidasi server
                    })
                });

                let data = await res.json();
                this.isSubmitting = false;

                if (res.ok) {
                    // Update state shell utama agar merender panel admin secara instan
                    window.location.reload(); // Refresh halaman sekali saja untuk sinkronisasi middleware sesi auth baru
                } else {
                    this.errorMessage = data.errors ? Object.values(data.errors)[0][0] : 'Terjadi kesalahan sistem.';
                    this.isVerified = false;
                    this.sliderX = 0; // Reset captcha
                    this.initCaptcha(); // Minta target angka acak baru dari server
                }
            }
        }
    }

    // UPDATE STATE CORE SPA SHELL UTAMA ANDA
    function spaShell() {
        return {
            isLoggedIn: {{ auth()->check() ? 'true' : 'false' }}, // Deteksi otomatis status otentikasi Laravel
            activePage: 'admin.users', 
            menus: [],
            auth: { name: '', role: '' },
            users: [],
            showUserModal: false,
            userModalMode: 'create',
            currentUserId: null,
            userForm: { name: '', email: '', role: 'staff', password: '' },
            selectedRole: 'admin',
            allAvailableMenus: [],
            allowedMenuIds: [],

            async initApp() {
                if (!this.isLoggedIn) return; // Jangan jalankan data admin jika belum login
                
                let res = await fetch('/api/spa/init');
                let data = await res.json();
                this.menus = data.menus;
                this.auth = data.user;
                this.switchPage(this.activePage);
            },
            switchPage(routeName) {
                if(!routeName) return; 
                this.activePage = routeName;
                if (routeName === 'admin.users') this.getUsers();
                if (routeName === 'admin.access') this.fetchPermissions();
            },
            async getUsers() {
                let res = await fetch('/api/users/data');
                this.users = await res.json();
            },
            openUserModal(mode, user = null) {
                this.userModalMode = mode;
                this.showUserModal = true;
                this.userForm = (mode === 'edit' && user) 
                    ? { name: user.name, email: user.email, role: user.role, password: '' } 
                    : { name: '', email: '', role: 'staff', password: '' };
                if(user) this.currentUserId = user.id;
            },
            async submitUserForm() {
                let url = this.userModalMode === 'create' ? '/api/users/store' : `/api/users/update/${this.currentUserId}`;
                let method = this.userModalMode === 'create' ? 'POST' : 'PUT';
                let res = await fetch(url, {
                    method: method,
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    body: JSON.stringify(this.userForm)
                });
                if (res.ok) { this.showUserModal = false; this.getUsers(); }
            },
            async deleteUser(id) {
                if (confirm('Hapus user ini?')) {
                    let res = await fetch(`/api/users/delete/${id}`, { method: 'DELETE', headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' } });
                    if (res.ok) this.getUsers();
                }
            },
            async fetchPermissions() {
                let res = await fetch(`/api/permissions/${this.selectedRole}`);
                let data = await res.json();
                this.allAvailableMenus = data.all_menus;
                this.allowedMenuIds = data.allowed;
            },
            async savePermissions() {
                let res = await fetch('/api/permissions/save', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    body: JSON.stringify({ role: this.selectedRole, menus: this.allowedMenuIds })
                });
                if (res.ok) { alert('Berhasil!'); if(this.selectedRole === this.auth.role) this.initApp(); }
            },
            async handleLogout() {
                let res = await fetch('/api/logout', {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
                });
                if (res.ok) {
                    window.location.reload();
                }
            }
        }
    }
</script>
