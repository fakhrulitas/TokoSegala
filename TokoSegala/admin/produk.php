<?php
// admin/manajemen_produk.php
session_start();
include '../config/koneksi.php';

// Proteksi halaman: hanya admin
if (!isset($_SESSION['login']) || $_SESSION['role'] != 'admin') {
    header("Location: ../dashboard.php");
    exit;
}

// Ambil semua produk
$result = mysqli_query($koneksi, "SELECT * FROM products");

// Mulai output buffer
ob_start();
?>

<div class="container mt-4">
    <h3>Manajemen Produk</h3>
    <a href="tambah_produk.php" class="btn btn-primary mb-3">+ Tambah Produk</a>

    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>Nama</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?= htmlspecialchars($row['nama_produk']); ?></td>
                    <td><?= htmlspecialchars($row['kategori']); ?></td>
                    <td>Rp <?= number_format($row['harga']); ?></td>
                    <td><?= $row['stok']; ?></td>
                    <td><img src="../assets/images/<?= $row['gambar']; ?>" width="80" style="object-fit:cover;"></td>
                    <td>
                        <a href="edit_produk.php?id=<?= $row['id_product']; ?>" class="btn btn-warning btn-sm">🖊 Edit</a>
                        <a href="hapus_produk.php?id=<?= $row['id_product']; ?>" class="btn btn-danger btn-sm">Hapus</a>
                    </td>
                </tr>      
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<?php
// Simpan output ke $content
$content = ob_get_clean();
$title = "Manajemen Produk";

// Panggil layout.php dari root
include __DIR__ . '/../layout.php';
?>
