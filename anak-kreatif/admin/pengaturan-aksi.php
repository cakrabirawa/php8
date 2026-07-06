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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  validate_csrf_token();
  $admin_paging = (int)$_POST['admin_paging'];
  $asset_paging = (int)$_POST['asset_paging'];
  $site_title = trim($_POST['site_title']);
  $home_video_limit = (int)$_POST['home_video_limit'];
  $footer_text = trim($_POST['footer_text']);
  $site_tagline = trim($_POST['site_tagline']);
  $hero_title = trim($_POST['hero_title']);
  $hero_subtitle = trim($_POST['hero_subtitle']);
  $video_section_title = trim($_POST['video_section_title']);
  $video_section_subtitle = trim($_POST['video_section_subtitle']);
  $hero_gradient_start = trim($_POST['hero_gradient_start']);
  $hero_gradient_end = trim($_POST['hero_gradient_end']);
  $admin_theme = in_array($_POST['admin_theme'], ['light', 'dark']) ? $_POST['admin_theme'] : 'light';

  if ($admin_paging < 1) $admin_paging = 5;
  if ($asset_paging < 6) $asset_paging = 18;
  if (empty($site_title)) $site_title = 'AnakKreatif';
  if ($home_video_limit < 1) $home_video_limit = 2;
  if (empty($footer_text)) $footer_text = '© ' . date('Y') . ' AnakKreatif. All rights reserved.';
  if (empty($site_tagline)) $site_tagline = 'Ruang tumbuh kembang imajinasi dan bakat menulis literasi anak sejak dini.';
  if (empty($hero_title)) $hero_title = 'Tumbuhkan Imajinasi Si Kecil Lewat Buku & Kata';
  if (empty($hero_subtitle)) $hero_subtitle = 'Temukan kurasi buku cerita anak terbaik serta program pelatihan menulis interaktif yang dirancang khusus mematangkan kreativitas anak usia 7-12 tahun.';
  if (empty($video_section_title)) $video_section_title = 'Video Kegiatan Kreatif';
  if (empty($video_section_subtitle)) $video_section_subtitle = 'Dokumentasi keseruan kelas menulis dan ulasan buku anak-anak.';
  if (empty($hero_gradient_start)) $hero_gradient_start = '#FDE68A';
  if (empty($hero_gradient_end)) $hero_gradient_end = '#FFFFFF';

  $settings_to_save = [
    'admin_paging' => $admin_paging,
    'asset_paging' => $asset_paging,
    'site_title'   => $site_title,
    'home_video_limit' => $home_video_limit,
    'footer_text'  => $footer_text,
    'site_tagline' => $site_tagline,
    'hero_title'   => $hero_title,
    'hero_subtitle' => $hero_subtitle,
    'video_section_title' => $video_section_title,
    'video_section_subtitle' => $video_section_subtitle,
    'hero_gradient_start' => $hero_gradient_start,
    'hero_gradient_end' => $hero_gradient_end,
    'admin_theme'  => $admin_theme,
  ];

  // Professional Approach: Use INSERT ... ON DUPLICATE KEY UPDATE for efficiency and atomicity.
  // This single query handles both inserting a new setting and updating an existing one.
  $stmt = mysqli_prepare($conn, "INSERT INTO pengaturan (key_name, setting_value) VALUES (?, ?) ON DUPLICATE KEY UPDATE setting_value = VALUES(setting_value)");

  foreach ($settings_to_save as $key => $value) {
    mysqli_stmt_bind_param($stmt, 'ss', $key, $value);
    mysqli_stmt_execute($stmt);
  }
  mysqli_stmt_close($stmt);

  send_json_response('success', 'Pengaturan berhasil diperbarui!');
}
