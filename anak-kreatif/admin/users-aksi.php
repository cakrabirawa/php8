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
      $stmt = mysqli_prepare($conn, "UPDATE users_admin SET nama_lengkap = ?, avatar = ?, password = ? WHERE id = ?");
      mysqli_stmt_bind_param($stmt, 'sssi', $nama_lengkap, $avatar_final, $password_hash, $id);
    } else {
      $stmt = mysqli_prepare($conn, "UPDATE users_admin SET nama_lengkap = ?, avatar = ? WHERE id = ?");
      mysqli_stmt_bind_param($stmt, 'ssi', $nama_lengkap, $avatar_final, $id);
    }
    mysqli_stmt_execute($stmt);

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
    $stmt_cek = mysqli_prepare($conn, "SELECT id FROM users_admin WHERE username = ?");
    mysqli_stmt_bind_param($stmt_cek, 's', $username);
    mysqli_stmt_execute($stmt_cek);
    mysqli_stmt_store_result($stmt_cek);
    if (mysqli_stmt_num_rows($stmt_cek) > 0) {
      send_json_response('error', "Username '$username' sudah digunakan. Silakan gunakan nama lain.");
    }

    $stmt = mysqli_prepare($conn, "INSERT INTO users_admin (username, password, nama_lengkap, avatar) VALUES (?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, 'ssss', $username, $password, $nama_lengkap, $avatar_final);
    mysqli_stmt_execute($stmt);
    send_json_response('success', 'Admin baru berhasil ditambahkan.'); // PROSES HAPUS
  } elseif (isset($_POST['hapus'])) {
    $id_hapus = (int)$_POST['hapus'];

    // Ambil data username yang akan dihapus berdasarkan ID
    $stmt_cari = mysqli_prepare($conn, "SELECT username FROM users_admin WHERE id = ?");
    mysqli_stmt_bind_param($stmt_cari, 'i', $id_hapus);
    mysqli_stmt_execute($stmt_cari);
    $cari_user = mysqli_stmt_get_result($stmt_cari);
    if ($cari_user && mysqli_num_rows($cari_user) === 1) {
      $user_data = mysqli_fetch_assoc($cari_user);
      $username_target = $user_data['username'];

      // Proteksi Keamanan: Mencegah admin menghapus akunnya sendiri yang sedang aktif digunakan
      if ($username_target === ($_SESSION['username_admin'] ?? '')) {
        // Menggunakan JSON response untuk error
        send_json_response('error', 'Gagal! Anda tidak bisa menghapus akun Anda sendiri.');
      }
    } else {
      // Redirect jika user tidak ditemukan, karena ini bukan dari form AJAX
      header("Location: " . ADMIN_URL . "users");
      exit;
    }

    // Proteksi Kuantitas: Pastikan jumlah admin tersisa di database minimal ada 1
    $res_total = mysqli_query($conn, "SELECT COUNT(*) AS total FROM users_admin");
    $total_admin = mysqli_fetch_assoc($res_total)['total'];
    if ($total_admin <= 1) {
      send_json_response('error', 'Gagal! Tidak boleh menghapus admin terakhir pada sistem.');
    }

    $stmt_hapus = mysqli_prepare($conn, "DELETE FROM users_admin WHERE id = ?");
    mysqli_stmt_bind_param($stmt_hapus, 'i', $id_hapus);
    mysqli_stmt_execute($stmt_hapus);
    // Redirect setelah hapus berhasil
    header("Location: " . ADMIN_URL . "users");
    exit;
  }
}
