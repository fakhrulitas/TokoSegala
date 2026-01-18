<?php
session_start();
include '../config/koneksi.php';

// Proteksi hanya admin
if(!isset($_SESSION['login']) || $_SESSION['role'] != 'admin'){
    header("Location: ../dashboard.php");
    exit;
}

// Pastikan ada ID produk
if(!isset($_GET['id'])){
    header("Location: produk.php");
    exit;
}

$id_product = $_GET['id'];

// Ambil data produk untuk menghapus gambar fisik (opsional)
$query = mysqli_query($koneksi, "SELECT gambar FROM products WHERE id_product='$id_product'");
$produk = mysqli_fetch_assoc($query);
if($produk && !empty($produk['gambar'])){
    $file_path = __DIR__ . "/../assets/images/" . $produk['gambar'];
    if(file_exists($file_path)){
        unlink($file_path); // hapus file gambar
    }
}

// Hapus produk dari database
$hapus = mysqli_query($koneksi, "DELETE FROM products WHERE id_product='$id_product'");
if($hapus){
    header("Location: produk.php?msg=Produk+berhasil+dihapus");
    exit;
} else {
    echo "Gagal menghapus produk: " . mysqli_error($koneksi);
}
