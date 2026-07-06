<?php
require_once '../config/database.php';

if (!isset($_SESSION['login_admin'])) {
    header("Location: " . ADMIN_URL . "login");
    exit;
}

// Lacak kunjungan
track_page_visit($conn, 'admin/assets');

// Ambil semua aset dari database
$assets = [];
$result = mysqli_query($conn, "SELECT id, unique_filename, original_filename, filesize, filetype, uploaded_at FROM assets ORDER BY uploaded_at DESC");
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $assets[] = $row;
    }
}

/**
 * Fungsi untuk mendapatkan path pratinjau atau ikon berdasarkan tipe file.
 * @param array $asset Data aset dari database.
 * @return string Path URL ke file pratinjau atau ikon.
 */
function get_asset_preview(array $asset): string
{
    $file_path = BASE_URL . 'uploads/assets/' . rawurlencode($asset['unique_filename']);
    $file_type = strtolower($asset['filetype']);

    // Tampilkan gambar asli jika tipenya adalah gambar
    if (str_starts_with($file_type, 'image/')) {
        return $file_path;
    }

    // Tampilkan video jika tipenya adalah video
    if (str_starts_with($file_type, 'video/')) {
        return BASE_URL . 'assets/icons/video.svg'; // Ikon generik untuk video
    }

    // Ikon untuk tipe file umum lainnya
    switch ($file_type) {
        case 'application/pdf':
            return BASE_URL . 'assets/icons/pdf.svg';
        case 'application/zip':
        case 'application/x-rar-compressed':
            return BASE_URL . 'assets/icons/zip.svg';
        case 'application/msword':
        case 'application/vnd.openxmlformats-officedocument.wordprocessingml.document':
            return BASE_URL . 'assets/icons/document.svg';
        default:
            return BASE_URL . 'assets/icons/file.svg'; // Ikon default
    }
}

/**
 * Format ukuran file menjadi lebih mudah dibaca.
 */
function format_filesize(int $bytes): string
{
    if ($bytes >= 1073741824) {
        return number_format($bytes / 1073741824, 2) . ' GB';
    } elseif ($bytes >= 1048576) {
        return number_format($bytes / 1048576, 2) . ' MB';
    } elseif ($bytes >= 1024) {
        return number_format($bytes / 1024, 2) . ' KB';
    } elseif ($bytes > 1) {
        return $bytes . ' bytes';
    } elseif ($bytes == 1) {
        return '1 byte';
    } else {
        return '0 bytes';
    }
}

include 'header.php';
?>

<div class="w-full">
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-black text-gray-800 dark:text-zinc-100">🖼️ File Manager</h1>
            <p class="text-gray-500 mt-1 dark:text-zinc-400">Unggah dan kelola semua aset digital Anda di satu tempat.</p>
        </div>
        <!-- Tombol Unggah akan mentrigger input file tersembunyi -->
        <button id="upload-button" class="mt-4 sm:mt-0 w-full sm:w-auto bg-purple-600 text-white font-bold px-5 py-2.5 rounded-lg text-sm shadow-md hover:bg-purple-700 transition">
            Unggah File Baru
        </button>
    </div>

    <!-- Area Unggah (Drag & Drop dan Progress) -->
    <div id="upload-area" class="mb-6">
        <!-- Input file tersembunyi -->
        <input type="file" id="file-input" class="hidden" multiple />

        <!-- Dropzone -->
        <div id="upload-container" class="border-2 border-dashed border-gray-300 dark:border-zinc-600 rounded-xl p-8 text-center cursor-pointer hover:bg-gray-50 dark:hover:bg-zinc-800 transition">
            <div class="text-5xl mb-2">📤</div>
            <p class="font-bold text-gray-700 dark:text-zinc-300">Tarik & Lepas file di sini</p>
            <p class="text-sm text-gray-500 dark:text-zinc-400">atau klik untuk memilih file dari komputer Anda.</p>
        </div>

        <!-- Progress Bar (muncul saat proses unggah) -->
        <div id="upload-progress-container" class="hidden mt-4 bg-white dark:bg-zinc-800 border dark:border-zinc-700 rounded-xl p-4 shadow-sm">
            <div class="flex items-center justify-between mb-2">
                <p id="progress-filename" class="text-sm font-medium text-gray-800 dark:text-zinc-200 truncate"></p>
                <p id="progress-percentage" class="text-sm font-bold text-cerita"></p>
            </div>
            <div class="w-full bg-gray-200 dark:bg-zinc-700 rounded-full h-2.5">
                <div id="progress-bar" class="bg-cerita h-2.5 rounded-full transition-all duration-300"></div>
            </div>
            <p id="upload-status" class="text-xs text-gray-500 dark:text-zinc-400 mt-2 text-center"></p>
        </div>
    </div>

    <!-- Galeri Aset -->
    <div class="bg-white dark:bg-zinc-900 p-6 rounded-xl shadow-sm border dark:border-zinc-700">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-bold text-gray-700 dark:text-zinc-200">Galeri Aset</h3>
            <div class="relative w-full max-w-xs">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">🔍</span>
                <input type="text" id="search-asset" placeholder="Cari nama file..." class="w-full pl-10 pr-4 py-2 rounded-lg border bg-gray-50 dark:bg-zinc-800 dark:border-zinc-600 focus:outline-none focus:ring-2 focus:ring-cerita text-sm">
            </div>
        </div>

        <div id="asset-grid" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
            <?php if (!empty($assets)) : foreach ($assets as $asset) : ?>
                    <div class="asset-card group relative border dark:border-zinc-700 rounded-lg overflow-hidden aspect-square flex items-center justify-center bg-gray-50 dark:bg-zinc-800" data-filename="<?= strtolower(htmlspecialchars($asset['original_filename'])); ?>" data-asset-info='<?= json_encode($asset); ?>'>
                        <img src="<?= get_asset_preview($asset); ?>" alt="<?= htmlspecialchars($asset['original_filename']); ?>" class="max-w-full max-h-full object-contain">
                        <div class="absolute inset-0 bg-black/60 flex flex-col items-center justify-center p-2 text-center opacity-0 group-hover:opacity-100 transition-opacity">
                            <p class="text-white text-xs font-bold break-all"><?= htmlspecialchars($asset['original_filename']); ?></p>
                            <button class="mt-2 text-xs bg-white/90 text-black px-3 py-1 rounded-md font-semibold hover:bg-white view-details-btn">Detail</button>
                        </div>
                    </div>
                <?php endforeach;
            else : ?>
                <p id="no-assets-msg" class="col-span-full text-center text-gray-500 py-12">Belum ada aset yang diunggah.</p>
            <?php endif; ?>
            <div id="no-results" class="hidden col-span-full text-center text-gray-500 py-12">
                <span class="text-3xl">🏜️</span>
                <p class="mt-2">Aset yang Anda cari tidak ditemukan.</p>
            </div>
        </div>
    </div>
