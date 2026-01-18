<?php
// layout.php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include 'config/koneksi.php';

// Default cart count
$cart_count = 0;

if(isset($_SESSION['login'])){
    $id_user = $_SESSION['id_user'];
    include __DIR__ . '/config/koneksi.php'; // pastikan path koneksi benar
    $res = mysqli_query($koneksi, "SELECT SUM(qty) AS total_qty FROM cart WHERE id_user = $id_user");
    $row = mysqli_fetch_assoc($res);
    $cart_count = $row['total_qty'] ?? 0;
}

// Ambil search query jika ada
$search = $_GET['search'] ?? '';
?>

<!doctype html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= $title ?? "TokoSegala"; ?></title>

    <!-- Bootstrap & Font Awesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />

    <!-- Custom CSS -->
    <?php $base_url = "/TokoSegala"; // folder project di localhost ?>
    <link rel="stylesheet" href="<?= $base_url ?>/assets/css/style.css" />
  </head>
  <body class="d-flex flex-column min-vh-100">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
      <div class="container">
        <a class="navbar-brand" href="<?= $base_url ?>/index.php">TokoSegala</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
          <!-- KIRI: Kategori -->
          <ul class="navbar-nav me-auto">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Kategori</a>
              <ul class="dropdown-menu">
                <?php $kategori_query = mysqli_query($koneksi, "SELECT DISTINCT kategori FROM products"); while($k = mysqli_fetch_assoc($kategori_query)): ?>
                <li>
                  <a class="dropdown-item" href="<?= $base_url ?>/index.php?kategori=<?= $k['kategori']; ?>#produk-section"> <?= $k['kategori']; ?> </a>
                </li>
                <?php endwhile; ?>
                <li><hr class="dropdown-divider" /></li>
                <li>
                  <a class="dropdown-item fw-semibold" href="<?= $base_url ?>/index.php#produk-section">Lihat Semua</a>
                </li>
              </ul>
            </li>
          </ul>

          <!-- TENGAH/KANAN: Search -->
          <ul class="navbar-nav flex-grow-1 me-3">
            <li class="nav-item w-100">
              <form class="d-flex w-100" method="GET" action="<?= $base_url ?>/search.php">
                <div class="input-group w-100">
                  <input class="form-control search-input" type="search" name="search" placeholder="Cari produk..." value="<?= htmlspecialchars($search ?? ''); ?>" aria-label="Search" />
                  <button class="btn btn-search" type="submit">
                    <i class="fas fa-search"></i>
                  </button>
                </div>
              </form>
            </li>
          </ul>

        <!-- KANAN -->
        <ul class="navbar-nav ms-auto align-items-center">
            <?php if(isset($_SESSION['login'])): ?>
                <?php if($_SESSION['role'] == 'admin'): ?>
                <!-- Icon untuk admin: buka produk.php -->
                <li class="nav-item me-3">
                    <a class="nav-link text-dark" href="<?= $base_url ?>/admin/produk.php" title="Manajemen Produk">
                        <i class="fas fa-shapes fa-lg"></i>
                    </a>
                </li>
                <?php else: ?>
                <!-- Icon keranjang untuk user -->
                <li class="nav-item me-3 position-relative">
                    <a class="nav-link text-dark" href="<?= $base_url ?>/user/keranjang.php" title="Keranjang">
                        <i class="fas fa-shopping-cart fa-lg"></i>
                        <?php if($cart_count > 0): ?>
                        <span class="position-absolute top-11 start-75 translate-middle badge rounded-pill bg-danger">
                            <?= $cart_count; ?>
                        </span>
                        <?php endif; ?>
                    </a>
                </li>
                <?php endif; ?>            
        <!-- Icon Logout -->
            <li class="nav-item">
              <a class="nav-link text-black" href="<?= $base_url ?>/auth/logout.php" title="Logout">
                <i class="fas fa-sign-out-alt"></i>
              </a>
            </li>
            <?php else: ?>
            <!-- User belum login → teks Login / Sign Up -->
            <li class="nav-item"><a class="nav-link" href="<?= $base_url ?>/auth/login.php">Login</a></li>
            <li class="nav-item"><a class="nav-link" href="<?= $base_url ?>/auth/register.php">Sign Up</a></li>
            <?php endif; ?>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Konten halaman -->
    <main class="container py-5"><?= $content ?? ''; ?></main>

    <!-- Footer -->
    <footer class="py-4 mt-auto border-top text-center">&copy; 2026 Dibuat oleh Fakhrul Mudzakkir Shiddiq (312410041) TI.24.C1 Universitas Pelita Bangsa</footer>

    <!-- JS Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
