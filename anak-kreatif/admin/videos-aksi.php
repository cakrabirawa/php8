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
    $stmt = $conn->prepare("SELECT tipe_sumber, tautan_video FROM videos WHERE id=:id");
    $stmt->execute([':id' => $id]);
    $row = $stmt->fetch();

    if ($row) {
      if ($row['tipe_sumber'] === 'upload' && !empty($row['tautan_video'])) {
        $path = '../uploads/videos/' . $row['tautan_video'];
        if (file_exists($path)) {
          @unlink($path);
        }
      }
      $stmt_delete = $conn->prepare("DELETE FROM videos WHERE id=:id");
      $stmt_delete->execute([':id' => $id]);
    }
    // Untuk aksi hapus, kita redirect halaman karena tidak ada notifikasi yang diperlukan
    header("Location: " . ADMIN_URL . "videos");
    exit;
  }

  // Aksi Simpan (Insert/Update) Video
  $action_type = $_POST['action_type'] ?? '';
  if ($action_type === 'insert' || $action_type === 'update') {
    $id          = isset($_POST['id']) ? (int)$_POST['id'] : 0;
    $judul_video = trim($_POST['judul_video']);
    $tipe_sumber = $_POST['tipe_sumber'];
    $t_youtube   = trim($_POST['tautan_youtube']);
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

    if ($action_type === 'update' && $id > 0) {
      $sql = "UPDATE videos SET judul_video=:judul, tipe_sumber=:tipe, tautan_video=:tautan WHERE id=:id";
      $stmt = $conn->prepare($sql);
      $stmt->execute([':judul' => $judul_video, ':tipe' => $tipe_sumber, ':tautan' => $tautan_final, ':id' => $id]);
    } elseif ($action_type === 'insert') {
      $sql = "INSERT INTO videos (judul_video, tipe_sumber, tautan_video) VALUES (:judul, :tipe, :tautan)";
      $stmt = $conn->prepare($sql);
      $stmt->execute([':judul' => $judul_video, ':tipe' => $tipe_sumber, ':tautan' => $tautan_final]);
    }

    send_json_response('success', 'Data video berhasil disimpan.');
  } elseif (isset($_POST['toggle_status'])) {
    // Aksi Toggle Status
    $id = (int)$_POST['toggle_status'];
    $status_sekarang = (int)$_POST['status'];
    $status_baru = ($status_sekarang === 1) ? 0 : 1;

    $stmt = $conn->prepare("UPDATE videos SET is_active = :status WHERE id = :id");
    $stmt->execute([':status' => $status_baru, ':id' => $id]);
    send_json_response('success', 'Status video berhasil diubah.');
  } else {
    // Fallback for any other POST request that isn't a known action
    send_json_response('error', 'Aksi tidak dikenali oleh server.');
  }
}
