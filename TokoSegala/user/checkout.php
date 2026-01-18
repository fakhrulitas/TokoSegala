<?php
// checkout.php

session_start();

// Proteksi halaman
if (!isset($_SESSION['login']) || $_SESSION['role'] != 'user') {
    header("Location: ../auth/login.php");
    exit;
}

// Koneksi database
include __DIR__ . '/../config/koneksi.php';

$id_user = $_SESSION['id_user'];

// Ambil data keranjang user
$query = "
SELECT c.id_cart, c.qty, p.nama_produk, p.gambar, p.harga
FROM cart c
JOIN products p ON c.id_product = p.id_product
WHERE c.id_user = $id_user
";
$result = mysqli_query($koneksi, $query);

$items = [];
$total = 0;
while ($row = mysqli_fetch_assoc($result)) {
    $row['subtotal'] = $row['harga'] * $row['qty'];
    $total += $row['subtotal'];
    $items[] = $row;
}

// Mulai output buffer
ob_start();
?>

<h2 class="mb-4">Checkout</h2>

<?php if (empty($items)): ?>
    <div class="alert alert-warning text-center">
        Tidak ada produk untuk checkout.
    </div>
<?php else: ?>
<div class="row">
    <!-- Ringkasan Pesanan -->
    <div class="col-lg-8 mb-4">
        <div class="card shadow-sm">
            <div class="card-header fw-bold">
                Ringkasan Pesanan
            </div>
            <div class="card-body">
                <?php foreach ($items as $item): ?>
                <div class="d-flex align-items-center mb-3 border-bottom pb-3">
                    <img src="../assets/images/<?= $item['gambar']; ?>" style="height:60px" class="me-3">
                    <div class="flex-grow-1">
                        <div class="fw-semibold"><?= $item['nama_produk']; ?></div>
                        <small class="text-muted">
                            <?= $item['qty']; ?> × Rp <?= number_format($item['harga']); ?>
                        </small>
                    </div>
                    <div class="fw-bold text-success">
                        Rp <?= number_format($item['subtotal']); ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <!-- Total & Aksi -->
    <div class="col-lg-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="fw-bold mb-3">Total Pembayaran</h5>
                <h3 class="text-success mb-4">Rp <?= number_format($total); ?></h3>

                <!-- Tombol bayar -->
                <button type="button" class="btn btn-success w-100 btn-lg" data-bs-toggle="modal" data-bs-target="#modalSukses">
                    <i class="fas fa-check-circle me-2"></i> Bayar Sekarang
                </button>

                <a href="keranjang.php" class="btn btn-outline-secondary w-100 mt-3">
                    Kembali ke Keranjang
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Modal Pembayaran Berhasil -->
<div class="modal fade" id="modalSukses" tabindex="-1" aria-labelledby="modalSuksesLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title" id="modalSuksesLabel"><i class="fas fa-check-circle me-2"></i>Pembayaran Berhasil</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        <p>Terima kasih telah berbelanja di TokoSegala!</p>
        <p>Total pembayaran: <strong class="text-success">Rp <?= number_format($total); ?></strong></p>
      </div>
      <div class="modal-footer">
        <a href="keranjang.php" class="btn btn-secondary">Kembali ke Keranjang</a>
        <a href="index.php" class="btn btn-success">Lanjut Belanja</a>
      </div>
    </div>
  </div>
</div>

<?php endif; ?>

<?php
$content = ob_get_clean();
$title = "Checkout";
include __DIR__ . '/../layout.php';
?>
