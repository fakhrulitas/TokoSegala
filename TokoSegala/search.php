<?php
session_start();
include 'config/koneksi.php';

// Ambil kategori unik
$kategori_query = mysqli_query($koneksi, "SELECT DISTINCT kategori FROM products");

// Filter kategori jika dipilih
$filter_kategori = isset($_GET['kategori']) ? $_GET['kategori'] : '';

// Search
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Ambil produk
$where = [];
if($search) $where[] = "nama_produk LIKE '%$search%'";
if($filter_kategori) $where[] = "kategori='$filter_kategori'";

$where_sql = $where ? "WHERE ".implode(" AND ", $where) : "";
$produk = mysqli_query($koneksi, "SELECT * FROM products $where_sql");

// --- Mulai output buffer untuk konten halaman ---
ob_start();
?>

<div class="container mt-4">
  <h1 class="mb-4">Hasil Pencarian</h1>
  <div class="row">
    <?php while($p = mysqli_fetch_assoc($produk)): ?>
    <div class="col-6 col-sm-6 col-lg-3">
      <div class="card h-100 border-0">
        <div class="p-4 bg-white rounded-top" style="height: 200px">
          <img src="assets/images/<?= $p['gambar']; ?>" class="img-fluid h-100 w-100" style="object-fit: contain" />
        </div>
        <div class="card-body d-flex flex-column">
          <span class="badge bg-light text-primary text-uppercase mb-2" style="font-size: 10px"><?= $p['kategori']; ?></span>
          <h6 class="card-title fw-bold text-dark text-truncate"><?= $p['nama_produk']; ?></h6>
          <div class="mt-auto d-flex justify-content-between align-items-center">
            <span class="h5 fw-bold text-success mb-0">Rp <?= number_format($p['harga']); ?></span>
            <a href="detail_produk.php?id=<?= $p['id_product']; ?>" class="btn btn-dark btn-sm rounded-pill px-3">Detail</a>
          </div>
        </div> 
      </div> 
    </div>
    <?php endwhile; ?>
  </div>
</div>
<?php
// Simpan buffer ke variabel $content
$content = ob_get_clean();
$title = "Toko Segala";

// Panggil layout.php
include 'layout.php';
