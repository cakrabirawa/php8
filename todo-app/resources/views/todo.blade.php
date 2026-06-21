<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Todo List - Fetch API & Loading</title>
    @vite('resources/css/app.css')
    <!-- CSRF Token untuk Keamanan Fetch API -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4">
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
        <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">My Todo List</h1>

        <!-- Form Tambah Todo Baru -->
        <form id="todo-form" class="flex mb-6">
            <input type="text" id="todo-title" placeholder="Tambah tugas baru..." required autocomplete="off"
                class="flex-1 px-4 py-2 border rounded-l-lg focus:outline-none focus:ring-2 focus:ring-blue-500 disabled:bg-gray-100">
            <button type="submit"
                class="bg-blue-500 text-white px-4 py-2 rounded-r-lg hover:bg-blue-600 transition font-medium flex items-center space-x-2">
                <span>Tambah</span>
            </button>
        </form>

        <div class="mb-4">
            <input type="text" id="search-input" placeholder="Cari tugas di semua field..."
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
        </div>

        <!-- Daftar Box Tugas -->
        <ul id="todo-list" class="space-y-3">
            @forelse($todos as $todo)
                <li id="todo-item-{{ $todo->id }}"
                    class="p-3 bg-gray-50 rounded-lg border flex flex-col justify-center min-h-[56px]">
                    <div class="flex items-center justify-between w-full">
                        <div class="flex items-center space-x-3 flex-1 min-w-0">
                            <!-- Checkbox Status -->
                            <button onclick="toggleTodo({{ $todo->id }})"
                                class="w-6 h-6 border rounded-full flex items-center justify-center transition flex-shrink-0
                                                            {{ $todo->is_completed ? 'bg-green-500 border-green-500 text-white' : 'border-gray-400 hover:border-green-500' }}">
                                <span id="check-icon-{{ $todo->id }}">{{ $todo->is_completed ? '✓' : '' }}</span>
                            </button>

                            <!-- Teks Judul Tugas -->
                            <span id="text-{{ $todo->id }}" contenteditable="false" onblur="saveEdit({{ $todo->id }}, this)"
                                class="text-gray-700 break-words pr-2 focus:outline-none focus:bg-yellow-50 rounded px-1 flex-1 {{ $todo->is_completed ? 'line-through text-gray-400' : '' }}">
                                {{ $todo->title }}
                            </span>
                        </div>

                        <!-- Tombol Aksi Kanan -->
                        <div class="flex items-center space-x-3 flex-shrink-0 ml-2">
                            <button id="btn-edit-{{ $todo->id }}" onclick="enableEdit({{ $todo->id }})"
                                class="text-blue-500 hover:text-blue-700 text-sm font-medium {{ $todo->is_completed ? 'hidden' : '' }}">
                                Ubah
                            </button>
                            <button onclick="deleteTodo({{ $todo->id }})"
                                class="text-red-500 hover:text-red-700 font-bold px-1">
                                ✕
                            </button>
                        </div>
                    </div>
                </li>
            @empty
                <p id="empty-message" class="text-center text-gray-500 py-6">Belum ada tugas hari ini!</p>
            @endforelse
        </ul>
    </div>

    <!-- JavaScript Fetch API dengan Indikator Save -->
    <script>
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        let searchTimeout;

        // 1. Tambah Tugas (Store) dengan Indikator Proses Simpan
        document.getElementById('todo-form').addEventListener('submit', async function (e) {
            e.preventDefault();
            const input = document.getElementById('todo-title');
            const submitBtn = this.querySelector('button[type="submit"]');
            const title = input.value;

            // Kunci elemen form agar tidak ada submit ganda
            submitBtn.disabled = true;
            input.disabled = true;

            // Ubah tampilan tombol ke mode loading menggunakan Tailwind CSS
            submitBtn.className = "bg-blue-400 text-white px-4 py-2 rounded-r-lg cursor-not-allowed transition font-medium flex items-center space-x-2";
            submitBtn.innerHTML = `
                <svg class="animate-spin h-5 w-5 text-white" xmlns="http://w3.org" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <span>Proses...</span>
            `;

            try {
                const response = await fetch('/todo', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({ title: title })
                });

                if (response.ok) {
                    input.value = '';
                    window.location.reload(); // Memuat ulang ringan untuk sinkronisasi list database terbaru
                }
            } catch (error) {
                console.error('Error:', error);

                // Jika terjadi gagal koneksi, kembalikan tombol ke kondisi normal
                submitBtn.disabled = false;
                input.disabled = false;
                submitBtn.className = "bg-blue-500 text-white px-4 py-2 rounded-r-lg hover:bg-blue-600 transition font-medium flex items-center space-x-2";
                submitBtn.innerHTML = "<span>Tambah</span>";
            }
        });

        document.getElementById('search-input').addEventListener('input', function () {
            const keyword = this.value;

            // Gunakan debounce agar tidak terlalu sering menembak database saat mengetik
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(async () => {
                try {
                    // Panggil controller dengan membawa parameter search
                    const response = await fetch(`/?search=${encodeURIComponent(keyword)}`, {
                        headers: { 'X-Requested-With': 'XMLHttpRequest' }
                    });

                    if (response.ok) {
                        const todos = await response.json();
                        const listContainer = document.getElementById('todo-list');
                        listContainer.innerHTML = ''; // Kosongkan daftar lama

                        if (todos.length === 0) {
                            listContainer.innerHTML = '<p class="text-center text-gray-500 py-6">Data tidak ditemukan!</p>';
                            return;
                        }

                        // Cetak ulang tabel/list data secara dinamis
                        todos.forEach(todo => {
                            const isCompleted = todo.is_completed;
                            const itemHtml = `
                        <li id="todo-item-${todo.id}" class="p-3 bg-gray-50 rounded-lg border flex flex-col justify-center min-h-[56px]">
                            <div class="flex items-center justify-between w-full">
                                <div class="flex items-center space-x-3 flex-1 min-w-0">
                                    <button onclick="toggleTodo(${todo.id})" class="w-6 h-6 border rounded-full flex items-center justify-center transition flex-shrink-0 ${isCompleted ? 'bg-green-500 border-green-500 text-white' : 'border-gray-400 hover:border-green-500'}">
                                        <span id="check-icon-${todo.id}">${isCompleted ? '✓' : ''}</span>
                                    </button>
                                    <span id="text-${todo.id}" contenteditable="false" onblur="saveEdit(${todo.id}, this)" class="text-gray-700 break-words pr-2 focus:outline-none focus:bg-yellow-50 rounded px-1 flex-1 ${isCompleted ? 'line-through text-gray-400' : ''}">
                                        ${todo.title}
                                    </span>
                                </div>
                                <div class="flex items-center space-x-3 flex-shrink-0 ml-2">
                                    <button id="btn-edit-${todo.id}" onclick="enableEdit(${todo.id})" class="text-blue-500 hover:text-blue-700 text-sm font-medium ${isCompleted ? 'hidden' : ''}">Ubah</button>
                                    <button onclick="deleteTodo(${todo.id})" class="text-red-500 hover:text-red-700 font-bold px-1">✕</button>
                                </div>
                            </div>
                        </li>
                    `;
                            listContainer.insertAdjacentHTML('beforeend', itemHtml);
                        });
                    }
                } catch (error) {
                    console.error('Error saat mencari data:', error);
                }
            }, 300); // Menunggu 300ms setelah user selesai mengetik karakter terakhir
        });

        // 2. Ubah Status Checklist (Update Boolean)
        async function toggleTodo(id) {
            try {
                const response = await fetch(`/todo/${id}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    }
                });

                if (response.ok) {
                    const data = await response.json();
                    const textEl = document.getElementById(`text-${id}`);
                    const btnEdit = document.getElementById(`btn-edit-${id}`);
                    const checkIcon = document.getElementById(`check-icon-${id}`);
                    const btnCheck = checkIcon.parentElement;

                    if (data.is_completed) {
                        textEl.classList.add('line-through', 'text-gray-400');
                        btnEdit.classList.add('hidden');
                        btnCheck.className = "w-6 h-6 border rounded-full flex items-center justify-center transition flex-shrink-0 bg-green-500 border-green-500 text-white";
                        checkIcon.innerText = '✓';
                    } else {
                        textEl.classList.remove('line-through', 'text-gray-400');
                        btnEdit.classList.remove('hidden');
                        btnCheck.className = "w-6 h-6 border rounded-full flex items-center justify-center transition flex-shrink-0 border-gray-400 hover:border-green-500";
                        checkIcon.innerText = '';
                    }
                }
            } catch (error) {
                console.error('Error:', error);
            }
        }

        // 3. Aktifkan Mode Edit Teks
        function enableEdit(id) {
            const textEl = document.getElementById(`text-${id}`);
            textEl.contentEditable = "true";
            textEl.focus();

            // Taruh posisi kursor otomatis ke ujung karakter terakhir teks
            const range = document.createRange();
            const sel = window.getSelection();
            range.selectNodeContents(textEl);
            range.collapse(false);
            sel.removeAllRanges();
            sel.addRange(range);
        }

        // 4. Simpan Perubahan Teks Saat Kursor Keluar (Blur)
        async function saveEdit(id, element) {
            const newTitle = element.innerText.trim();
            element.contentEditable = "false";

            if (!newTitle) return window.location.reload();

            try {
                await fetch(`/todo/${id}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({ title: newTitle })
                });
            } catch (error) {
                console.error('Error:', error);
            }
        }

        // 5. Hapus Tugas (Destroy)
        async function deleteTodo(id) {
            if (!confirm('Hapus tugas ini?')) return;

            try {
                const response = await fetch(`/todo/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    }
                });

                if (response.ok) {
                    document.getElementById(`todo-item-${id}`).remove();
                    if (document.querySelectorAll('#todo-list li').length === 0) {
                        window.location.reload();
                    }
                }
            } catch (error) {
                console.error('Error:', error);
            }
        }
    </script>
</body>

</html>