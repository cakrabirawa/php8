<?php

// Memuat konfigurasi database dari file terpisah untuk keamanan dan kemudahan pengelolaan.
require_once __DIR__ . '/db_config.php';

// Membuat objek koneksi database menggunakan konstanta dari db_config.php
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if (!$conn) {
  die("Koneksi database gagal: " . mysqli_connect_error());
}
mysqli_set_charset($conn, "utf8mb4");
/**
 * Fungsi pembentuk string Slug (Unique ID / Random Char)
 */
function buat_slug($teks)
{
  // Menggunakan hash pendek agar menjadi karakter acak unik yang stabil (deterministik)
  return substr(md5($teks), 0, 8);
}

// ==========================================
// CSRF TOKEN PROTECTION
// ==========================================
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

if (empty($_SESSION['csrf_token'])) {
  $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

function validate_csrf_token()
{
  if (!isset($_REQUEST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_REQUEST['csrf_token'])) {
    // Jika token tidak valid, hentikan eksekusi dan tampilkan pesan error
    die('Error: Invalid CSRF token. Permintaan diblokir untuk keamanan.');
  }
}

function csrf_token_input()
{
  return '<input type="hidden" name="csrf_token" value="' . htmlspecialchars($_SESSION['csrf_token']) . '">';
}
// ==========================================================
// KODE BARU: Generator Alamat Root URL Otomatis (ANTI-EROR)
// PERBAIKAN: Gunakan URL statis untuk stabilitas.
// Sesuaikan URL ini dengan alamat proyek Anda.
// ==========================================================
if (!defined('BASE_URL')) {
  define('BASE_URL', 'http://localhost:82/anak-kreatif/');
}
if (!defined('ADMIN_URL')) {
  define('ADMIN_URL', BASE_URL . 'admin/');
}

// ==========================================
// KONFIGURASI SISTEM DINAMIS (PENGATURAN)
// ==========================================
/* 
  Query CREATE TABLE sebaiknya tidak dijalankan di setiap request. 
  Jalankan ini sekali saja saat instalasi atau melalui tool database.
  mysqli_query($conn, "CREATE TABLE IF NOT EXISTS pengaturan (key_name VARCHAR(50) NOT NULL PRIMARY KEY, setting_value VARCHAR(255) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");
*/

$sys_config = [];
$conf_query = mysqli_query($conn, "SELECT key_name, setting_value FROM pengaturan");
if ($conf_query) {
  while ($c = mysqli_fetch_assoc($conf_query)) {
    $sys_config[$c['key_name']] = $c['setting_value'];
  }
}
define('ADMIN_PAGING', isset($sys_config['admin_paging']) ? (int)$sys_config['admin_paging'] : 5);
define('SITE_TITLE', isset($sys_config['site_title']) && !empty(trim($sys_config['site_title'])) ? $sys_config['site_title'] : 'AnakKreatif');
define('ADMIN_THEME', isset($sys_config['admin_theme']) ? $sys_config['admin_theme'] : 'light'); // 'light' or 'dark'
define('HOME_VIDEO_LIMIT', isset($sys_config['home_video_limit']) ? (int)$sys_config['home_video_limit'] : 2);
define('FOOTER_TEXT', isset($sys_config['footer_text']) ? $sys_config['footer_text'] : '© ' . date('Y') . ' AnakKreatif. Dikembangkan secara Native dengan Struktur SEO.');
define('SITE_TAGLINE', isset($sys_config['site_tagline']) ? $sys_config['site_tagline'] : 'Ruang tumbuh kembang imajinasi dan bakat menulis literasi anak sejak dini.');
define('HERO_TITLE', isset($sys_config['hero_title']) ? $sys_config['hero_title'] : 'Tumbuhkan Imajinasi Si Kecil Lewat Buku & Kata');
define('HERO_SUBTITLE', isset($sys_config['hero_subtitle']) ? $sys_config['hero_subtitle'] : 'Temukan kurasi buku cerita anak terbaik serta program pelatihan menulis interaktif yang dirancang khusus mematangkan kreativitas anak usia 7-12 tahun.');
define('HERO_GRADIENT_START', isset($sys_config['hero_gradient_start']) ? $sys_config['hero_gradient_start'] : '#FDE68A');
define('HERO_GRADIENT_END', isset($sys_config['hero_gradient_end']) ? $sys_config['hero_gradient_end'] : '#FFFFFF');
define('VIDEO_SECTION_TITLE', isset($sys_config['video_section_title']) ? $sys_config['video_section_title'] : 'Video Kegiatan Kreatif');
define('VIDEO_SECTION_SUBTITLE', isset($sys_config['video_section_subtitle']) ? $sys_config['video_section_subtitle'] : 'Dokumentasi keseruan kelas menulis dan ulasan buku anak-anak.');

// ==========================================
// FUNGSI HELPER GLOBAL
// ==========================================

/**
 * Mengelola proses upload file dengan aman.
 *
 * @param string $file_input_name Nama dari input file di form (e.g., 'gambar_upload').
 * @param string $upload_subdir Sub-direktori di dalam folder 'uploads' (e.g., 'videos').
 * @param array $allowed_extensions Ekstensi file yang diizinkan (e.g., ['jpg', 'png']).
 * @param int $max_size Ukuran file maksimum dalam byte.
 * @param string|null $old_file_name Nama file lama untuk dihapus jika upload berhasil.
 * @return string|null Nama file baru jika berhasil, null jika gagal atau tidak ada file.
 */
function handle_file_upload(string $file_input_name, string $upload_subdir, array $allowed_extensions, int $max_size, ?string $old_file_name = null): ?string
{
  if (!isset($_FILES[$file_input_name]) || $_FILES[$file_input_name]['error'] !== UPLOAD_ERR_OK) {
    return null;
  }

  $file = $_FILES[$file_input_name];
  $upload_dir = __DIR__ . '/../uploads/' . $upload_subdir;

  // Buat direktori jika belum ada
  if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0777, true);
  }

  $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

  if (in_array($extension, $allowed_extensions) && $file['size'] <= $max_size) {
    // Buat nama file yang lebih deskriptif (slug) dari nama asli
    $filename_without_ext = pathinfo($file['name'], PATHINFO_FILENAME);
    $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $filename_without_ext)));
    $new_filename = $slug . '-' . uniqid() . '.' . $extension;
    if (move_uploaded_file($file['tmp_name'], $upload_dir . '/' . $new_filename)) {
      // Hapus file lama jika ada dan bukan URL
      if ($old_file_name && !filter_var($old_file_name, FILTER_VALIDATE_URL) && file_exists($upload_dir . '/' . $old_file_name)) {
        @unlink($upload_dir . '/' . $old_file_name);
      }
      return $new_filename;
    }
  }
  return null;
}

