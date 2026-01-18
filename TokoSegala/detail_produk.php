<?php
session_start();
include 'config/koneksi.php';

// --- Proteksi halaman: hanya user login ---
if(!isset($_SESSION['login']) || $_SESSION['role'] !== 'user'){
    // Semua yang bukan user diarahkan ke login
    header("Location: auth/login.php");
    exit;
}

// --- Pastikan ada id produk di URL ---
if(!isset($_GET['id'])){
    header("Location: index.php");
    exit;
}

$id_product = $_GET['id'];

// Ambil data produk dari database
$query = mysqli_query($koneksi, "SELECT * FROM products WHERE id_product='$id_product'");
$product = mysqli_fetch_assoc($query);

if(!$product){
    echo "Produk tidak ditemukan!";
    exit;
}

// --- Mulai output buffer ---
ob_start();
?>

<div class="card-detail shadow-lg border-0 rounded-4 overflow-hidden mb-5 mt-5">
  <div class="row g-0">
    <!-- Gambar di kiri -->
    <div class="col-md-5 p-5 bg-white text-center border-end">
      <img src="assets/images/<?= $product['gambar']; ?>" class="img-fluid" style="max-height: 400px;" />
    </div>

    <!-- Info produk di kanan -->
    <div class="col-md-7 p-5 bg-white">
      <a href="javascript:history.back()" class="btn btn-link text-decoration-none p-0 mb-3">←</a>

      <h1 class="fw-bold"><?= $product['nama_produk']; ?></h1>
      <a href="index.php?kategori=<?= $product['kategori']; ?>" class="badge bg-info text-dark text-decoration-none mb-3 d-inline-block">
        <?= $product['kategori']; ?>
      </a>

      <h2 class="text-success my-4">Rp <?= number_format($product['harga']); ?></h2>
      <p class="text-muted" style="text-align: justify;"> Klik keranjang dibawah untuk membeli ↴</p>

      <a href="user/tambah_keranjang.php?id=<?= $product['id_product']; ?>" class="btn btn-cart btn-lg">
        <i class="fas fa-cart-plus"></i> Tambahkan ke Keranjang
      </a>
    </div>
  </div>
</div>

<?php
$content = ob_get_clean();
$title = $product['nama_produk'];

// Panggil layout.php
include 'layout.php';
?>
