<?php
require_once '../config/database.php';

if (!isset($_SESSION['login_admin'])) {
  header("Location: " . ADMIN_URL . "login");
  exit;
}
?>
<?php include 'header.php'; ?>

<div class="w-full">
  <div class="mb-6">
    <h1 class="text-2xl font-black text-gray-800 dark:text-zinc-100">➕ Tambah Admin Baru</h1>
    <p class="text-gray-500 mt-1 dark:text-zinc-400">Daftarkan akses pengelola baru.</p>
  </div>

  <div class="bg-white p-6 rounded-xl shadow-sm border dark:bg-zinc-900 dark:border-zinc-700">
    <form action="<?= ADMIN_URL ?>users-aksi" method="POST" class="space-y-4 ajax-form" data-redirect-url="<?= ADMIN_URL ?>users">
      <?= csrf_token_input(); ?>
      <input type="hidden" name="action_type" value="insert">
      <div>
        <label class="block font-semibold mb-1 dark:text-zinc-200">Username</label>
        <input type="text" name="username" required class="w-full p-2 border rounded-md dark:bg-zinc-800 dark:border-zinc-600 dark:text-zinc-100">
      </div>
      <div>
        <label class="block font-semibold mb-1 dark:text-zinc-200">Nama Lengkap</label>
        <input type="text" name="nama_lengkap" required class="w-full p-2 border rounded-md dark:bg-zinc-800 dark:border-zinc-600 dark:text-zinc-100">
      </div>
      <div>
        <label class="block font-semibold mb-1 dark:text-zinc-200">Password</label>
        <input type="password" name="password" required class="w-full p-2 border rounded-md dark:bg-zinc-800 dark:border-zinc-600 dark:text-zinc-100">
      </div>
      <div>
        <label class="block font-semibold mb-1 dark:text-zinc-200">Foto Profil (Opsional)</label>
        <input type="file" name="avatar" accept="image/*" class="w-full text-sm file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-blue-500/10 dark:file:text-blue-300 dark:hover:file:bg-blue-500/20">
      </div>
      <div class="flex gap-2">
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded font-bold hover:bg-blue-700">Daftarkan Admin</button>
        <a href="<?= ADMIN_URL ?>users" class="bg-gray-100 px-4 py-2 rounded font-bold text-gray-700 hover:bg-gray-200 dark:bg-zinc-700 dark:text-zinc-200 dark:hover:bg-zinc-600">Batal</a>
      </div>
    </form>
  </div>
</div>

<?php include 'footer.php'; ?>