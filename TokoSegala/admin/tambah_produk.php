<?php
// tambah_produk.php
session_start();
include '../config/koneksi.php';

// Proteksi halaman hanya admin
if(!isset($_SESSION['login']) || $_SESSION['role'] != 'admin'){
    header("Location: ../dashboard.php");
    exit;
}

// Ambil kategori unik dari products
$kategori_result = mysqli_query($koneksi, "SELECT DISTINCT kategori FROM products WHERE kategori IS NOT NULL AND kategori <> ''");

// Hardcode kategori tambahan jika perlu
$kategori_list = ['Elektronik', 'Pakaian', 'Perhiasan'];

// Mulai output buffer
ob_start();
?>

<h3 class="mb-4">Tambah Produk Baru</h3>

<a href="produk.php" class="btn btn-cart mb-3"><i class="fas fa-arrow-left me-2"></i>Kembali</a>

<form action="simpan_produk.php" method="POST" enctype="multipart/form-data">
    <div class="mb-3">
        <label class="form-label">Nama Produk</label>
        <input type="text" name="nama" class="form-control" placeholder="Nama Produk" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Kategori</label>
        <select name="kategori" class="form-control" required>
            <option value="">-- Pilih Kategori --</option>
            <?php
            foreach($kategori_list as $k){
                echo "<option value='$k'>$k</option>";
            }
            ?>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Harga</label>
        <input type="number" name="harga" class="form-control" placeholder="Harga" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Stok</label>
        <input type="number" name="stok" class="form-control" placeholder="Stok" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Gambar Produk</label>
        <input type="file" name="gambar" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-cart"><i class="fas fa-plus me-2"></i>Simpan</button>
</form>

<?php
$content = ob_get_clean();
$title = "Tambah Produk";

// Panggil layout.php dari root
include __DIR__ . '/../layout.php';
?>
