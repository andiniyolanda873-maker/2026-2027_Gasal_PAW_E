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
    $res = mysqli_query($koneksi, "SELECT * FROM supplier WHERE id = '$id_db'");
    $data = mysqli_fetch_assoc($res);
    if (!$data) {
        header("Location: supplier.php");
        exit;
    }
}

if (isset($_POST['simpan'])) {
    $nama = mysqli_real_escape_string($koneksi, trim($_POST['nama']));
    $telp = mysqli_real_escape_string($koneksi, trim($_POST['telp']));
    $alamat = mysqli_real_escape_string($koneksi, trim($_POST['alamat']));

    if ($id == '') {
        $kode = mysqli_real_escape_string($koneksi, trim($_POST['id']));
        $cek = mysqli_query($koneksi, "SELECT id FROM supplier WHERE id = '$kode'");
        if (mysqli_num_rows($cek) > 0) {
            $pesan = "Kode sudah dipakai";
            $data = $_POST;
        } else {
            mysqli_query($koneksi, "INSERT INTO supplier (id, nama, telp, alamat) VALUES ('$kode', '$nama', '$telp', '$alamat')");
            header("Location: supplier.php");
            exit;
        }
    } else {
        mysqli_query($koneksi, "UPDATE supplier SET nama = '$nama', telp = '$telp', alamat = '$alamat' WHERE id = '$id_db'");
        header("Location: supplier.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Form Supplier</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <?php include "navbar.php"; ?>
    <div class="container" style="margin-top: 30px;">
        <h2><?= $id == '' ? 'Tambah' : 'Edit'; ?> Supplier</h2>
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
                    <label>Nama Supplier</label>
                    <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($data['nama'] ?? ''); ?>" required>
                    <br>
                    <label>Telepon</label>
                    <input type="text" name="telp" class="form-control" value="<?= htmlspecialchars($data['telp'] ?? ''); ?>" required>
                    <br>
                    <label>Alamat</label>
                    <textarea name="alamat" class="form-control" required><?= htmlspecialchars($data['alamat'] ?? ''); ?></textarea>
                    <br>
                    <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                    <a href="supplier.php" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
