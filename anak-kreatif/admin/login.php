<?php
require_once '../config/database.php';

// Jika sudah login, langsung lempar ke dashboard admin
if (isset($_SESSION['login_admin'])) {
  header("Location: " . ADMIN_URL);
  exit;
}

$error_msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  validate_csrf_token();

  // 1. Validasi Captcha Slider
  if (!isset($_POST['captcha_response']) || $_POST['captcha_response'] !== 'verified') {
    $error_msg = "Silakan geser slider untuk verifikasi.";
  } else {
    // 2. Lanjutkan validasi login jika captcha benar
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Gunakan prepared statement untuk keamanan
    $stmt = $conn->prepare("SELECT * FROM users_admin WHERE username = :username");
    $stmt->execute([':username' => $username]);

    if ($stmt->rowCount() === 1) {
      $row = $stmt->fetch();

      // Verifikasi password menggunakan password_verify()
      if (password_verify($password, $row['password'])) {
        // Set session sukses login dan daftarkan info krusial
        $_SESSION['login_admin']    = true;
        $_SESSION['username_admin'] = $row['username']; // Untuk validasi hapus diri sendiri
        $_SESSION['admin_name']     = $row['nama_lengkap'];
        $_SESSION['admin_id']       = $row['id']; // ID untuk link edit profil
        // Kembalikan respons JSON untuk ditangani oleh AJAX
        header('Content-Type: application/json');
        echo json_encode(['status' => 'success', 'message' => 'Login berhasil!', 'redirect' => ADMIN_URL]);
        exit;
      } else {
        $error_msg = "Username atau password salah!";
      }
    } else {
      $error_msg = "Username atau password salah!";
    }
  }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <title>Login Pengelola - <?= htmlspecialchars(SITE_TITLE); ?></title>
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Google Fonts Poppins -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
    }

    /* --- Style untuk Slider Captcha --- */
    #captcha-container {
      background-color: #f0f0f0;
      border-radius: 8px;
      padding: 5px;
      text-align: center;
      position: relative;
      overflow: hidden;
      user-select: none;
      cursor: default;
    }

    #captcha-track {
      height: 40px;
      background-color: #e0e0e0;
      border-radius: 4px;
      position: relative;
    }

    #captcha-thumb {
      width: 50px;
      height: 100%;
      background-color: #fff;
      border: 1px solid #ccc;
      border-radius: 4px;
      position: absolute;
      top: 0;
      left: 0;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.2rem;
      transition: background-color 0.3s;
    }

    #captcha-text {
      position: absolute;
      left: 50%;
      top: 50%;
      transform: translate(-50%, -50%);
      color: #757575;
      font-weight: 600;
      pointer-events: none;
    }

    #captcha-container.captcha-success #captcha-track {
      background-color: #4caf50;
    }

    #captcha-container.captcha-success #captcha-thumb {
      background-color: #fff;
      cursor: default;
    }

    #captcha-container.captcha-success #captcha-text {
      color: #fff;
    }
  </style>
</head>

<body class="bg-amber-50 dark:bg-zinc-900 h-screen flex items-center justify-center px-4">
  <div class="bg-white dark:bg-zinc-800 p-8 rounded-2xl shadow-xl border dark:border-zinc-700 w-full max-w-md">
    <div class="text-center mb-6">
      <span class="text-4xl">⚙️</span>
      <h1 class="text-2xl font-black text-gray-800 dark:text-zinc-100 mt-2">Login Admin</h1>
      <p class="text-sm text-gray-500 dark:text-zinc-400">Panel Kontrol <?= htmlspecialchars(SITE_TITLE); ?></p>
    </div>

    <?php if (!empty($error_msg)) : ?>
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl text-sm mb-4 dark:bg-red-500/10 dark:border-red-500/30 dark:text-red-300">
        <?= htmlspecialchars($error_msg); ?>
      </div>
    <?php endif; ?>

    <form action="" method="POST" class="space-y-4 text-sm ajax-form">
      <div>
        <?= csrf_token_input(); ?>
        <label class="block font-semibold text-gray-700 mb-1 dark:text-zinc-200">Username</label>
        <input type="text" name="username" required class="w-full p-3 border rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-400 dark:bg-zinc-700 dark:border-zinc-600 dark:text-zinc-100">
      </div>
      <div>
        <label class="block font-semibold text-gray-700 mb-1 dark:text-zinc-200">Password</label>
        <input type="password" name="password" required class="w-full p-3 border rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-400 dark:bg-zinc-700 dark:border-zinc-600 dark:text-zinc-100">
      </div>

      <!-- Slider Captcha -->
      <div id="captcha-container" class="mt-4 dark:bg-zinc-700">
        <div id="captcha-track">
          <div id="captcha-thumb">»</div>
          <div id="captcha-text">Geser untuk verifikasi</div>
        </div>
      </div>
      <input type="hidden" name="captcha_response" id="captcha-response" value="">

      <button type="submit" class="w-full bg-gradient-to-r from-orange-500 to-red-500 text-white font-bold py-3 rounded-xl shadow-md hover:opacity-90 transition">
        Masuk ke Dashboard
      </button>
    </form>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const thumb = document.getElementById('captcha-thumb');
      const track = document.getElementById('captcha-track');
      const container = document.getElementById('captcha-container');
      const text = document.getElementById('captcha-text');
      const responseInput = document.getElementById('captcha-response');

      let isDragging = false;
      let startX = 0;
      let offsetX = 0;

      const startDrag = (e) => {
        if (container.classList.contains('captcha-success')) return;
        isDragging = true;
        startX = e.type === 'touchstart' ? e.touches[0].clientX : e.clientX;
        thumb.style.transition = 'none';
        document.addEventListener('mousemove', onDrag);
        document.addEventListener('touchmove', onDrag);
        document.addEventListener('mouseup', endDrag);
        document.addEventListener('touchend', endDrag);
      };

      const onDrag = (e) => {
        if (!isDragging) return;
        e.preventDefault();
        const currentX = e.type === 'touchmove' ? e.touches[0].clientX : e.clientX;
        let moveX = currentX - startX;
        const maxMove = track.offsetWidth - thumb.offsetWidth;

        if (moveX < 0) moveX = 0;
        if (moveX > maxMove) moveX = maxMove;

        thumb.style.left = `${moveX}px`;
      };

      const endDrag = (e) => {
        if (!isDragging) return;
        isDragging = false;
        thumb.style.transition = 'left 0.3s';
        const maxMove = track.offsetWidth - thumb.offsetWidth;
        if (parseInt(thumb.style.left) >= maxMove - 5) { // Toleransi 5px
          thumb.style.left = `${maxMove}px`;
          container.classList.add('captcha-success');
          text.textContent = 'Verifikasi Berhasil';
          thumb.innerHTML = '✓';
          responseInput.value = 'verified';
        } else {
          thumb.style.left = '0px';
        }
        document.removeEventListener('mousemove', onDrag);
        document.removeEventListener('touchmove', onDrag);
      };

      thumb.addEventListener('mousedown', startDrag);
      thumb.addEventListener('touchstart', startDrag);
    });
  </script>

  <!-- Load required scripts for AJAX and SPA transition -->
  <script src="<?= BASE_URL; ?>assets/js/admin-ajax.js"></script>
</body>

</html>