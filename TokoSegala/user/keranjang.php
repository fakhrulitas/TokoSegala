<?php
// keranjang.php

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

$cart_items = [];
while ($row = mysqli_fetch_assoc($result)) {
    $cart_items[] = $row;
}

// Output buffer untuk layout
ob_start();
?>

<h2 class="mb-4">Keranjang Belanja</h2>

<?php if (empty($cart_items)): ?>
    <div class="alert alert-warning text-center">
        Keranjang Anda kosong.
    </div>
<?php else: ?>

<div class="table-responsive">
<table class="table align-middle">
    <thead>
        <tr>
            <th></th>
            <th>Produk</th>
            <th>Harga</th>
            <th>Jumlah</th>
            <th>Subtotal</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($cart_items as $item): 
            $subtotal = $item['harga'] * $item['qty'];
        ?>
        <tr>
            <td>
                <input 
                    type="checkbox"
                    class="select-item"
                    data-id="<?= $item['id_cart']; ?>"
                    data-subtotal="<?= $subtotal; ?>"
                />
            </td>
            <td>
                <img src="../assets/images/<?= $item['gambar']; ?>" style="height:50px" class="me-2">
                <?= $item['nama_produk']; ?>
            </td>
            <td>Rp <?= number_format($item['harga']); ?></td>
            <td>
                <a href="update_keranjang.php?id=<?= $item['id_cart']; ?>&action=decrease"
                   class="btn btn-sm btn-outline-secondary">−</a>

                <span class="mx-2"><?= $item['qty']; ?></span>

                <a href="update_keranjang.php?id=<?= $item['id_cart']; ?>&action=increase"
                   class="btn btn-sm btn-outline-secondary">+</a>
            </td>
            <td class="subtotal">Rp <?= number_format($subtotal); ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="4" class="text-end fw-bold">Total</td>
            <td id="total" class="fw-bold">Rp 0</td>
        </tr>
    </tfoot>
</table>
</div>

<div class="d-flex justify-content-end mt-4">
    <a href="checkout.php" id="btnCheckout" class="btn btn-success btn-lg disabled">
        <i class="fas fa-credit-card me-2"></i> Checkout
    </a>
</div>

<?php endif; ?>

<!-- ===================== -->
<!-- JAVASCRIPT (CACHE) -->
<!-- ===================== -->
<script>
const STORAGE_KEY = 'checked_cart_items';

let checkedItems = JSON.parse(localStorage.getItem(STORAGE_KEY)) || [];

const checkboxes = document.querySelectorAll('.select-item');
const totalField = document.getElementById('total');
const btnCheckout = document.getElementById('btnCheckout');

// Restore checkbox
checkboxes.forEach(cb => {
    if (checkedItems.includes(cb.dataset.id)) {
        cb.checked = true;
    }
});

function updateTotal() {
    let total = 0;
    let checkedCount = 0;

    checkboxes.forEach(cb => {
        if (cb.checked) {
            total += parseInt(cb.dataset.subtotal);
            checkedCount++;
        }
    });

    totalField.textContent = 'Rp ' + total.toLocaleString('id-ID');

    if (checkedCount > 0) {
        btnCheckout.classList.remove('disabled');
    } else {
        btnCheckout.classList.add('disabled');
    }
}

// Save to localStorage
checkboxes.forEach(cb => {
    cb.addEventListener('change', () => {
        const id = cb.dataset.id;

        if (cb.checked) {
            if (!checkedItems.includes(id)) checkedItems.push(id);
        } else {
            checkedItems = checkedItems.filter(item => item !== id);
        }

        localStorage.setItem(STORAGE_KEY, JSON.stringify(checkedItems));
        updateTotal();
    });
});

updateTotal();
</script>

<?php
$content = ob_get_clean();
$title = "Keranjang Belanja";
include __DIR__ . '/../layout.php';
?>
