const Uploader = {
  elements: {},
  isInitialized: false,
  abortController: null,

  init: function () {
    this.elements = {
      uploadContainer: document.getElementById("upload-container"),
      uploadButton: document.getElementById("upload-button"),
      fileInput: document.getElementById("file-input"),
      progressContainer: document.getElementById("upload-progress-container"),
      progressBar: document.getElementById("progress-bar"),
      progressFilename: document.getElementById("progress-filename"),
      progressPercentage: document.getElementById("progress-percentage"),
      uploadStatus: document.getElementById("upload-status"),
    };

    if (!this.elements.uploadContainer) return;
    if (this.isInitialized) return;

    this.abortController = new AbortController();
    this.addEventListeners();
    this.isInitialized = true;
  },

  addEventListeners: function () {
    const { uploadContainer, uploadButton, fileInput } = this.elements;
    const options = { signal: this.abortController.signal };

    uploadButton.addEventListener(
      "click",
      this.triggerFileInput.bind(this),
      options,
    );
    uploadContainer.addEventListener(
      "click",
      this.triggerFileInput.bind(this),
      options,
    );
    uploadContainer.addEventListener(
      "dragover",
      this.handleDragOver.bind(this),
      options,
    );
    uploadContainer.addEventListener(
      "dragleave",
      this.handleDragLeave.bind(this),
      options,
    );
    uploadContainer.addEventListener(
      "drop",
      this.handleDrop.bind(this),
      options,
    );
    fileInput.addEventListener(
      "change",
      this.handleFileSelect.bind(this),
      options,
    );
  },

  destroy: function () {
    if (this.abortController) this.abortController.abort();
    this.isInitialized = false;
  },

  triggerFileInput: function () {
    this.elements.fileInput.click();
  },
  handleDragOver: function (e) {
    e.preventDefault();
    e.stopPropagation();
    this.elements.uploadContainer.classList.add(
      "bg-gray-100",
      "dark:bg-zinc-800",
    );
  },
  handleDragLeave: function (e) {
    e.preventDefault();
    e.stopPropagation();
    this.elements.uploadContainer.classList.remove(
      "bg-gray-100",
      "dark:bg-zinc-800",
    );
  },
  handleDrop: function (e) {
    e.preventDefault();
    e.stopPropagation();
    this.handleDragLeave(e);
    if (e.dataTransfer.files.length > 0) {
      this.processFiles(e.dataTransfer.files);
    }
  },
  handleFileSelect: function (e) {
    if (e.target.files.length > 0) {
      this.processFiles(e.target.files);
      e.target.value = ""; // Reset input agar bisa memilih file yang sama lagi
    }
  },

  // Fungsi baru untuk memproses antrean file
  processFiles: async function (files) {
    const { progressContainer, uploadStatus } = this.elements;
    progressContainer.classList.remove("hidden");

    for (let i = 0; i < files.length; i++) {
      const file = files[i];
      uploadStatus.textContent = `Mengunggah file ${i + 1} dari ${files.length}...`;
      try {
        // Menunggu setiap file selesai diunggah sebelum melanjutkan ke file berikutnya
        await this.handleSingleFileUpload(file);
      } catch (error) {
        // Jika satu file gagal, proses berhenti dan menampilkan error
        console.error(`Gagal mengunggah ${file.name}:`, error);
        uploadStatus.textContent = `Gagal mengunggah ${file.name}. Proses dihentikan.`;
        return; // Hentikan loop
      }
    }

    // Setelah semua file berhasil diunggah
    uploadStatus.textContent = "Semua unggahan selesai! Memuat ulang galeri...";
    setTimeout(() => loadAdminPage(window.location.href), 1500);
  },

  // Fungsi ini sekarang menangani satu file dan mengembalikan Promise
  handleSingleFileUpload: function (file) {
    return new Promise((resolve, reject) => {
      if (!file) return reject(new Error("File tidak valid."));

      const {
        progressFilename,
        progressBar,
        progressPercentage,
        uploadStatus,
      } = this.elements;

      progressBar.classList.remove("bg-red-600");
      progressFilename.textContent = file.name;
      progressBar.style.width = `0%`;
      progressPercentage.textContent = `0%`;

      if (file.size === 0) {
        uploadStatus.textContent = "Error: File tidak boleh kosong (0 bytes).";
        progressBar.classList.add("bg-red-600");
        progressBar.style.width = "100%";
        return reject(new Error("File kosong."));
      }

      this.uploadInChunks(file, resolve, reject);
    });
  },

  uploadInChunks: async function (file, resolve, reject) {
    const CHUNK_SIZE = 2 * 1024 * 1024; // 2MB per chunk
    const totalChunks = Math.ceil(file.size / CHUNK_SIZE);
    let chunkIndex = 0;
    const originalFilename = file.name;
    const csrfToken = document
      .querySelector('meta[name="csrf-token"]')
      .getAttribute("content");

    const { progressBar, progressPercentage, uploadStatus } = this.elements;

    while (chunkIndex < totalChunks) {
      const start = chunkIndex * CHUNK_SIZE;
      const end = Math.min(start + CHUNK_SIZE, file.size);
      const chunk = file.slice(start, end);

      const formData = new FormData();
      formData.append("chunk", chunk, originalFilename);
      formData.append("original_filename", originalFilename);
      formData.append("chunk_index", chunkIndex);
      formData.append("total_chunks", totalChunks);
      formData.append("csrf_token", csrfToken);

      try {
        uploadStatus.textContent = `Mengunggah ${file.name} (${chunkIndex + 1}/${totalChunks})...`;

        const response = await fetch("assets-aksi.php", {
          method: "POST",
          body: formData,
          headers: { "X-Requested-With": "XMLHttpRequest" },
        });

        if (!response.ok)
          throw new Error(`Server Response: ${response.statusText}`);

        const result = await response.json();
        if (result.status === "error") throw new Error(result.message);

        const percentComplete = Math.round(
          ((chunkIndex + 1) / totalChunks) * 100,
        );
        progressBar.style.width = `${percentComplete}%`;
        progressPercentage.textContent = `${percentComplete}%`;

        if (result.status === "success") {
          resolve(); // Sinyal bahwa file ini selesai
          return;
        }

        chunkIndex++;
      } catch (error) {
        uploadStatus.textContent = `Error: ${error.message}`;
        progressBar.classList.add("bg-red-600");
        reject(error); // Sinyal bahwa file ini gagal
        return;
      }
    }
  },
};

// Fungsi global untuk dipanggil dari luar
function initChunkUpload() {
  Uploader.init();
}

function destroyChunkUpload() {
  Uploader.destroy();
}

// Inisialisasi awal saat halaman dimuat
document.addEventListener("DOMContentLoaded", initChunkUpload);
