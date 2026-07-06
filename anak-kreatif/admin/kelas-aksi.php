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

    if ($action_type === 'update' && $id > 0) {
      $sql = "UPDATE kelas_menulis SET nama_kelas=:nama_kelas, mentor=:mentor, harga_kelas=:harga_kelas, kuota=:kuota, jadwal=:jadwal, deskripsi_kelas=:deskripsi_kelas, gambar=:gambar WHERE id=:id";
      $stmt = $conn->prepare($sql);
      $stmt->execute([
        ':nama_kelas' => $nama_kelas,
        ':mentor' => $mentor,
        ':harga_kelas' => $harga_kelas,
        ':kuota' => $kuota,
        ':jadwal' => $jadwal,
        ':deskripsi_kelas' => $deskripsi_kelas,
        ':gambar' => $gambar_final,
        ':id' => $id
      ]);
    } elseif ($action_type === 'insert') {
      $sql = "INSERT INTO kelas_menulis (nama_kelas, mentor, harga_kelas, kuota, jadwal, deskripsi_kelas, gambar) VALUES (:nama_kelas, :mentor, :harga_kelas, :kuota, :jadwal, :deskripsi_kelas, :gambar)";
      $stmt = $conn->prepare($sql);
      $stmt->execute([
        ':nama_kelas' => $nama_kelas,
        ':mentor' => $mentor,
        ':harga_kelas' => $harga_kelas,
        ':kuota' => $kuota,
        ':jadwal' => $jadwal,
        ':deskripsi_kelas' => $deskripsi_kelas,
        ':gambar' => $gambar_final
      ]);
    }

    send_json_response('success', 'Data kelas berhasil disimpan.');
  }

  // Aksi Hapus
  if (isset($_POST['hapus'])) {
    $id = (int)$_POST['hapus'];
    $stmt_select = $conn->prepare("SELECT gambar FROM kelas_menulis WHERE id=:id");
    $stmt_select->execute([':id' => $id]);
    $row = $stmt_select->fetch();
    if ($row) {
      if (!empty($row['gambar']) && !filter_var($row['gambar'], FILTER_VALIDATE_URL)) {
        @unlink('../uploads/' . $row['gambar']);
      }
    }
    $stmt_delete = $conn->prepare("DELETE FROM kelas_menulis WHERE id=:id");
    $stmt_delete->execute([':id' => $id]);
    header("Location: " . ADMIN_URL . "kelas");
    exit;
  }

  // Aksi Duplikat
  if (isset($_POST['duplikat'])) {
    $id = (int)$_POST['duplikat'];
    $stmt_cari = $conn->prepare("SELECT * FROM kelas_menulis WHERE id = :id");
    $stmt_cari->execute([':id' => $id]);
    $kelas = $stmt_cari->fetch();

    if ($kelas) {
      // ... (logika duplikat yang sudah ada)
      $nama_kelas = $kelas['nama_kelas'] . ' (Salinan)';
      // ... (sisa logika)
      $sql = "INSERT INTO kelas_menulis (nama_kelas, mentor, harga_kelas, kuota, jadwal, deskripsi_kelas, gambar) VALUES (:nama_kelas, :mentor, :harga_kelas, :kuota, :jadwal, :deskripsi_kelas, :gambar)";
      $stmt_insert = $conn->prepare($sql);
      $stmt_insert->execute([
        ':nama_kelas' => $nama_kelas,
        ':mentor' => $kelas['mentor'],
        ':harga_kelas' => $kelas['harga_kelas'],
        ':kuota' => $kelas['kuota'],
        ':jadwal' => $kelas['jadwal'],
        ':deskripsi_kelas' => $kelas['deskripsi_kelas'],
        ':gambar' => $kelas['gambar']
      ]);
    }
    header("Location: " . ADMIN_URL . "kelas");
    exit;
  }
}
