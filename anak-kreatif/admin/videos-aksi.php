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

  // Aksi Hapus Video
  if (isset($_POST['hapus'])) {
    $id = (int)$_POST['hapus'];
    $stmt = mysqli_prepare($conn, "SELECT tipe_sumber, tautan_video FROM videos WHERE id=?");
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);

    if ($res && $row = mysqli_fetch_assoc($res)) {
      if ($row['tipe_sumber'] === 'upload' && !empty($row['tautan_video'])) {
        $path = '../uploads/videos/' . $row['tautan_video'];
        if (file_exists($path)) {
          @unlink($path);
        }
      }
      $stmt_delete = mysqli_prepare($conn, "DELETE FROM videos WHERE id=?");
      mysqli_stmt_bind_param($stmt_delete, 'i', $id);
      mysqli_stmt_execute($stmt_delete);
    }
    // Untuk aksi hapus, kita redirect halaman karena tidak ada notifikasi yang diperlukan
    header("Location: " . ADMIN_URL . "videos");
    exit;
  }

  // Aksi Simpan (Insert/Update) Video
  $action_type = $_POST['action_type'] ?? '';
  if ($action_type === 'insert' || $action_type === 'update') {
    $id          = isset($_POST['id']) ? (int)$_POST['id'] : 0;
    $judul_video = mysqli_real_escape_string($conn, trim($_POST['judul_video']));
    $tipe_sumber = mysqli_real_escape_string($conn, $_POST['tipe_sumber']);
    $t_youtube   = mysqli_real_escape_string($conn, trim($_POST['tautan_youtube']));
    $tautan_final = $_POST['tautan_lama'] ?? "";

    if ($tipe_sumber === 'upload') {
      $uploaded_video = handle_file_upload('video_upload', 'videos', ['mp4'], 52428800, ($_POST['tipe_lama'] ?? '') === 'upload' ? $_POST['tautan_lama'] : null);
      if ($uploaded_video) {
        $tautan_final = $uploaded_video;
      }
    } else {
      if (!empty($t_youtube)) {
        if ($action_type === 'update' && ($_POST['tipe_lama'] ?? '') === 'upload' && !empty($_POST['tautan_lama'])) {
          handle_file_upload('video_upload', 'videos', [], 0, $_POST['tautan_lama']);
        }
        $tautan_final = $t_youtube;
      }
    }

    if (empty($tautan_final)) {
      send_json_response('error', 'Gagal! Konten video belum terisi.');
    }

    $stmt = null;
    if ($action_type === 'update' && $id > 0) {
      $stmt = mysqli_prepare($conn, "UPDATE videos SET judul_video=?, tipe_sumber=?, tautan_video=? WHERE id=?");
      if ($stmt) mysqli_stmt_bind_param($stmt, 'sssi', $judul_video, $tipe_sumber, $tautan_final, $id);
    } elseif ($action_type === 'insert') {
      $stmt = mysqli_prepare($conn, "INSERT INTO videos (judul_video, tipe_sumber, tautan_video) VALUES (?, ?, ?)");
      if ($stmt) mysqli_stmt_bind_param($stmt, 'sss', $judul_video, $tipe_sumber, $tautan_final);
    }

    if ($stmt && mysqli_stmt_execute($stmt)) {
      send_json_response('success', 'Data video berhasil disimpan.');
    } else {
      send_json_response('error', 'Terjadi kesalahan pada database.');
    }
  } elseif (isset($_POST['toggle_status'])) {
    // Aksi Toggle Status
    $id = (int)$_POST['toggle_status'];
    $status_sekarang = (int)$_POST['status'];
    $status_baru = ($status_sekarang === 1) ? 0 : 1;

    $stmt = mysqli_prepare($conn, "UPDATE videos SET is_active = ? WHERE id = ?");
    if ($stmt) {
      mysqli_stmt_bind_param($stmt, 'ii', $status_baru, $id);
      mysqli_stmt_execute($stmt);
      send_json_response('success', 'Status video berhasil diubah.');
    }
  } else {
    // Fallback for any other POST request that isn't a known action
    send_json_response('error', 'Aksi tidak dikenali oleh server.');
  }
}
