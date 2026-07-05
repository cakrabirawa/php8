<?php
require_once '../config/database.php';

if (!isset($_SESSION['login_admin'])) {
  // Redirect to login if not logged in
  header("Location: " . ADMIN_URL . "login");
  exit;
}

// Database credentials from db_config.php (already included via database.php)
$db_host = DB_HOST;
$db_user = DB_USER;
$db_pass = DB_PASS;
$db_name = DB_NAME;

// Filename for the backup
$filename = 'backup-db-' . $db_name . '-' . date('Y-m-d_H-i-s') . '.sql';

// Set headers for file download
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . basename($filename) . '"');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');

// Open the output stream
$handle = fopen('php://output', 'w');

/**
 * Writes a line to the output stream.
 * @param resource $handle The file pointer resource.
 * @param string $line The line to be written.
 */
function write_line($handle, $line)
{
  echo $line . PHP_EOL;
}

// Start of the SQL dump
write_line($handle, "-- AnakKreatif Database Backup");
write_line($handle, "-- Host: {$db_host}");
write_line($handle, "-- Generation Time: " . date('Y-m-d H:i:s'));
write_line($handle, "-- ------------------------------------------------------");
write_line($handle, "SET SQL_MODE = \"NO_AUTO_VALUE_ON_ZERO\";");
write_line($handle, "SET time_zone = \"+00:00\";");
write_line($handle, "");
write_line($handle, "--");
write_line($handle, "-- Database: `{$db_name}`");
write_line($handle, "--");
write_line($handle, "CREATE DATABASE IF NOT EXISTS `{$db_name}` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;");
write_line($handle, "USE `{$db_name}`;");
write_line($handle, "");

// Get all tables
$tables = [];
$result = mysqli_query($conn, 'SHOW TABLES');
while ($row = mysqli_fetch_row($result)) {
  $tables[] = $row[0];
}

// Loop through each table
foreach ($tables as $table) {
  // Get table structure
  $result_create = mysqli_query($conn, 'SHOW CREATE TABLE `' . $table . '`');
  $row_create = mysqli_fetch_row($result_create);
  write_line($handle, "\n-- --------------------------------------------------------\n");
  write_line($handle, "-- Table structure for table `{$table}`");
  write_line($handle, "--\n");
  write_line($handle, "DROP TABLE IF EXISTS `{$table}`;");
  write_line($handle, $row_create[1] . ";\n");

  // Get table data
  $result_data = mysqli_query($conn, 'SELECT * FROM `' . $table . '`');
  $num_fields = mysqli_num_fields($result_data);

  if (mysqli_num_rows($result_data) > 0) {
    write_line($handle, "\n-- Dumping data for table `{$table}`\n");
    while ($row = mysqli_fetch_row($result_data)) {
      $sql = 'INSERT INTO `' . $table . '` VALUES(';
      for ($j = 0; $j < $num_fields; $j++) {
        $row[$j] = mysqli_real_escape_string($conn, $row[$j]);
        $sql .= isset($row[$j]) ? '"' . $row[$j] . '"' : 'NULL';
        if ($j < ($num_fields - 1)) {
          $sql .= ',';
        }
      }
      $sql .= ');';
      write_line($handle, $sql);
    }
  }
}

// Get the content from the buffer
$sql_content = ob_get_clean();

echo $sql_content;
exit;
