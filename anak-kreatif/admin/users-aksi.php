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
// PROSES TAMBAH & EDIT ADMIN (POST METHOD)
// ==========================================
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  validate_csrf_token();
  $action_type = $_POST['action_type'] ?? '';
  $id          = isset($_POST['id']) ? (int)$_POST['id'] : 0;

  if ($action_type === 'update' && $id > 0) { // PROSES EDIT
    // PROSES EDIT
    $nama_lengkap = $_POST['nama_lengkap'];
    $password     = $_POST['password'];
    $avatar_final = $_POST['avatar_lama'] ?? null;

    $uploaded_avatar = handle_file_upload('avatar', 'avatars', ['jpg', 'jpeg', 'png', 'webp'], 2097152, $avatar_final);
    if ($uploaded_avatar) {
      $avatar_final = $uploaded_avatar;
    }

    if (!empty($password)) {
      $password_hash = password_hash($password, PASSWORD_DEFAULT);
      $sql = "UPDATE users_admin SET nama_lengkap = :nama, avatar = :avatar, password = :password WHERE id = :id";
      $stmt = $conn->prepare($sql);
      $stmt->execute([':nama' => $nama_lengkap, ':avatar' => $avatar_final, ':password' => $password_hash, ':id' => $id]);
    } else {
      $sql = "UPDATE users_admin SET nama_lengkap = :nama, avatar = :avatar WHERE id = :id";
      $stmt = $conn->prepare($sql);
      $stmt->execute([':nama' => $nama_lengkap, ':avatar' => $avatar_final, ':id' => $id]);
    }

    // Siapkan data respons dasar
    $response_data = [
      'status' => 'success',
      'message' => 'Data admin berhasil diperbarui.'
    ];

    // Jika admin yang diedit adalah admin yang sedang login, perbarui session namanya
    // dan kirim data baru ke frontend untuk pembaruan UI instan.
    if ($id === ($_SESSION['admin_id'] ?? null)) {
      $_SESSION['admin_name'] = $nama_lengkap;
      $response_data['new_admin_name'] = $nama_lengkap;
      if ($avatar_final) {
        $response_data['new_avatar_url'] = BASE_URL . 'uploads/avatars/' . $avatar_final;
      }
    }

    header('Content-Type: application/json');
    echo json_encode($response_data);
    exit;
  } elseif ($action_type === 'insert') { // PROSES TAMBAH
    // PROSES TAMBAH
    $username     = trim($_POST['username']);
    $nama_lengkap = $_POST['nama_lengkap'];
    $password     = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $avatar_final = null;
    $uploaded_avatar = handle_file_upload('avatar', 'avatars', ['jpg', 'jpeg', 'png', 'webp'], 2097152);
    if ($uploaded_avatar) $avatar_final = $uploaded_avatar;

    // VALIDASI PENGAMAN: Blokir pendaftaran jika username sudah ada yang sama
    $stmt_cek = $conn->prepare("SELECT id FROM users_admin WHERE username = :username");
    $stmt_cek->execute([':username' => $username]);
    if ($stmt_cek->fetch()) {
      send_json_response('error', "Username '$username' sudah digunakan. Silakan gunakan nama lain.");
    }

    $sql = "INSERT INTO users_admin (username, password, nama_lengkap, avatar) VALUES (:username, :password, :nama, :avatar)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':username' => $username, ':password' => $password, ':nama' => $nama_lengkap, ':avatar' => $avatar_final]);
    send_json_response('success', 'Admin baru berhasil ditambahkan.'); // PROSES HAPUS
  } elseif (isset($_POST['hapus'])) {
    $id_hapus = (int)$_POST['hapus'];

    // Ambil data username yang akan dihapus berdasarkan ID
    $stmt_cari = $conn->prepare("SELECT username FROM users_admin WHERE id = :id");
    $stmt_cari->execute([':id' => $id_hapus]);
    $user_data = $stmt_cari->fetch();
    if ($user_data) {
      $username_target = $user_data['username'];

      // Proteksi Keamanan: Mencegah admin menghapus akunnya sendiri yang sedang aktif digunakan
      if ($username_target === ($_SESSION['username_admin'] ?? '')) {
        // Menggunakan JSON response untuk error
        send_json_response('error', 'Gagal! Anda tidak bisa menghapus akun Anda sendiri.');
      }
    } else {
      send_json_response('error', 'User tidak ditemukan.');
    }

    // Proteksi Kuantitas: Pastikan jumlah admin tersisa di database minimal ada 1
    $stmt_total = $conn->query("SELECT COUNT(*) AS total FROM users_admin");
    $total_admin = $stmt_total->fetchColumn();
    if ($total_admin <= 1) {
      send_json_response('error', 'Gagal! Tidak boleh menghapus admin terakhir pada sistem.');
    }

    $stmt_hapus = $conn->prepare("DELETE FROM users_admin WHERE id = :id");
    $stmt_hapus->execute([':id' => $id_hapus]);
    send_json_response('success', 'Admin berhasil dihapus.');
  }
}
