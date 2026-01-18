<?php
session_start();
include '../config/koneksi.php';

$id_user = $_SESSION['id_user'];
$id_product = $_GET['id'];

// Cek apakah produk sudah ada di keranjang
$cek = mysqli_query($koneksi, "SELECT * FROM cart WHERE id_user=$id_user AND id_product=$id_product");
if(mysqli_num_rows($cek) > 0){
    // Produk sudah ada, update qty
    mysqli_query($koneksi, "UPDATE cart SET qty = qty + 1 WHERE id_user=$id_user AND id_product=$id_product");
} else {
    // Produk belum ada, insert baru
    mysqli_query($koneksi, "INSERT INTO cart (id_user,id_product,qty) VALUES ($id_user,$id_product,1)");
}

header("Location: keranjang.php");
exit;
?>
