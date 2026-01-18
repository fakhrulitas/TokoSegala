<?php
session_start();
include __DIR__ . '/../config/koneksi.php'; // naik satu folder ke root

// Kalau user sudah login, redirect ke index
if(isset($_SESSION['login'])){
    header("Location: ../index.php"); // naik ke root
    exit;
}

// Mulai output buffer untuk content
ob_start();
?>

<div class="row justify-content-center mt-5">
    <div class="col-md-4">
        <div class="card shadow rounded-4">
            <div class="card-body">
                <h4 class="text-center fw-bold mb-4">Daftar Akun</h4>
                <form action="register_proses.php" method="POST">
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" placeholder="Masukkan username" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
                    </div>
                    <button type="submit" class="btn btn-cart w-100 btn-lg">Daftar</button>
                </form>
                <div class="text-center mt-3">
                    <a href="login.php" class="text-decoration-none">Sudah punya akun? Login</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
$title = "Login";
include __DIR__ . '/../layout.php'; // naik satu folder ke root
?>
