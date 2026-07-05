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

// PROSES TAMBAH & EDIT KELAS
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  validate_csrf_token();
  $action_type = $_POST['action_type'] ?? '';

  // Aksi Simpan (Insert/Update)
  if ($action_type === 'insert' || $action_type === 'update') {
    $id              = isset($_POST['id']) ? (int)$_POST['id'] : 0;
    $nama_kelas      = $_POST['nama_kelas'] ?? '';
    $mentor          = $_POST['mentor'] ?? '';
    $harga_kelas     = (int)($_POST['harga_kelas'] ?? 0);
    $kuota           = (int)($_POST['kuota'] ?? 0);
    $jadwal          = $_POST['jadwal'] ?? '';
    $deskripsi_kelas = $_POST['deskripsi_kelas'] ?? '';
    $gambar_url      = $_POST['gambar_url'] ?? '';
    $gambar_final    = $_POST['gambar_lama'] ?? "";

    $uploaded_file = handle_file_upload('gambar_upload', '', ['jpg', 'jpeg', 'png', 'webp'], 2097152, $_POST['gambar_lama'] ?? null);
    if ($uploaded_file) {
      $gambar_final = $uploaded_file;
    } elseif (!empty($gambar_url)) {
      $gambar_final = $gambar_url;
    }

    $stmt = null;
    if ($action_type === 'update' && $id > 0) {
      $stmt = mysqli_prepare($conn, "UPDATE kelas_menulis SET nama_kelas=?, mentor=?, harga_kelas=?, kuota=?, jadwal=?, deskripsi_kelas=?, gambar=? WHERE id=?");
      if ($stmt) mysqli_stmt_bind_param($stmt, 'ssiisssi', $nama_kelas, $mentor, $harga_kelas, $kuota, $jadwal, $deskripsi_kelas, $gambar_final, $id);
    } elseif ($action_type === 'insert') {
      $stmt = mysqli_prepare($conn, "INSERT INTO kelas_menulis (nama_kelas, mentor, harga_kelas, kuota, jadwal, deskripsi_kelas, gambar) VALUES (?, ?, ?, ?, ?, ?, ?)");
      if ($stmt) mysqli_stmt_bind_param($stmt, 'ssiisss', $nama_kelas, $mentor, $harga_kelas, $kuota, $jadwal, $deskripsi_kelas, $gambar_final);
    }

    if ($stmt && mysqli_stmt_execute($stmt)) {
      send_json_response('success', 'Data kelas berhasil disimpan.');
    } else {
      send_json_response('error', 'Terjadi kesalahan pada database.');
    }
  }

  // Aksi Hapus
  if (isset($_POST['hapus'])) {
    $id = (int)$_POST['hapus'];
    $stmt_select = mysqli_prepare($conn, "SELECT gambar FROM kelas_menulis WHERE id=?");
    mysqli_stmt_bind_param($stmt_select, 'i', $id);
    mysqli_stmt_execute($stmt_select);
    $res = mysqli_stmt_get_result($stmt_select);
    if ($res && $row = mysqli_fetch_assoc($res)) {
      if (!empty($row['gambar']) && !filter_var($row['gambar'], FILTER_VALIDATE_URL)) {
        @unlink('../uploads/' . $row['gambar']);
      }
    }
    $stmt_delete = mysqli_prepare($conn, "DELETE FROM kelas_menulis WHERE id=?");
    mysqli_stmt_bind_param($stmt_delete, 'i', $id);
    mysqli_stmt_execute($stmt_delete);
    header("Location: " . ADMIN_URL . "kelas");
    exit;
  }

  // Aksi Duplikat
  if (isset($_POST['duplikat'])) {
    $id = (int)$_POST['duplikat'];
    $stmt_cari = mysqli_prepare($conn, "SELECT * FROM kelas_menulis WHERE id = ?");
    mysqli_stmt_bind_param($stmt_cari, 'i', $id);
    mysqli_stmt_execute($stmt_cari);
    $cari_kelas = mysqli_stmt_get_result($stmt_cari);

    if ($cari_kelas && mysqli_num_rows($cari_kelas) === 1) {
      $kelas = mysqli_fetch_assoc($cari_kelas);
      // ... (logika duplikat yang sudah ada)
      $nama_kelas = $kelas['nama_kelas'] . ' (Salinan)';
      // ... (sisa logika)
      $stmt_insert = mysqli_prepare($conn, "INSERT INTO kelas_menulis (nama_kelas, mentor, harga_kelas, kuota, jadwal, deskripsi_kelas, gambar) VALUES (?, ?, ?, ?, ?, ?, ?)");
      mysqli_stmt_bind_param($stmt_insert, 'ssiisss', $nama_kelas, $kelas['mentor'], $kelas['harga_kelas'], $kelas['kuota'], $kelas['jadwal'], $kelas['deskripsi_kelas'], $kelas['gambar']);
      mysqli_stmt_execute($stmt_insert);
      mysqli_stmt_close($stmt_insert);
    }
    header("Location: " . ADMIN_URL . "kelas");
    exit;
  }
}