</div>

<!-- Modal untuk Detail Aset -->
<div id="asset-detail-modal" class="fixed inset-0 bg-black/50 z-50 hidden items-center justify-center p-4">
    <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-2xl w-full max-w-lg transform transition-transform scale-95">
        <div class="p-6 border-b dark:border-zinc-700 flex justify-between items-center">
            <h3 class="text-lg font-bold text-gray-800 dark:text-zinc-100">Detail File</h3>
            <button id="close-modal-btn" class="text-gray-400 hover:text-gray-700 dark:hover:text-zinc-200">&times;</button>
        </div>
        <div class="p-6">
            <div class="flex flex-col md:flex-row gap-6">
                <div id="modal-preview" class="w-full md:w-1/3 h-40 flex-shrink-0 bg-gray-100 dark:bg-zinc-700 rounded-lg flex items-center justify-center overflow-hidden">
                    <!-- Preview akan diisi oleh JS -->
                </div>
                <div class="text-sm">
                    <div class="mb-3">
                        <label class="text-xs text-gray-500 dark:text-zinc-400 font-bold uppercase">Nama File</label>
                        <p id="modal-filename" class="font-semibold text-gray-800 dark:text-zinc-200 break-all"></p>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="text-xs text-gray-500 dark:text-zinc-400 font-bold uppercase">Ukuran</label>
                            <p id="modal-filesize" class="font-semibold text-gray-800 dark:text-zinc-200"></p>
                        </div>
                        <div>
                            <label class="text-xs text-gray-500 dark:text-zinc-400 font-bold uppercase">Tipe</label>
                            <p id="modal-filetype" class="font-semibold text-gray-800 dark:text-zinc-200"></p>
                        </div>
                        <div class="col-span-2">
                            <label class="text-xs text-gray-500 dark:text-zinc-400 font-bold uppercase">Tanggal Unggah</label>
                            <p id="modal-uploadedat" class="font-semibold text-gray-800 dark:text-zinc-200"></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-6">
                <label class="text-xs text-gray-500 dark:text-zinc-400 font-bold uppercase">URL File</label>
                <div class="flex items-center gap-2 mt-1">
                    <input id="modal-fileurl" type="text" readonly class="w-full bg-gray-100 dark:bg-zinc-700 border dark:border-zinc-600 rounded-md px-3 py-1.5 text-xs text-gray-600 dark:text-zinc-300">
                    <button id="copy-url-btn" class="bg-gray-200 dark:bg-zinc-600 text-xs font-bold px-3 py-1.5 rounded-md hover:bg-gray-300 dark:hover:bg-zinc-500">Salin</button>
                </div>
            </div>
        </div>
        <div class="p-4 bg-gray-50 dark:bg-zinc-900/50 rounded-b-xl flex justify-end gap-3">
            <button id="delete-file-btn" class="bg-red-600 text-white px-4 py-2 rounded-lg font-bold text-sm hover:bg-red-700">Hapus File</button>
            <button id="close-modal-btn-2" class="bg-gray-200 dark:bg-zinc-600 text-gray-800 dark:text-zinc-100 px-4 py-2 rounded-lg font-bold text-sm hover:bg-gray-300 dark:hover:bg-zinc-500">Tutup</button>
        </div>
    </div>
