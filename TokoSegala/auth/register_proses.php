<?php
include '../config/koneksi.php';

$username = trim($_POST['username']);
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$role = 'user';

/* Cek username sudah ada */
$cek = mysqli_prepare($koneksi, "SELECT id_user FROM users WHERE username = ?");
mysqli_stmt_bind_param($cek, "s", $username);
mysqli_stmt_execute($cek);
mysqli_stmt_store_result($cek);

if (mysqli_stmt_num_rows($cek) > 0) {
    echo "Username sudah digunakan";
    exit;
}

/* Simpan user baru */
$stmt = mysqli_prepare($koneksi, "INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
mysqli_stmt_bind_param($stmt, "sss", $username, $password, $role);
mysqli_stmt_execute($stmt);

header("Location: login.php");
?>
