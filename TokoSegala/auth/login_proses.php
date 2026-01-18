<?php
session_start();
include '../config/koneksi.php';

$username = $_POST['username'];
$password = $_POST['password'];

// Ambil data user sesuai username
$query = mysqli_prepare($koneksi, "SELECT * FROM users WHERE username = ?");
mysqli_stmt_bind_param($query, "s", $username);
mysqli_stmt_execute($query);
$result = mysqli_stmt_get_result($query);
$user = mysqli_fetch_assoc($result);

// Debug sementara, bisa dihapus nanti
// echo "<pre>"; print_r($user); exit;

if ($user) {
    // cek password
    if (password_verify($password, $user['password'])) {
        $_SESSION['login'] = true;
        $_SESSION['id_user'] = $user['id_user'];
        $_SESSION['role'] = $user['role'];

        // Redirect sesuai role
        if ($user['role'] == 'admin') {
            header("Location: ../dashboard.php");
            exit;
        } elseif ($user['role'] == 'user') {
            header("Location: ../dashboard.php");
            exit;
        } else {
            echo "Role tidak valid!";
            exit;
        }
    } else {
        echo "Password salah!";
    }
} else {
    echo "Username tidak ditemukan!";
}
?>
