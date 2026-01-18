<?php
session_start();
include 'config/koneksi.php';

// Ambil kategori unik
$kategori_result = mysqli_query($koneksi, "SELECT DISTINCT kategori FROM products");
$categories = [];
while($k = mysqli_fetch_assoc($kategori_result)) {
    $categories[] = $k['kategori'];
}

// Pilih kategori jika ada
$selected_cat = isset($_GET['kategori']) ? $_GET['kategori'] : '';

// Ambil produk
$where = [];
if($selected_cat) $where[] = "kategori='$selected_cat'";
$where_sql = $where ? "WHERE ".implode(" AND ", $where) : "";

$produk_result = mysqli_query($koneksi, "SELECT * FROM products $where_sql");
$products = [];
while($p = mysqli_fetch_assoc($produk_result)) {
    $products[] = $p;
}

// --- Mulai output buffer ---
ob_start();
?>

<div class="mb-5">
    <div class="rounded-4 overflow-hidden shadow-sm">
        <img src="assets/images/banner.jpg" class="img-banner w-100" style="max-height: 420px; object-fit: cover;" alt="Banner TokoKita">
    </div>
</div>
<div id ="produk-section" class="category-header">
  <div class="text-center py-5">
    <h1 class="fw-bold display-6">Segala Katalog Produk</h1>
    <div class="d-flex flex-wrap justify-content-center gap-2 mt-4 position-relative">
      <a href= "index.php#produk-section" class="cat-link <?= $selected_cat == '' ? 'active' : ''; ?>">Semua</a>
      <?php foreach($categories as $cat): ?>
          <a href="index.php?kategori=<?= $cat; ?>#produk-section" class="cat-link <?= $selected_cat == $cat ? 'active' : ''; ?>">
              <?= $cat; ?>
          </a>
      <?php endforeach; ?>
    </div>
  </div>
</div>
<div class="row g-4">
  <?php foreach($products as $p): ?>
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
            <a href="detail_produk.php?id=<?= $p['id_product']; ?>" class="btn btn-dark btn-sm rounded-pill px-3">Lihat</a>
          </div>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
</div>

<?php
$content = ob_get_clean();
$title = "Toko Segala";

// Panggil layout.php
include 'layout.php';
