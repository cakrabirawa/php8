<?php
require_once '../config/database.php';

if (!isset($_SESSION['login_admin'])) {
    header('HTTP/1.1 403 Forbidden');
    echo json_encode(['status' => 'error', 'message' => 'Akses ditolak.']);
    exit;
}

header('Content-Type: application/json');

// Validasi CSRF untuk aksi selain GET
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    validate_csrf_token();
}

$upload_dir = __DIR__ . '/../uploads/assets/';
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}

// Aksi Hapus File
if (isset($_POST['action']) && $_POST['action'] === 'delete') {
    $id = (int)($_POST['id'] ?? 0);
    if ($id > 0) {
        $stmt = $conn->prepare("SELECT unique_filename FROM assets WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $asset = $stmt->fetch();

        if ($asset) {
            // Hapus file fisik
            $file_path = $upload_dir . $asset['unique_filename'];
            if (file_exists($file_path)) {
                @unlink($file_path);
            }

            // Hapus record dari database
            $delete_stmt = $conn->prepare("DELETE FROM assets WHERE id = :id");
            if ($delete_stmt->execute([':id' => $id])) {
                echo json_encode(['status' => 'success', 'message' => 'File berhasil dihapus.']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Gagal menghapus data dari database.']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'File tidak ditemukan.']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'ID file tidak valid.']);
    }
    exit;
}

// Aksi Unggah File (Chunked)
if (isset($_FILES['chunk'])) {
    $original_filename = $_POST['original_filename'] ?? null;
    $chunk_index = (int)($_POST['chunk_index'] ?? -1);
    $total_chunks = (int)($_POST['total_chunks'] ?? -1);

    if (!$original_filename || $chunk_index < 0 || $total_chunks <= 0) {
        echo json_encode(['status' => 'error', 'message' => 'Parameter unggahan tidak valid.']);
        exit;
    }

    // Sanitasi nama file asli untuk digunakan dalam nama file sementara
    $sanitized_original_filename = preg_replace('/[^A-Za-z0-9\._-]/', '', $original_filename);
    // Buat nama file sementara yang unik untuk setiap file yang diunggah
    $temp_file_path = $upload_dir . session_id() . '_' . md5($original_filename) . '_' . $sanitized_original_filename . '.tmp';

    $extension = strtolower(pathinfo($original_filename, PATHINFO_EXTENSION));

    // Ambil konten chunk
    $chunk_content = file_get_contents($_FILES['chunk']['tmp_name']);
    if ($chunk_content === false) {
        echo json_encode(['status' => 'error', 'message' => 'Gagal membaca chunk.']);
        exit;
    }

    // Tulis chunk ke file sementara
    file_put_contents($temp_file_path, $chunk_content, FILE_APPEND);

    // Cek apakah ini adalah chunk terakhir
    if ($chunk_index === $total_chunks - 1) {
        // Buat nama file unik final HANYA saat chunk terakhir diterima
        $unique_filename = uniqid('asset-', true) . '.' . $extension;
        $target_file = $upload_dir . $unique_filename;
        // Ganti nama file sementara menjadi nama file final
        rename($temp_file_path, $target_file);

        // Simpan metadata ke database
        $filesize = filesize($target_file);
        $filetype = mime_content_type($target_file);

        $stmt = $conn->prepare("INSERT INTO assets (unique_filename, original_filename, filesize, filetype) VALUES (:unique_filename, :original_filename, :filesize, :filetype)");
        $stmt->execute([':unique_filename' => $unique_filename, ':original_filename' => $original_filename, ':filesize' => $filesize, ':filetype' => $filetype]);

        echo json_encode(['status' => 'success', 'message' => 'File berhasil diunggah.']);
    } else {
        // Kirim respons bahwa chunk diterima dan tunggu chunk berikutnya
        echo json_encode(['status' => 'chunk_uploaded']);
    }
    exit;
}

// Fallback response jika tidak ada aksi yang cocok
echo json_encode(['status' => 'error', 'message' => 'Aksi tidak valid atau tidak dikenali.']);
