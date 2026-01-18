<?php
session_start();

// Proteksi halaman
if(!isset($_SESSION['login']) || $_SESSION['role'] != 'user'){
    header("Location: ../auth/login.php");
    exit;
}

// Include koneksi
include __DIR__ . '/../config/koneksi.php';

// Ambil id_cart dari URL, sesuai link di keranjang.php
$id_cart = $_GET['id'] ?? null;
$action = $_GET['action'] ?? null;

if(!$id_cart || !$action){
    // Jika id atau action tidak ada, kembali ke keranjang
    header("Location: keranjang.php");
    exit;
}

// Ambil qty sekarang
$q = mysqli_query($koneksi, "SELECT qty FROM cart WHERE id_cart = $id_cart");
$row = mysqli_fetch_assoc($q);
if(!$row){
    header("Location: keranjang.php");
    exit;
}

$qty = $row['qty'];

if($action == 'increase'){
    $qty++;
    mysqli_query($koneksi, "UPDATE cart SET qty = $qty WHERE id_cart = $id_cart");
} elseif($action == 'decrease'){
    $qty--;
    if($qty <= 0){
        // Hapus produk dari cart
        mysqli_query($koneksi, "DELETE FROM cart WHERE id_cart = $id_cart");
    } else {
        mysqli_query($koneksi, "UPDATE cart SET qty = $qty WHERE id_cart = $id_cart");
    }
}

// Redirect kembali ke keranjang
header("Location: keranjang.php");
exit;
?>
