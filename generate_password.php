<?php
// Simpan kode ini sebagai generate_hash.php dan jalankan sekali
$password = 'admin123';
$hash = password_hash($password, PASSWORD_BCRYPT);
echo "Password: " . $password . "\n";
echo "Hash: " . $hash . "\n";
echo "Verification test: " . (password_verify($password, $hash) ? 'Valid' : 'Invalid');
?>