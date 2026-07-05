document.addEventListener('DOMContentLoaded', () => {
  // ==========================================
  // LOGIKA NAVIGASI MENU RESPONSIF MOBILE
  // ==========================================
  const menuToggle = document.getElementById('menu-toggle');
  const mobileMenu = document.getElementById('mobile-menu');
  const iconOpen = document.getElementById('menu-icon-open');
  const iconClose = document.getElementById('menu-icon-close');

  if (menuToggle && mobileMenu && iconOpen && iconClose) {
    menuToggle.addEventListener('click', () => {
      const isMenuHidden = mobileMenu.classList.toggle('hidden');
      if (isMenuHidden) {
        iconOpen.classList.remove('hidden');
        iconClose.classList.add('hidden');
      } else {
        iconOpen.classList.add('hidden');
        iconClose.classList.remove('hidden');
      }
    });

    window.addEventListener('resize', () => {
      if (window.innerWidth >= 768) {
        mobileMenu.classList.add('hidden');
        iconOpen.classList.remove('hidden');
        iconClose.classList.add('hidden');
      }
    });
  }

  // ==========================================
  // LOGIKA SWITCH MODE TERANG / GELAP (BARU)
  // ==========================================
  const btnToggleDesktop = document.getElementById('theme-toggle');
  const btnToggleMobile = document.getElementById('theme-toggle-mobile');

  function gantiTema() {
    // Cek apakah elemen html saat ini sudah mengandung class 'dark'
    if (document.documentElement.classList.contains('dark')) {
      // Ubah ke mode terang
      document.documentElement.classList.remove('dark');
      localStorage.setItem('theme', 'light');
    } else {
      // Ubah ke mode gelap
      document.documentElement.classList.add('dark');
      localStorage.setItem('theme', 'dark');
    }
  }

  // Pasang event klik pada tombol desktop jika tersedia
  if (btnToggleDesktop) {
    btnToggleDesktop.addEventListener('click', gantiTema);
  }

  // Pasang event klik pada tombol mobile jika tersedia
  if (btnToggleMobile) {
    btnToggleMobile.addEventListener('click', gantiTema);
  }
});

/**
 * Fungsi global utilitas pesan layanan belanja/daftar
 */
function pesanLayanan(tipe, id) {
  alert(`Terima kasih! Permintaan pemesanan ${tipe} (ID: ${id}) sedang diproses. Admin kami akan segera menghubungi Anda.`);
}
