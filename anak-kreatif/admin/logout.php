<?php
session_start();
require_once '../config/database.php';

// Unset all of the session variables.
$_SESSION = [];

// Destroy the session.
session_destroy();

// Redirect to login page.
header("Location: " . ADMIN_URL . "login");
exit;
