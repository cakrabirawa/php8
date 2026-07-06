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
      $stmt_cek_kat = $conn->prepare("SELECT id FROM kategori_produk WHERE id = :id AND is_active = 1 LIMIT 1");
      $stmt_cek_kat->execute([':id' => $kategori_id]);
      if ($stmt_cek_kat->fetchColumn() === false) {
        $kategori_id = null;
      }
    }
    // Validasi klasifikasi
    if (!is_null($klasifikasi_id)) {
      $stmt_cek_klas = $conn->prepare("SELECT id FROM klasifikasi_produk WHERE id = :id AND is_active = 1 LIMIT 1");
      $stmt_cek_klas->execute([':id' => $klasifikasi_id]);
      if ($stmt_cek_klas->fetchColumn() === false) {
        $klasifikasi_id = null;
      }
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
      $sql = "UPDATE produk_buku SET judul=:judul, penulis=:penulis, harga=:harga, stok=:stok, deskripsi=:deskripsi, gambar=:gambar, kategori_id=:kategori_id, klasifikasi_id=:klasifikasi_id WHERE id=:id";
      $stmt = $conn->prepare($sql);
      $stmt->execute([
        ':judul' => $judul,
        ':penulis' => $penulis,
        ':harga' => $harga,
        ':stok' => $stok,
        ':deskripsi' => $deskripsi,
        ':gambar' => $gambar_final,
        ':kategori_id' => $kategori_id,
        ':klasifikasi_id' => $klasifikasi_id,
        ':id' => $id
      ]);
    } else {
      // INSERT
      $sql = "INSERT INTO produk_buku (judul, penulis, harga, stok, deskripsi, gambar, kategori_id, klasifikasi_id) 
              VALUES (:judul, :penulis, :harga, :stok, :deskripsi, :gambar, :kategori_id, :klasifikasi_id)";
      $stmt = $conn->prepare($sql);
      $stmt->execute([
        ':judul' => $judul,
        ':penulis' => $penulis,
        ':harga' => $harga,
        ':stok' => $stok,
        ':deskripsi' => $deskripsi,
        ':gambar' => $gambar_final,
        ':kategori_id' => $kategori_id,
        ':klasifikasi_id' => $klasifikasi_id
      ]);
    }
    send_json_response('success', 'Data buku berhasil disimpan.');
  }

  // PROSES HAPUS BUKU (AJAX)
  elseif (isset($_POST['hapus'])) {
    $id = (int)$_POST['hapus'];
    $stmt_select = $conn->prepare("SELECT gambar FROM produk_buku WHERE id=:id");
    $stmt_select->execute([':id' => $id]);
    $row = $stmt_select->fetch();
    if ($row) {
      if (!empty($row['gambar']) && !filter_var($row['gambar'], FILTER_VALIDATE_URL)) {
        @unlink('../uploads/' . $row['gambar']);
      }
    }
    $stmt_delete = $conn->prepare("DELETE FROM produk_buku WHERE id=:id");
    $stmt_delete->execute([':id' => $id]);
    send_json_response('success', 'Buku berhasil dihapus.');
  }

  // PROSES DUPLIKAT DATA BUKU (AJAX)
  elseif (isset($_POST['duplikat'])) {
    $id = (int)$_POST['duplikat'];
    $stmt_cari = $conn->prepare("SELECT * FROM produk_buku WHERE id = :id");
    $stmt_cari->execute([':id' => $id]);
    $buku = $stmt_cari->fetch();
    if ($buku) {

      $judul     = $buku['judul'] . ' (Salinan)';
      // ... (sisa logika duplikat)
      $sql = "INSERT INTO produk_buku (judul, penulis, harga, stok, deskripsi, gambar, kategori_id, klasifikasi_id) VALUES (:judul, :penulis, :harga, :stok, :deskripsi, :gambar, :kategori_id, :klasifikasi_id)";
      $stmt_insert = $conn->prepare($sql);
      $stmt_insert->execute([
        ':judul' => $judul,
        ':penulis' => $buku['penulis'],
        ':harga' => $buku['harga'],
        ':stok' => $buku['stok'],
        ':deskripsi' => $buku['deskripsi'],
        ':gambar' => $buku['gambar'],
        ':kategori_id' => $buku['kategori_id'],
        ':klasifikasi_id' => $buku['klasifikasi_id']
      ]);
    }
    send_json_response('success', 'Buku berhasil diduplikasi.');
  } else {
    send_json_response('error', 'Aksi pada buku tidak dikenali.');
  }
}
