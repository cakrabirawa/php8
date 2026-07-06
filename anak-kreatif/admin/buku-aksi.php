<?php
require_once '../config/database.php';

if (empty($_SESSION['login_admin'])) {
  header("Location: " . ADMIN_URL . "login");
  exit;
}

function send_json_response($status, $message)
{
  header('Content-Type: application/json');
  echo json_encode(['status' => $status, 'message' => $message]);
  exit;
}

// PROSES TAMBAH & EDIT BUKU
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  validate_csrf_token();

  // Aksi Simpan (Insert/Update)
  if (isset($_POST['action_type']) && ($_POST['action_type'] === 'insert' || $_POST['action_type'] === 'update')) {
    $id             = isset($_POST['id']) ? (int)$_POST['id'] : 0;
    $judul          = $_POST['judul'] ?? '';
    $penulis        = $_POST['penulis'] ?? '';
    $harga          = (int)($_POST['harga'] ?? 0);
    $stok           = (int)($_POST['stok'] ?? 0);
    $deskripsi      = $_POST['deskripsi'] ?? '';
    $gambar_url     = $_POST['gambar_url'] ?? '';
    $kategori_id = (isset($_POST['kategori_id']) && $_POST['kategori_id'] !== '') ? (int)$_POST['kategori_id'] : null;
    $klasifikasi_id = (isset($_POST['klasifikasi_id']) && $_POST['klasifikasi_id'] !== '') ? (int)$_POST['klasifikasi_id'] : null;

    // Validasi: pastikan kategori_id merujuk ke kategori aktif; jika tidak, set ke null
    if (!is_null($kategori_id)) {
      $stmt_cek_kat = mysqli_prepare($conn, "SELECT id FROM kategori_produk WHERE id = ? AND is_active = 1 LIMIT 1");
      mysqli_stmt_bind_param($stmt_cek_kat, 'i', $kategori_id);
      mysqli_stmt_execute($stmt_cek_kat);
      mysqli_stmt_store_result($stmt_cek_kat);
      if (mysqli_stmt_num_rows($stmt_cek_kat) === 0) {
        $kategori_id = null;
      }
      mysqli_stmt_close($stmt_cek_kat);
    }
    // Validasi klasifikasi
    if (!is_null($klasifikasi_id)) {
      $stmt_cek_klas = mysqli_prepare($conn, "SELECT id FROM klasifikasi_produk WHERE id = ? AND is_active = 1 LIMIT 1");
      mysqli_stmt_bind_param($stmt_cek_klas, 'i', $klasifikasi_id);
      mysqli_stmt_execute($stmt_cek_klas);
      mysqli_stmt_store_result($stmt_cek_klas);
      if (mysqli_stmt_num_rows($stmt_cek_klas) === 0) {
        $klasifikasi_id = null;
      }
      mysqli_stmt_close($stmt_cek_klas);
    }

    $gambar_final = isset($_POST['gambar_lama']) ? $_POST['gambar_lama'] : "";

    // Gunakan fungsi upload terpusat
    $uploaded_file = handle_file_upload('gambar_upload', '', ['jpg', 'jpeg', 'png', 'webp'], 2097152, $_POST['gambar_lama'] ?? null);
    if ($uploaded_file) {
      $gambar_final = $uploaded_file;
    } elseif (!empty($gambar_url)) {
      $gambar_final = $gambar_url;
    }

    if ($id > 0) {
      // UPDATE
      $stmt = mysqli_prepare($conn, "UPDATE produk_buku SET judul=?, penulis=?, harga=?, stok=?, deskripsi=?, gambar=?, kategori_id=?, klasifikasi_id=? WHERE id=?");
      if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'ssiissssi', $judul, $penulis, $harga, $stok, $deskripsi, $gambar_final, $kategori_id, $klasifikasi_id, $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
      }
    } else {
      // INSERT
      $stmt = mysqli_prepare($conn, "INSERT INTO produk_buku (judul, penulis, harga, stok, deskripsi, gambar, kategori_id, klasifikasi_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
      if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'ssiissss', $judul, $penulis, $harga, $stok, $deskripsi, $gambar_final, $kategori_id, $klasifikasi_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
      }
    }
    send_json_response('success', 'Data buku berhasil disimpan.');
  }

  // PROSES HAPUS BUKU (AJAX)
  elseif (isset($_POST['hapus'])) {
    $id = (int)$_POST['hapus'];
    $stmt_select = mysqli_prepare($conn, "SELECT gambar FROM produk_buku WHERE id=?");
    mysqli_stmt_bind_param($stmt_select, 'i', $id);
    mysqli_stmt_execute($stmt_select);
    $res = mysqli_stmt_get_result($stmt_select);
    if ($res && $row = mysqli_fetch_assoc($res)) {
      if (!empty($row['gambar']) && !filter_var($row['gambar'], FILTER_VALIDATE_URL)) {
        @unlink('../uploads/' . $row['gambar']);
      }
    }
    $stmt_delete = mysqli_prepare($conn, "DELETE FROM produk_buku WHERE id=?");
    mysqli_stmt_bind_param($stmt_delete, 'i', $id);
    mysqli_stmt_execute($stmt_delete);
    send_json_response('success', 'Buku berhasil dihapus.');
  }

  // PROSES DUPLIKAT DATA BUKU (AJAX)
  elseif (isset($_POST['duplikat'])) {
    $id = (int)$_POST['duplikat'];
    $stmt_cari = mysqli_prepare($conn, "SELECT * FROM produk_buku WHERE id = ?");
    mysqli_stmt_bind_param($stmt_cari, 'i', $id);
    mysqli_stmt_execute($stmt_cari);
    $cari_buku = mysqli_stmt_get_result($stmt_cari);
    if ($cari_buku && mysqli_num_rows($cari_buku) === 1) {
      $buku = mysqli_fetch_assoc($cari_buku);

      $judul     = $buku['judul'] . ' (Salinan)';
      // ... (sisa logika duplikat)
      $stmt_insert = mysqli_prepare($conn, "INSERT INTO produk_buku (judul, penulis, harga, stok, deskripsi, gambar, kategori_id, klasifikasi_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
      mysqli_stmt_bind_param($stmt_insert, 'ssiissss', $judul, $buku['penulis'], $buku['harga'], $buku['stok'], $buku['deskripsi'], $buku['gambar'], $buku['kategori_id'], $buku['klasifikasi_id']);
      mysqli_stmt_execute($stmt_insert);
      mysqli_stmt_close($stmt_insert);
    }
    send_json_response('success', 'Buku berhasil diduplikasi.');
  } else {
    send_json_response('error', 'Aksi pada buku tidak dikenali.');
  }
}
