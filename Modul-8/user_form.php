<?php
include "cek_owner.php";
$koneksi = mysqli_connect("localhost", "root", "", "db_penjualan");
if (mysqli_connect_error()) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

$id = (int) ($_GET['id'] ?? 0);
$data = [];
$pesan = '';

if ($id != 0) {
    $res = mysqli_query($koneksi, "SELECT * FROM user WHERE id = $id");
    $data = mysqli_fetch_assoc($res);
    if (!$data) {
        header("Location: user.php");
        exit;
    }
}

if (isset($_POST['simpan'])) {
    $username = mysqli_real_escape_string($koneksi, trim($_POST['username']));
    $nama = mysqli_real_escape_string($koneksi, trim($_POST['nama']));
    $level = (int) $_POST['level'];
    $password = $_POST['password'];

    $cek = mysqli_query($koneksi, "SELECT id FROM user WHERE username = '$username' AND id != $id");

    if (mysqli_num_rows($cek) > 0) {
        $pesan = "Username sudah dipakai";
        $data = $_POST;
    } elseif ($level != 1 && $level != 2) {
        $pesan = "Level tidak valid";
        $data = $_POST;
    } elseif ($id == 0 && $password == '') {
        $pesan = "Password harus diisi";
        $data = $_POST;
    } else {
        if ($id == 0) {
            $hash = md5($password);
            mysqli_query($koneksi, "INSERT INTO user (username, password, nama, level) VALUES ('$username', '$hash', '$nama', $level)");
        } else {
            if ($password != '') {
                $hash = md5($password);
                mysqli_query($koneksi, "UPDATE user SET username = '$username', password = '$hash', nama = '$nama', level = $level WHERE id = $id");
            } else {
                mysqli_query($koneksi, "UPDATE user SET username = '$username', nama = '$nama', level = $level WHERE id = $id");
            }
            if ($id == $_SESSION['id_user']) {
                $_SESSION['username'] = trim($_POST['username']);
                $_SESSION['nama'] = trim($_POST['nama']);
                $_SESSION['level'] = $level;
            }
        }
        header("Location: user.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Form User</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <?php include "navbar.php"; ?>
    <div class="container" style="margin-top: 30px;">
        <h2><?= $id == 0 ? 'Tambah' : 'Edit'; ?> User</h2>
        <br>
        <?php if ($pesan != ''): ?>
            <div class="alert alert-danger"><?= $pesan; ?></div>
        <?php endif; ?>
        <div class="card" style="max-width: 500px;">
            <div class="card-body">
                <form method="POST">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" value="<?= htmlspecialchars($data['username'] ?? ''); ?>" required>
                    <br>
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" <?= $id == 0 ? 'required' : ''; ?>>
                    <?php if ($id != 0): ?>
                        <small class="text-muted">Kosongkan jika password tidak diubah</small>
                    <?php endif; ?>
                    <br>
                    <label>Nama</label>
                    <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($data['nama'] ?? ''); ?>" required>
                    <br>
                    <label>Level</label>
                    <select name="level" class="form-select" required>
                        <option value="1" <?= ($data['level'] ?? '') == 1 ? 'selected' : ''; ?>>1 - Owner</option>
                        <option value="2" <?= ($data['level'] ?? 2) == 2 ? 'selected' : ''; ?>>2 - Kasir</option>
                    </select>
                    <br>
                    <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                    <a href="user.php" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
