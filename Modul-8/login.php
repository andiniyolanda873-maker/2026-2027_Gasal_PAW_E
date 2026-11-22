<?php
session_start();

if (isset($_SESSION['login'])) {
    header("Location: index.php");
    exit;
}

$pesan = $_GET['pesan'] ?? '';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login Sistem Penjualan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container" style="max-width: 400px; margin-top: 80px;">
        <div class="card">
            <div class="card-header text-white" style="background-color: #0b3d91;">
                <h4>Login Sistem Penjualan</h4>
            </div>
            <div class="card-body">
                <?php if ($pesan == 'kosong'): ?>
                    <div class="alert alert-danger">Username dan password harus diisi</div>
                <?php elseif ($pesan == 'gagal'): ?>
                    <div class="alert alert-danger">Username atau password salah</div>
                <?php endif; ?>
                <form method="POST" action="proses-login.php">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" placeholder="Masukkan username" required autofocus>
                    <br>
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
                    <br>
                    <button type="submit" name="login" class="btn btn-primary">Login</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