</div>

<script>
    function initAssetManager() {
        // Fungsi pencarian
        const searchInput = document.getElementById('search-asset'); // Penanda halaman
        if (!searchInput) return;

        // Logika Modal
        const modal = document.getElementById('asset-detail-modal');
        const closeModalBtn = document.getElementById('close-modal-btn');
        const closeModalBtn2 = document.getElementById('close-modal-btn-2');
        const deleteBtn = document.getElementById('delete-file-btn');
        let currentAssetId = null;

        function openModal(assetData) {
            currentAssetId = assetData.id;
            document.getElementById('modal-filename').textContent = assetData.original_filename;
            document.getElementById('modal-filesize').textContent = '<?= format_filesize(0); ?>'.replace('0 bytes', format_filesize_js(assetData.filesize));
            document.getElementById('modal-filetype').textContent = assetData.filetype;
            document.getElementById('modal-uploadedat').textContent = new Date(assetData.uploaded_at).toLocaleString('id-ID');

            const fileUrl = `<?= BASE_URL . 'uploads/assets/'; ?>${encodeURIComponent(assetData.unique_filename)}`;
            document.getElementById('modal-fileurl').value = fileUrl;

            const previewContainer = document.getElementById('modal-preview');
            if (assetData.filetype.startsWith('image/')) {
                previewContainer.innerHTML = `<img src="${fileUrl}" class="max-w-full max-h-full object-contain">`;
            } else {
                previewContainer.innerHTML = `<img src="<?= BASE_URL ?>assets/icons/${get_icon_js(assetData.filetype)}" class="w-16 h-16">`;
            }

            modal.classList.remove('hidden');
            modal.classList.add('flex');
            setTimeout(() => modal.querySelector('.transform').classList.remove('scale-95'), 10);
        }

        // Pastikan listener global hanya dipasang SEKALI seumur hidup halaman
        if (!window.isAssetManagerListenerAttached) {
            document.body.addEventListener('click', (e) => {
                const button = e.target.closest('.view-details-btn');
                if (button) {
                    e.preventDefault();
                    const card = button.closest('.asset-card');
                    if (card && card.dataset.assetInfo) {
                        try {
                            const assetInfo = JSON.parse(card.dataset.assetInfo);
                            openModal(assetInfo);
                        } catch (err) {
                            console.error("Gagal parse data aset:", err);
                        }
                    }
                }
            });
            window.isAssetManagerListenerAttached = true;
        }

        function closeModal() {
            modal.querySelector('.transform').classList.add('scale-95');
            setTimeout(() => modal.classList.add('hidden'), 200);
        }

        closeModalBtn.addEventListener('click', closeModal);
        closeModalBtn2.addEventListener('click', closeModal);
        modal.addEventListener('click', (e) => {
            if (e.target === modal) closeModal();
        });

        // Fungsi utilitas JS
        function format_filesize_js(bytes) {
            if (bytes >= 1073741824) return (bytes / 1073741824).toFixed(2) + ' GB';
            if (bytes >= 1048576) return (bytes / 1048576).toFixed(2) + ' MB';
            if (bytes >= 1024) return (bytes / 1024).toFixed(2) + ' KB';
            return bytes + ' bytes';
        }

        function get_icon_js(filetype) {
            if (filetype.startsWith('video/')) return 'video.svg';
            if (filetype === 'application/pdf') return 'pdf.svg';
            if (filetype.includes('zip') || filetype.includes('rar')) return 'zip.svg';
            if (filetype.includes('word')) return 'document.svg';
            return 'file.svg';
        }

        // Copy URL
        document.getElementById('copy-url-btn').addEventListener('click', function() {
            const urlInput = document.getElementById('modal-fileurl');
            urlInput.select();
            document.execCommand('copy');
            this.textContent = 'Tersalin!';
            setTimeout(() => {
                this.textContent = 'Salin';
            }, 2000);
        });

        // Hapus File
        deleteBtn.addEventListener('click', async () => {
            if (!currentAssetId || !confirm('Apakah Anda yakin ingin menghapus file ini secara permanen?')) {
                return;
            }

            deleteBtn.disabled = true;
            deleteBtn.textContent = 'Menghapus...';

            const formData = new FormData();
            formData.append('action', 'delete');
            formData.append('id', currentAssetId);
            // Ambil token dari meta tag, sama seperti pada script upload
            formData.append('csrf_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

            try {
                const response = await fetch('assets-aksi.php', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });
                const result = await response.json();

                if (result.status === 'success') {
                    alert('File berhasil dihapus.');
                    window.location.reload();
                } else {
                    throw new Error(result.message);
                }
            } catch (error) {
                alert('Gagal menghapus file: ' + error.message);
                deleteBtn.disabled = false;
                deleteBtn.textContent = 'Hapus File';
            }
        });
    }

    // Panggil saat halaman dimuat pertama kali
    initAssetManager();
</script>

<?php include 'footer.php'; ?>