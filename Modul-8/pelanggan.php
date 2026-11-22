<?php
include "cek_owner.php";
$koneksi = mysqli_connect("localhost", "root", "", "db_penjualan");
if (mysqli_connect_error()) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

$res = mysqli_query($koneksi, "SELECT * FROM pelanggan ORDER BY id");
$pesan = $_GET['pesan'] ?? '';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Data Pelanggan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <?php include "navbar.php"; ?>
    <div class="container" style="margin-top: 30px;">
        <div class="d-flex justify-content-between">
            <h2>Data Pelanggan</h2>
            <div>
                <a href="pelanggan_form.php" class="btn btn-primary">Tambah Pelanggan</a>
            </div>
        </div>
        <br>
        <?php if ($pesan == 'dipakai'): ?>
            <div class="alert alert-danger">Pelanggan tidak bisa dihapus karena sudah dipakai di transaksi</div>
        <?php endif; ?>
        <table class="table table-bordered">
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Nama Pelanggan</th>
                <th>Jenis Kelamin</th>
                <th>Telepon</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
            <?php $no = 1; while ($r = mysqli_fetch_assoc($res)): ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= htmlspecialchars($r['id']); ?></td>
                    <td><?= htmlspecialchars($r['nama']); ?></td>
                    <td><?= $r['jenis_kelamin'] == 'L' ? 'Laki-laki' : 'Perempuan'; ?></td>
                    <td><?= htmlspecialchars($r['telp']); ?></td>
                    <td><?= htmlspecialchars($r['alamat']); ?></td>
                    <td>
                        <a href="pelanggan_form.php?id=<?= urlencode($r['id']); ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="pelanggan_hapus.php?id=<?= urlencode($r['id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus data ini?')">Hapus</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>
