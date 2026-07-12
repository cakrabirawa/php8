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
    $nama = trim($_POST['nama'] ?? '');
    $is_active = isset($_POST['is_active']) ? 1 : 0;

    if (empty($nama)) {
      send_json_response('error', 'Nama kategori tidak boleh kosong.');
    }

    $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $nama)));

    if ($action === 'insert') {
      $sql = "INSERT INTO kategori_produk (nama, slug, is_active) VALUES (:nama, :slug, :is_active)";
      $stmt = $conn->prepare($sql);
      $stmt->execute([':nama' => $nama, ':slug' => $slug, ':is_active' => $is_active]);
    } elseif ($action === 'update' && $id > 0) {
      $sql = "UPDATE kategori_produk SET nama=:nama, slug=:slug, is_active=:is_active WHERE id=:id";
      $stmt = $conn->prepare($sql);
      $stmt->execute([':nama' => $nama, ':slug' => $slug, ':is_active' => $is_active, ':id' => $id]);
    }
    send_json_response('success', 'Data kategori berhasil disimpan.');
  }

  // Aksi Toggle Status
  if (isset($_POST['toggle_status'])) {
    $id = (int)$_POST['toggle_status'];
    $status = (int)$_POST['status'];
    $new = ($status === 1) ? 0 : 1;
    $stmt = $conn->prepare("UPDATE kategori_produk SET is_active=:status WHERE id=:id");
    $stmt->execute([':status' => $new, ':id' => $id]);
    if ($new === 0) {
      $stmt_update_buku = $conn->prepare("UPDATE produk_buku SET kategori_id = NULL WHERE kategori_id = :id");
      $stmt_update_buku->execute([':id' => $id]);
    }
    send_json_response('success', 'Status kategori berhasil diubah.');
  }

  // Aksi Hapus
  if (isset($_POST['hapus'])) {
    $id = (int)$_POST['hapus'];
    // set produk_buku kategori_id to NULL if any
    $stmt_update = $conn->prepare("UPDATE produk_buku SET kategori_id = NULL WHERE kategori_id = :id");
    $stmt_update->execute([':id' => $id]);
    $stmt_delete = $conn->prepare("DELETE FROM kategori_produk WHERE id=:id");
    $stmt_delete->execute([':id' => $id]);
    header("Location: " . ADMIN_URL . "categories");
    exit;
  }
}
