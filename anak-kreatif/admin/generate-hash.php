<?php
// Script sederhana untuk menghasilkan hash password yang aman.
// Ganti 'password_rahasia_anda' dengan password yang Anda inginkan.
$passwordToHash = '12345';

$hash = password_hash($passwordToHash, PASSWORD_DEFAULT);

echo "Gunakan hash di bawah ini untuk database Anda:<br><br>";
echo "<strong>" . htmlspecialchars($hash) . "</strong>";
