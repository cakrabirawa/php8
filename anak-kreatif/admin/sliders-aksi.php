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

// ==========================================
// PROSES SIMPAN DATA (INSERT & UPDATE)
// ==========================================
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  validate_csrf_token();

  // Aksi Simpan (Insert/Update)
  if (isset($_POST['action_type'])) {
    $action_type  = $_POST['action_type'];
    $id           = isset($_POST['id']) ? (int)$_POST['id'] : 0;
    $judul_slider = $_POST['judul_slider'] ?? '';
    $gambar_url   = $_POST['gambar_url'] ?? '';
    $is_active    = isset($_POST['is_active']) ? 1 : 0;
    $gambar_final = $_POST['gambar_lama'] ?? "";

    $uploaded_file = handle_file_upload('gambar_upload', '', ['jpg', 'jpeg', 'png', 'webp'], 2097152, $_POST['gambar_lama'] ?? null);
    if ($uploaded_file) {
      $gambar_final = $uploaded_file;
    } elseif (!empty($gambar_url)) {
      handle_file_upload('gambar_upload', '', [], 0, $_POST['gambar_lama'] ?? null);
      $gambar_final = $gambar_url;
    }

    $stmt = null;
    if ($action_type === 'update' && $id > 0) {
      $stmt = mysqli_prepare($conn, "UPDATE sliders SET judul_slider=?, gambar=?, is_active=? WHERE id=?");
      if ($stmt) mysqli_stmt_bind_param($stmt, 'ssii', $judul_slider, $gambar_final, $is_active, $id);
    } elseif ($action_type === 'insert' && !empty($gambar_final)) {
      $stmt = mysqli_prepare($conn, "INSERT INTO sliders (judul_slider, gambar, is_active) VALUES (?, ?, ?)");
      if ($stmt) mysqli_stmt_bind_param($stmt, 'ssi', $judul_slider, $gambar_final, $is_active);
    }

    if ($stmt && mysqli_stmt_execute($stmt)) {
      send_json_response('success', 'Data slider berhasil disimpan.');
    } else {
      send_json_response('error', 'Gagal memproses data slider! Pastikan gambar terisi.');
    }
  }

  // Aksi Toggle Status
  if (isset($_POST['toggle_status'])) {
    $id = (int)$_POST['toggle_status'];
    $status_sekarang = (int)$_POST['status'];
    $status_baru = ($status_sekarang === 1) ? 0 : 1;

    $stmt = mysqli_prepare($conn, "UPDATE sliders SET is_active = ? WHERE id = ?");
    mysqli_stmt_bind_param($stmt, 'ii', $status_baru, $id);
    mysqli_stmt_execute($stmt);
    send_json_response('success', 'Status slider berhasil diubah.');
  }

  // Aksi Hapus
  if (isset($_POST['hapus'])) {
    $id = (int)$_POST['hapus'];
    $stmt_select = mysqli_prepare($conn, "SELECT gambar FROM sliders WHERE id=?");
    mysqli_stmt_bind_param($stmt_select, 'i', $id);
    mysqli_stmt_execute($stmt_select);
    $res = mysqli_stmt_get_result($stmt_select);
    if ($res && $row = mysqli_fetch_assoc($res)) {
      if (!empty($row['gambar']) && !filter_var($row['gambar'], FILTER_VALIDATE_URL)) {
        $path_file = '../uploads/' . $row['gambar'];
        if (file_exists($path_file)) @unlink($path_file);
      }
      $stmt_delete = mysqli_prepare($conn, "DELETE FROM sliders WHERE id=?");
      mysqli_stmt_bind_param($stmt_delete, 'i', $id);
      mysqli_stmt_execute($stmt_delete);
    }
    header("Location: " . ADMIN_URL . "sliders");
    exit;
  }
}
