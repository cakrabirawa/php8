document.addEventListener("DOMContentLoaded", () => {
  /**
   * Menampilkan notifikasi di bagian atas halaman.
   * @param {string} status 'success' atau 'error'
   * @param {string} message Pesan yang akan ditampilkan
   */
  const showNotification = (status, message) => {
    const container = document.getElementById("notification-container");
    if (!container) return;

    const color =
      status === "success"
        ? "bg-emerald-50 text-emerald-700 border-emerald-200"
        : "bg-red-50 text-red-700 border-red-200";
    const notification = document.createElement("div");
    notification.className = `p-4 mb-4 rounded-lg border font-semibold text-sm transition-opacity duration-300 ${color}`;
    notification.textContent = message;

    container.appendChild(notification);

    // Hapus notifikasi setelah 5 detik
    setTimeout(() => {
      notification.style.opacity = "0";
      setTimeout(() => notification.remove(), 300);
    }, 5000);
  };

  /**
   * Menangani pengiriman form secara asinkron.
   * @param {HTMLFormElement} form Elemen form yang di-submit
   */
  const handleAjaxFormSubmit = async (form) => {
    const submitButton = form.querySelector('button[type="submit"]');
    const originalButtonText = submitButton.innerHTML;
    submitButton.disabled = true;
    submitButton.innerHTML = "Menyimpan...";

    try {
      const formData = new FormData(form);
      const response = await fetch(form.action, {
        method: "POST",
        body: formData,
        headers: {
          "X-Requested-With": "XMLHttpRequest", // Header untuk identifikasi AJAX di server
        },
      });

      if (!response.ok) {
        throw new Error(`HTTP error! Status: ${response.status}`);
      }

      const result = await response.json();

      if (result.status === "success") {
        showNotification("success", result.message || "Operasi berhasil!");

        // --- PEMBARUAN UI INSTAN SETELAH UPDATE PROFIL ---
        if (result.new_avatar_url) {
          const headerAvatar = document.getElementById("header-avatar-img");
          const sidebarAvatar = document.getElementById("sidebar-avatar-img");
          const profilePageAvatar = document.getElementById(
            "profile-page-avatar-img",
          );
          if (headerAvatar) headerAvatar.src = result.new_avatar_url;
          if (sidebarAvatar) sidebarAvatar.src = result.new_avatar_url;
          if (profilePageAvatar) profilePageAvatar.src = result.new_avatar_url;
        }
        if (result.new_admin_name) {
          const headerName = document.getElementById("header-admin-name");
          const sidebarName = document.getElementById("sidebar-admin-name");
          const dropdownName = document.getElementById("dropdown-admin-name");
          const initialHeader = document.getElementById(
            "header-avatar-initial",
          );
          const initialSidebar = document.getElementById(
            "sidebar-avatar-initial",
          );
          const profilePageInitial = document.getElementById(
            "profile-page-avatar-initial",
          );
          if (headerName) headerName.textContent = result.new_admin_name;
          if (sidebarName) sidebarName.textContent = result.new_admin_name;
          if (dropdownName) dropdownName.textContent = result.new_admin_name;
          if (initialHeader)
            initialHeader.textContent = result.new_admin_name
              .charAt(0)
              .toUpperCase();
          if (initialSidebar)
            initialSidebar.textContent = result.new_admin_name
              .charAt(0)
              .toUpperCase();
          if (profilePageInitial)
            profilePageInitial.textContent = result.new_admin_name
              .charAt(0)
              .toUpperCase();
        }

        // --- BLOK LOGIKA SETELAH SUKSES ---
        // 1. Handle redirect dari server (misal: setelah login)
        if (result.redirect) {
          setTimeout(() => (window.location.href = result.redirect), 1000);
          return; // Hentikan eksekusi, karena akan redirect
        }
        // 2. Handle redirect dari atribut form (misal: setelah simpan data)
        // Diubah agar menggunakan SPA load, bukan full refresh
        if (form.dataset.redirectUrl) {
          setTimeout(() => {
            loadAdminPage(form.dataset.redirectUrl);
          }, 1500);
          return; // Hentikan eksekusi, karena akan redirect
        }
        // 2.5. Handle SPA-style reload
        if (form.dataset.action === "reload") {
          setTimeout(() => {
            // Gunakan fungsi SPA untuk memuat ulang konten halaman saat ini
            loadAdminPage(window.location.href);
          }, 1500);
          return;
        }
        // 3. Handle aksi khusus tanpa reload (misal: simpan pengaturan)
        if (form.dataset.action === "apply-settings") {
          // Contoh: Terapkan tema secara instan tanpa reload halaman
          const themeInput = form.querySelector(
            'input[name="admin_theme"]:checked',
          );
          if (themeInput) {
            document.documentElement.classList.remove("dark", "light");
            document.documentElement.classList.add(themeInput.value);
          }
        }

        // Selalu kembalikan tombol ke state semula jika tidak ada redirect
        submitButton.disabled = false;
        submitButton.innerHTML = originalButtonText;
      } else {
        showNotification(
          "error",
          result.message || "Terjadi kesalahan yang tidak diketahui.",
        );
      }
    } catch (error) {
      console.error("Form submission error:", error);
      showNotification(
        "error",
        "Gagal terhubung ke server. Silakan coba lagi.",
      );
    } finally {
      // Pastikan tombol selalu kembali normal, kecuali jika akan redirect.
      // Blok ini akan berjalan setelah try/catch selesai.
      submitButton.disabled = false;
      submitButton.innerHTML = originalButtonText;
    }
  };

  // Professional Solution: Use Event Delegation
  // This single event listener on the body will handle submissions
  // from any form with the 'ajax-form' class, even if it's loaded dynamically.
  document.body.addEventListener("submit", function (e) {
    // Check if the submitted element is a form with the 'ajax-form' class
    if (e.target && e.target.matches("form.ajax-form")) {
      e.preventDefault(); // Prevent the default form submission
      handleAjaxFormSubmit(e.target); // Handle it with our AJAX function
    }
  });

  // ==========================================
  // LOGIKA UNTUK TOMBOL BATAL (TANPA REFRESH)
  // ==========================================
  // Menggunakan event delegation untuk menangani semua tombol 'batal'
  document.body.addEventListener("click", function (e) {
    // Cek apakah elemen yang diklik atau parent-nya adalah <a> dengan kelas 'btn-cancel'
    const cancelButton = e.target.closest("a.btn-cancel");

    if (cancelButton) {
      e.preventDefault(); // Hentikan navigasi standar
      window.history.back(); // Kembali ke halaman sebelumnya di riwayat browser
    }
  });
});
