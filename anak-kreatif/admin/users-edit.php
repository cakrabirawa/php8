<?php
require_once '../config/database.php';

if (!isset($_SESSION['login_admin'])) {
  header("Location: " . ADMIN_URL . "login");
  exit;
}

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$stmt = $conn->prepare("SELECT * FROM users_admin WHERE id = :id");
$stmt->execute([':id' => $id]);
$user = $stmt->fetch();
if (!$user) {
  header("Location: " . ADMIN_URL . "users");
  exit;
}
?>
<?php include 'header.php'; ?>

<div class="w-full">
  <div class="mb-6">
    <h1 class="text-2xl font-black text-gray-800 dark:text-zinc-100">📝 Edit Akun Pengelola</h1>
    <p class="text-gray-500 mt-1 dark:text-zinc-400">Mengubah nama pengguna atau kata sandi pengelola.</p>
  </div>

  <div class="bg-white p-6 rounded-2xl shadow-sm border w-full dark:bg-zinc-900 dark:border-zinc-700">
    <form action="<?= ADMIN_URL ?>users-aksi" method="POST" class="space-y-3 ajax-form" data-redirect-url="<?= ADMIN_URL ?>users">
      <?= csrf_token_input(); ?>
      <input type="hidden" name="action_type" value="update">
      <input type="hidden" name="id" value="<?= $user['id']; ?>">
      <input type="hidden" name="avatar_lama" value="<?= $user['avatar']; ?>">

      <div class="flex items-center gap-4">
        <?php if (!empty($user['avatar']) && file_exists('../uploads/avatars/' . $user['avatar'])) : ?>
          <img src="../uploads/avatars/<?= htmlspecialchars($user['avatar']); ?>" alt="Avatar" class="w-16 h-16 rounded-full object-cover border-2 border-white shadow-md">
        <?php else : ?>
          <div class="w-16 h-16 rounded-full bg-blue-100 flex flex-shrink-0 items-center justify-center text-blue-600 font-bold text-2xl border-2 border-white shadow-md dark:bg-blue-500/20 dark:text-blue-300">
            <?= strtoupper(substr($user['nama_lengkap'] ?? 'A', 0, 1)); ?>
          </div>
        <?php endif; ?>
        <div class="flex-grow">
          <label class="block font-semibold mb-1 dark:text-zinc-200">Ganti Foto Profil (Opsional)</label>
          <input type="file" name="avatar" accept="image/*" class="w-full text-sm file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-blue-500/10 dark:file:text-blue-300 dark:hover:file:bg-blue-500/20">
        </div>
      </div>

      <div>
        <label class="block font-medium mb-1 dark:text-zinc-200">Username (Tidak Dapat Diubah)</label>
        <!-- PERBAIKAN: Ditambahkan atribut readonly dan styling disabled -->
        <input type="text" name="username" value="<?= htmlspecialchars($user['username']); ?>" readonly class="w-full p-2 border rounded-md bg-gray-100 text-gray-500 cursor-not-allowed font-semibold focus:outline-none dark:bg-zinc-800 dark:border-zinc-700 dark:text-zinc-400">
      </div>

      <div>
        <label class="block font-medium mb-1 dark:text-zinc-200">Nama Lengkap</label>
        <input type="text" name="nama_lengkap" value="<?= htmlspecialchars($user['nama_lengkap']); ?>" required class="w-full p-2 border rounded-md focus:ring-1 focus:ring-blue-500 focus:outline-none dark:bg-zinc-800 dark:border-zinc-600 dark:text-zinc-100">
      </div>

      <div class="bg-amber-50 p-2.5 rounded-lg border border-amber-200 dark:bg-amber-500/10 dark:border-amber-500/20">
        <label class="block font-medium mb-1 text-amber-800 dark:text-amber-300">Password Baru (Opsional)</label>
        <input type="password" name="password" placeholder="Isi hanya jika ingin ganti password" class="w-full p-2 border bg-white rounded-md focus:ring-1 focus:ring-blue-500 focus:outline-none dark:bg-zinc-700 dark:border-zinc-600">
        <p class="text-[10px] text-amber-600 mt-1 dark:text-amber-400">*Kosongkan jika tidak ingin mengubah kata sandi lama.</p>
      </div>

      <div class="flex gap-2 pt-2 font-semibold">
        <button type="submit" class="flex-grow bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 transition">Simpan</button>
        <a href="<?= ADMIN_URL ?>users" class="spa-trigger bg-gray-200 text-gray-700 py-2 px-4 rounded-md hover:bg-gray-300 text-center dark:bg-zinc-700 dark:text-zinc-200 dark:hover:bg-zinc-600">Batal</a>
      </div>
    </form>
  </div>
</div>
<?php include 'footer.php'; ?>