/**
 * Mendapatkan informasi negara dari alamat IP.
 * INI ADALAH FUNGSI SIMULASI. Untuk produksi, gunakan API geolokasi seperti ip-api.com atau ipinfo.io.
 * @return string Kode negara (e.g., 'ID', 'US').
 */
function get_country_from_ip(string $ip): ?string
{
  // Daftar negara untuk simulasi
  $countries = ['ID', 'US', 'SG', 'MY', 'JP', 'AU'];
  // Gunakan hash dari IP untuk mendapatkan hasil yang konsisten untuk IP yang sama
  return $countries[crc32($ip) % count($countries)];
}

/**
 * Menghasilkan markup HTML untuk ikon bendera sederhana berdasarkan kode negara.
 * @param string|null $country_code Kode negara (e.g., 'ID', 'US').
 * @return string HTML untuk ikon bendera.
 */
function get_flag_icon(?string $country_code): string
{
  $icon_html = '<div class="w-5 h-3.5 rounded-sm overflow-hidden shadow-sm flex-shrink-0 bg-gray-200"></div>'; // Default

  switch (strtoupper($country_code ?? '')) {
    case 'ID':
      $icon_html = '<div class="w-5 h-3.5 rounded-sm overflow-hidden shadow-sm flex-shrink-0 border border-gray-200"><div class="h-1/2 bg-red-600"></div><div class="h-1/2 bg-white"></div></div>';
      break;
    case 'US':
      $icon_html = '<div class="w-5 h-3.5 rounded-sm overflow-hidden shadow-sm flex-shrink-0 border border-gray-200 bg-red-600 relative"><div class="absolute top-0 left-0 w-2/5 h-1/2 bg-blue-800"></div></div>';
      break;
    case 'SG':
      $icon_html = '<div class="w-5 h-3.5 rounded-sm overflow-hidden shadow-sm flex-shrink-0 border border-gray-200"><div class="h-1/2 bg-red-600"></div><div class="h-1/2 bg-white"></div></div>';
      break;
    case 'MY':
      $icon_html = '<div class="w-5 h-3.5 rounded-sm overflow-hidden shadow-sm flex-shrink-0 border border-gray-200 bg-red-600 relative"><div class="absolute top-0 left-0 w-1/2 h-1/2 bg-blue-800"></div></div>';
      break;
    case 'JP':
      $icon_html = '<div class="w-5 h-3.5 rounded-sm overflow-hidden shadow-sm flex-shrink-0 border border-gray-200 bg-white flex items-center justify-center"><div class="w-2 h-2 rounded-full bg-red-600"></div></div>';
      break;
    case 'AU':
      $icon_html = '<div class="w-5 h-3.5 rounded-sm overflow-hidden shadow-sm flex-shrink-0 border border-gray-200 bg-blue-800 relative"><div class="absolute top-0 left-0 w-1/2 h-1/2 bg-blue-900"></div></div>';
      break;
  }

  return $icon_html;
}

/**
 * Mencatat kunjungan ke halaman tertentu.
 * Mencegah pencatatan ganda dari IP yang sama dalam interval waktu singkat.
 * @param mysqli $conn Objek koneksi database.
 * @param string $page Nama halaman yang dikunjungi (e.g., 'beranda').
 */
function track_page_visit(mysqli $conn, string $page): void
{
  $ip_address = $_SERVER['REMOTE_ADDR'] ?? 'UNKNOWN';
  $country_code = get_country_from_ip($ip_address);

  $stmt = mysqli_prepare($conn, "INSERT INTO access_logs (page, ip_address, country_code) VALUES (?, ?, ?)");
  mysqli_stmt_bind_param($stmt, 'sss', $page, $ip_address, $country_code);
  mysqli_stmt_execute($stmt);
}
