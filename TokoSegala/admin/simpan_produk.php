<?php
include '../config/koneksi.php';

$nama     = $_POST['nama'];
$kategori = $_POST['kategori'];
$harga    = $_POST['harga'];
$stok     = $_POST['stok'];

$gambar   = $_FILES['gambar']['name'];
$tmp      = $_FILES['gambar']['tmp_name'];
move_uploaded_file($tmp, '../assets/images/'.$gambar);

$stmt = mysqli_prepare($koneksi, "INSERT INTO products (nama_produk, kategori, harga, stok, gambar) VALUES (?,?,?,?,?)");
mysqli_stmt_bind_param($stmt, "sssis", $nama, $kategori, $harga, $stok, $gambar);
mysqli_stmt_execute($stmt);

header("Location: produk.php");
?>