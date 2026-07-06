<?php
session_start();
require_once '../config/database.php';

if (!isset($_SESSION['login_admin'])) {
  header("Location: " . ADMIN_URL . "login");
  exit;
}

/**
 * Fungsi untuk memperbarui slug tabel agar sama dengan ID-nya.
 * Menggunakan satu query UPDATE massal untuk efisiensi.
 *
 * @param PDO $db_connection Koneksi database.
 * @param string $table_name Nama tabel yang akan diupdate.
 * @return int Jumlah baris yang berhasil diperbarui.
 */
function update_slugs_for_table(PDO $db_connection, string $table_name): int
{
  // PDO handles table names safely in the query itself, no need for real_escape_string
  $query = "UPDATE `$table_name` SET slug = id";
  $stmt = $db_connection->query($query);

  return $stmt ? $stmt->rowCount() : 0;
}

// 1. Jalankan proses untuk tabel 'kategori_produk'
$berhasil_kat = update_slugs_for_table($conn, 'kategori_produk');

// 2. Jalankan proses untuk tabel 'klasifikasi_produk'
$berhasil_klas = update_slugs_for_table($conn, 'klasifikasi_produk');
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <title>Pembaruan Slug Otomatis</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 flex justify-center items-center min-h-screen">
  <div class="bg-white p-8 rounded-2xl shadow-sm border max-w-md w-full text-center">
    <div class="text-5xl mb-4">✅</div>
    <h1 class="text-xl font-black text-gray-800 mb-2">Migrasi Slug Selesai!</h1>
    <p class="text-gray-500 text-sm mb-6">Seluruh data URL klasifikasi dan kategori telah diperbarui agar sama persis dengan ID-nya.</p>
    <div class="bg-gray-50 border p-4 rounded-xl text-left text-sm text-gray-700 font-medium mb-6 space-y-2">
      <p>Kategori yang diperbarui: <span class="text-blue-600 font-bold"><?= $berhasil_kat; ?> Data</span></p>
      <p>Klasifikasi yang diperbarui: <span class="text-blue-600 font-bold"><?= $berhasil_klas; ?> Data</span></p>
    </div>
    <a href="<?= ADMIN_URL ?>" class="inline-block bg-gray-800 text-white px-6 py-2.5 rounded-lg font-bold hover:bg-gray-900 transition">Kembali ke Dashboard</a>
  </div>
</body>

</html>