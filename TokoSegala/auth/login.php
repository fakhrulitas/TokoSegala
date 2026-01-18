<?php
session_start();
include __DIR__ . '/../config/koneksi.php'; // naik satu folder ke root

// Kalau user sudah login, redirect ke index
if(isset($_SESSION['login'])){
    header("Location: ../index.php"); // naik ke root
    exit;
}

// Mulai output buffer
ob_start();
?>

<div class="d-flex justify-content-center align-items-center" style="min-height:70vh;">
    <div class="card p-4" style="max-width:400px; width:100%;">
        <h4 class="text-center mb-4">Login</h4>
        <form action="login_proses.php" method="POST">
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" required />
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required />
            </div>
            <button type="submit" class="btn btn-cart w-100">
                <i class="fas fa-sign-in-alt me-1"></i> Login
            </button>
        </form>
        <div class="text-center mt-3">
            <a href="register.php">Belum punya akun? Daftar</a>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
$title = "Login";
include __DIR__ . '/../layout.php'; // naik satu folder ke root
?>
