<?php
session_start();
include '../config/koneksi.php';

// Proteksi admin
if($_SESSION['role'] != 'admin'){
    header("Location: ../dashboard.php");
    exit;
}

// Ambil data POST
$id_product = $_POST['id_product'];
$nama = $_POST['nama'];
$kategori = $_POST['kategori'];
$harga = $_POST['harga'];
$stok = $_POST['stok'];

// Cek upload gambar
if(isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0){
    $filename = time() . '_' . $_FILES['gambar']['name'];
    move_uploaded_file($_FILES['gambar']['tmp_name'], "../assets/images/$filename");

    // Hapus gambar lama
    $old = mysqli_query($koneksi, "SELECT gambar FROM products WHERE id_product='$id_product'");
    $old_gambar = mysqli_fetch_assoc($old)['gambar'];
    if(file_exists("../assets/images/$old_gambar")){
        unlink("../assets/images/$old_gambar");
    }

    // Update dengan gambar baru
    $query = "UPDATE products SET nama_produk='$nama', kategori='$kategori', harga='$harga', stok='$stok', gambar='$filename' WHERE id_product='$id_product'";
} else {
    // Update tanpa mengganti gambar
    $query = "UPDATE products SET nama_produk='$nama', kategori='$kategori', harga='$harga', stok='$stok' WHERE id_product='$id_product'";
}

$update = mysqli_query($koneksi, $query);
if($update){
    header("Location: produk.php?msg=Produk+berhasil+diupdate");
    exit;
} else {
    die("Gagal update produk: " . mysqli_error($koneksi));
}
