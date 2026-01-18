<?php
// edit_produk.php
session_start();
include '../config/koneksi.php';

// Proteksi halaman hanya admin
if(!isset($_SESSION['login']) || $_SESSION['role'] != 'admin'){
    header("Location: ../dashboard.php");
    exit;
}

// Pastikan ada id di URL
if(!isset($_GET['id'])){
    header("Location: produk.php");
    exit;
}

$id_product = $_GET['id'];

// Ambil data produk
$query = mysqli_query($koneksi, "SELECT * FROM products WHERE id_product='$id_product'");
$produk = mysqli_fetch_assoc($query);
if(!$produk){
    die("Produk tidak ditemukan!");
}

// Hardcode daftar kategori
$kategori_list = ['Elektronik', 'Pakaian', 'Perhiasan'];

// Mulai output buffer
ob_start();
?>

<h3 class="mb-4">Edit Produk</h3>

<a href="produk.php" class="btn btn-cart mb-3"><i class="fas fa-arrow-left me-2"></i>Kembali</a>

<form action="update_produk.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id_product" value="<?= $produk['id_product']; ?>">

    <div class="mb-3">
        <label class="form-label">Nama Produk</label>
        <input type="text" name="nama" class="form-control" value="<?= $produk['nama_produk']; ?>" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Kategori</label>
        <select name="kategori" class="form-control" required>
            <option value="">-- Pilih Kategori --</option>
            <?php foreach($kategori_list as $k):
                $selected = ($produk['kategori'] == $k) ? 'selected' : '';
            ?>
                <option value="<?= $k; ?>" <?= $selected; ?>><?= $k; ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Harga</label>
        <input type="number" name="harga" class="form-control" value="<?= $produk['harga']; ?>" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Stok</label>
        <input type="number" name="stok" class="form-control" value="<?= $produk['stok']; ?>" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Gambar Produk</label><br>
        <img src="../assets/images/<?= $produk['gambar']; ?>" width="150" class="mb-2"><br>
        <input type="file" name="gambar" class="form-control">
        <small class="text-muted">Kosongkan jika tidak ingin mengganti gambar</small>
    </div>

    <button type="submit" class="btn btn-cart"><i class="fas fa-save me-2"></i>Update Produk</button>
</form>

<?php
$content = ob_get_clean();
$title = "Edit Produk";

// Panggil layout.php dari root
include __DIR__ . '/../layout.php';
?>
