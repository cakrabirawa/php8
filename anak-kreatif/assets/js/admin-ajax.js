document.addEventListener('DOMContentLoaded', () => {
  /**
   * Menampilkan notifikasi di bagian atas halaman.
   * @param {string} status 'success' atau 'error'
   * @param {string} message Pesan yang akan ditampilkan
   */
  const showNotification = (status, message) => {
    const container = document.getElementById('notification-container');
    if (!container) return;

    const color = status === 'success' ? 'bg-emerald-50 text-emerald-700 border-emerald-200' : 'bg-red-50 text-red-700 border-red-200';
    const notification = document.createElement('div');
    notification.className = `p-4 mb-4 rounded-lg border font-semibold text-sm transition-opacity duration-300 ${color}`;
    notification.textContent = message;

    container.appendChild(notification);

    // Hapus notifikasi setelah 5 detik
    setTimeout(() => {
      notification.style.opacity = '0';
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
    submitButton.innerHTML = 'Menyimpan...';

    try {
      const formData = new FormData(form);
      const response = await fetch(form.action, {
        method: 'POST',
        body: formData,
        headers: {
          'X-Requested-With': 'XMLHttpRequest' // Header untuk identifikasi AJAX di server
        }
      });

      if (!response.ok) {
        throw new Error(`HTTP error! Status: ${response.status}`);
      }

      const result = await response.json();

      if (result.status === 'success') {
        showNotification('success', result.message || 'Operasi berhasil!');

        // Handle redirects from login or other actions
        if (result.redirect) {
          // For login, a standard redirect is cleaner and more reliable.
          setTimeout(() => window.location.href = result.redirect, 1000);
          return; // Stop further execution
        }

        // Jika form memiliki data-action="reload", muat ulang halaman
        if (form.dataset.action === 'reload') {
          // Apply theme instantly without full reload for a smoother experience
          const themeInput = form.querySelector('input[name="admin_theme"]:checked');
          if (themeInput) {
            document.documentElement.classList.remove('dark', 'light');
            document.documentElement.classList.add(themeInput.value);
          }
          // Re-enable the button after applying the theme
          submitButton.disabled = false;
          submitButton.innerHTML = originalButtonText;
          // Disable the redirect to stay on the page
          // setTimeout(() => window.location.reload(), 1500);
        } else if (form.dataset.redirectUrl) {
          const redirectUrl = form.dataset.redirectUrl;
          setTimeout(() => {
            window.location.href = redirectUrl;
          }, 1500);
        }
      } else {
        showNotification('error', result.message || 'Terjadi kesalahan yang tidak diketahui.');
        submitButton.disabled = false;
        submitButton.innerHTML = originalButtonText;
      }
    } catch (error) {
      console.error('Form submission error:', error);
      showNotification('error', 'Gagal terhubung ke server. Silakan coba lagi.');
      submitButton.disabled = false;
      submitButton.innerHTML = originalButtonText;
    }
  };

  // Professional Solution: Use Event Delegation
  // This single event listener on the body will handle submissions
  // from any form with the 'ajax-form' class, even if it's loaded dynamically.
  document.body.addEventListener('submit', function (e) {
    // Check if the submitted element is a form with the 'ajax-form' class
    if (e.target && e.target.matches('form.ajax-form')) {
      e.preventDefault(); // Prevent the default form submission
      handleAjaxFormSubmit(e.target); // Handle it with our AJAX function
    }
  });
});