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
  $id          = isset($_POST['id']) ? (int)$_POST['id'] : 0;

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

  // ==========================================
  // PROSES HAPUS KELAS (AJAX)
  // ==========================================
  elseif ($action_type === 'delete' && $id > 0) {
    $stmt_select = $conn->prepare("SELECT gambar FROM kelas_menulis WHERE id=:id");
    $stmt_select->execute([':id' => $id]);
    $row = $stmt_select->fetch();
    if ($row && !empty($row['gambar']) && !filter_var($row['gambar'], FILTER_VALIDATE_URL)) {
      @unlink('../uploads/' . $row['gambar']);
    }
    $stmt_delete = $conn->prepare("DELETE FROM kelas_menulis WHERE id=:id");
    $stmt_delete->execute([':id' => $id]);
    send_json_response('success', 'Data kelas berhasil dihapus. Halaman akan dimuat ulang.');
  }

  // ==========================================
  // PROSES SALIN / DUPLIKAT KELAS (AJAX)
  // ==========================================
  elseif ($action_type === 'copy' && $id > 0) {
    // 1. Ambil data asli dari kelas yang akan disalin
    $stmt_source = $conn->prepare("SELECT * FROM kelas_menulis WHERE id = :id");
    $stmt_source->execute([':id' => $id]);
    $source_data = $stmt_source->fetch(PDO::FETCH_ASSOC);

    if ($source_data) {
      // 2. Siapkan data baru dengan menambahkan "(Salinan)" pada nama
      $new_nama = $source_data['nama_kelas'] . ' (Salinan)';

      // 3. Masukkan data baru sebagai baris baru di database
      $sql = "INSERT INTO kelas_menulis (nama_kelas, deskripsi_kelas, mentor, jadwal, kuota, harga_kelas, gambar) 
                 VALUES (:nama, :deskripsi, :mentor, :jadwal, :kuota, :harga, :gambar)";
      $stmt_insert = $conn->prepare($sql);
      $stmt_insert->execute([
        ':nama' => $new_nama,
        ':deskripsi' => $source_data['deskripsi_kelas'],
        ':mentor' => $source_data['mentor'],
        ':jadwal' => $source_data['jadwal'],
        ':kuota' => $source_data['kuota'],
        ':harga' => $source_data['harga_kelas'],
        ':gambar' => $source_data['gambar']
      ]);
      send_json_response('success', 'Kelas berhasil disalin. Halaman akan dimuat ulang.');
    } else {
      send_json_response('error', 'Data sumber untuk disalin tidak ditemukan.');
    }
  }
}
