<?php
require_once '../config/database.php';

if (!isset($_SESSION['login_admin'])) {
  header("Location: " . ADMIN_URL . "login");
  exit;
}

function send_json_response($status, $message)
{
  header('Content-Type: application/json');
  echo json_encode(['status' => $status, 'message' => $message]);
  exit;
}

// PROSES SIMPAN (INSERT / UPDATE)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  validate_csrf_token();

  // Aksi Simpan (Insert/Update)
  if (isset($_POST['action_type'])) {
    $action = $_POST['action_type'];
    $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
    $nama = mysqli_real_escape_string($conn, trim($_POST['nama'] ?? ''));
    $is_active = isset($_POST['is_active']) ? 1 : 0;

    if (empty($nama)) {
      send_json_response('error', 'Nama kategori tidak boleh kosong.');
    }

    if ($action === 'insert') {
      $stmt = mysqli_prepare($conn, "INSERT INTO kategori_produk (nama, slug, is_active) VALUES (?, ?, ?)");
      $slug_temp = 'temp_' . uniqid();
      if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'ssi', $nama, $slug_temp, $is_active);
        mysqli_stmt_execute($stmt);
        $new_id = mysqli_insert_id($conn);
        $stmt_slug = mysqli_prepare($conn, "UPDATE kategori_produk SET slug = ? WHERE id = ?");
        mysqli_stmt_bind_param($stmt_slug, 'ii', $new_id, $new_id);
        mysqli_stmt_execute($stmt_slug);
      }
    } elseif ($action === 'update' && $id > 0) {
      $stmt = mysqli_prepare($conn, "UPDATE kategori_produk SET nama=?, is_active=? WHERE id=?");
      mysqli_stmt_bind_param($stmt, 'sii', $nama, $is_active, $id);
      mysqli_stmt_execute($stmt);
    }
    send_json_response('success', 'Data kategori berhasil disimpan.');
  }

  // Aksi Toggle Status
  if (isset($_POST['toggle_status'])) {
    $id = (int)$_POST['toggle_status'];
    $status = (int)$_POST['status'];
    $new = ($status === 1) ? 0 : 1;
    $stmt = mysqli_prepare($conn, "UPDATE kategori_produk SET is_active=? WHERE id=?");
    mysqli_stmt_bind_param($stmt, 'ii', $new, $id);
    mysqli_stmt_execute($stmt);
    if ($new === 0) {
      $stmt_update_buku = mysqli_prepare($conn, "UPDATE produk_buku SET kategori_id = NULL WHERE kategori_id = ?");
      mysqli_stmt_bind_param($stmt_update_buku, 'i', $id);
      mysqli_stmt_execute($stmt_update_buku);
    }
    send_json_response('success', 'Status kategori berhasil diubah.');
  }

  // Aksi Hapus
  if (isset($_POST['hapus'])) {
    $id = (int)$_POST['hapus'];
    // set produk_buku kategori_id to NULL if any
    $stmt_update = mysqli_prepare($conn, "UPDATE produk_buku SET kategori_id = NULL WHERE kategori_id = ?");
    mysqli_stmt_bind_param($stmt_update, 'i', $id);
    mysqli_stmt_execute($stmt_update);
    $stmt_delete = mysqli_prepare($conn, "DELETE FROM kategori_produk WHERE id=?");
    mysqli_stmt_bind_param($stmt_delete, 'i', $id);
    mysqli_stmt_execute($stmt_delete);
    header("Location: " . ADMIN_URL . "categories");
    exit;
  }
}
