<?php
include 'config/koneksi.php'; // pastikan path ini benar

// Data admin baru
$username = 'admin';
$password_plain = 'admin123'; // password yang ingin dipakai
$role = 'admin';

// Hash password
$password_hash = password_hash($password_plain, PASSWORD_DEFAULT);

// Hapus admin lama (opsional, tapi aman biar tidak ada duplikat)
mysqli_query($koneksi, "DELETE FROM users WHERE username='$username'");

// Masukkan admin baru
$stmt = mysqli_prepare($koneksi, "INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
mysqli_stmt_bind_param($stmt, "sss", $username, $password_hash, $role);
mysqli_stmt_execute($stmt);

echo "Admin berhasil dibuat!<br>";
echo "Username: $username<br>Password: $password_plain<br>";
