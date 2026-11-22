<?php
include "cek_owner.php";
$koneksi = mysqli_connect("localhost", "root", "", "db_penjualan");
if (mysqli_connect_error()) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

$id = $_GET['id'] ?? '';
$data = [];
$pesan = '';

if ($id != '') {
    $id_db = mysqli_real_escape_string($koneksi, $id);
    $res = mysqli_query($koneksi, "SELECT * FROM barang WHERE id = '$id_db'");
    $data = mysqli_fetch_assoc($res);
    if (!$data) {
        header("Location: barang.php");
        exit;
    }
}

if (isset($_POST['simpan'])) {
    $nama = mysqli_real_escape_string($koneksi, trim($_POST['nama']));
    $harga = (int) $_POST['harga'];
    $stok = (int) $_POST['stok'];

    if ($id == '') {
        $kode = mysqli_real_escape_string($koneksi, trim($_POST['id']));
        $cek = mysqli_query($koneksi, "SELECT id FROM barang WHERE id = '$kode'");
        if (mysqli_num_rows($cek) > 0) {
            $pesan = "Kode sudah dipakai";
            $data = $_POST;
        } else {
            mysqli_query($koneksi, "INSERT INTO barang (id, nama, harga, stok) VALUES ('$kode', '$nama', $harga, $stok)");
            header("Location: barang.php");
            exit;
        }
    } else {
        mysqli_query($koneksi, "UPDATE barang SET nama = '$nama', harga = $harga, stok = $stok WHERE id = '$id_db'");
        header("Location: barang.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Form Barang</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <?php include "navbar.php"; ?>
    <div class="container" style="margin-top: 30px;">
        <h2><?= $id == '' ? 'Tambah' : 'Edit'; ?> Barang</h2>
        <br>
        <?php if ($pesan != ''): ?>
            <div class="alert alert-danger"><?= $pesan; ?></div>
        <?php endif; ?>
        <div class="card" style="max-width: 500px;">
            <div class="card-body">
                <form method="POST">
                    <label>Kode</label>
                    <input type="text" name="id" class="form-control" value="<?= htmlspecialchars($data['id'] ?? ''); ?>" maxlength="20" required <?= $id != '' ? 'readonly' : ''; ?>>
                    <br>
                    <label>Nama Barang</label>
                    <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($data['nama'] ?? ''); ?>" required>
                    <br>
                    <label>Harga</label>
                    <input type="number" name="harga" class="form-control" value="<?= htmlspecialchars($data['harga'] ?? ''); ?>" min="0" required>
                    <br>
                    <label>Stok</label>
                    <input type="number" name="stok" class="form-control" value="<?= htmlspecialchars($data['stok'] ?? ''); ?>" min="0" required>
                    <br>
                    <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                    <a href="barang.php" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
