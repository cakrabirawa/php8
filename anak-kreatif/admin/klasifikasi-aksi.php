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

// PROSES SIMPAN DATA (INSERT & UPDATE)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  validate_csrf_token();

  // Aksi Simpan (Insert/Update)
  if (isset($_POST['action_type'])) {
    $action_type  = $_POST['action_type'];
    $id           = isset($_POST['id']) ? (int)$_POST['id'] : 0;
    $nama         = mysqli_real_escape_string($conn, $_POST['nama']);
    $is_active    = isset($_POST['is_active']) ? 1 : 0;

    if ($action_type === 'update' && $id > 0) {
      $stmt = mysqli_prepare($conn, "UPDATE klasifikasi_produk SET nama=?, is_active=? WHERE id=?");
      mysqli_stmt_bind_param($stmt, 'sii', $nama, $is_active, $id);
      mysqli_stmt_execute($stmt);
    } elseif ($action_type === 'insert') {
      $stmt = mysqli_prepare($conn, "INSERT INTO klasifikasi_produk (nama, slug, is_active) VALUES (?, ?, ?)");
      if ($stmt) {
        $slug_temp = 'temp_' . uniqid();
        mysqli_stmt_bind_param($stmt, 'ssi', $nama, $slug_temp, $is_active);
        mysqli_stmt_execute($stmt);
        $new_id = mysqli_insert_id($conn);
        $stmt_slug = mysqli_prepare($conn, "UPDATE klasifikasi_produk SET slug = ? WHERE id = ?");
        mysqli_stmt_bind_param($stmt_slug, 'ii', $new_id, $new_id);
        mysqli_stmt_execute($stmt_slug);
      }
    }
    send_json_response('success', 'Data klasifikasi berhasil disimpan.');
  }

  // Aksi Toggle Status
  if (isset($_POST['toggle_status'])) {
    $id = (int)$_POST['toggle_status'];
    $status = (int)$_POST['status'];
    $new = ($status === 1) ? 0 : 1;
    $stmt = mysqli_prepare($conn, "UPDATE klasifikasi_produk SET is_active=? WHERE id=?");
    mysqli_stmt_bind_param($stmt, 'ii', $new, $id);
    mysqli_stmt_execute($stmt);

    if ($new === 0) {
      $stmt_update = mysqli_prepare($conn, "UPDATE produk_buku SET klasifikasi_id = NULL WHERE klasifikasi_id = ?");
      mysqli_stmt_bind_param($stmt_update, 'i', $id);
      mysqli_stmt_execute($stmt_update);
    }
    send_json_response('success', 'Status klasifikasi berhasil diubah.');
  }

  // Aksi Hapus
  if (isset($_POST['hapus'])) {
    $id = (int)$_POST['hapus'];
    // lepaskan produk yang terkait
    $stmt_update = mysqli_prepare($conn, "UPDATE produk_buku SET klasifikasi_id = NULL WHERE klasifikasi_id = ?");
    mysqli_stmt_bind_param($stmt_update, 'i', $id);
    mysqli_stmt_execute($stmt_update);
    $stmt_delete = mysqli_prepare($conn, "DELETE FROM klasifikasi_produk WHERE id=?");
    mysqli_stmt_bind_param($stmt_delete, 'i', $id);
    mysqli_stmt_execute($stmt_delete);
    header("Location: " . ADMIN_URL . "klasifikasi");
    exit;
  }
}
