<?php
include "cek_owner.php";
$koneksi = mysqli_connect("localhost", "root", "", "db_penjualan");
if (mysqli_connect_error()) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

$res = mysqli_query($koneksi, "SELECT * FROM user ORDER BY id");
$pesan = $_GET['pesan'] ?? '';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Data User</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <?php include "navbar.php"; ?>
    <div class="container" style="margin-top: 30px;">
        <div class="d-flex justify-content-between">
            <h2>Data User</h2>
            <div>
                <a href="user_form.php" class="btn btn-primary">Tambah User</a>
            </div>
        </div>
        <br>
        <?php if ($pesan == 'sendiri'): ?>
            <div class="alert alert-danger">Akun yang sedang login tidak bisa dihapus</div>
        <?php elseif ($pesan == 'dipakai'): ?>
            <div class="alert alert-danger">User tidak bisa dihapus karena masih dipakai</div>
        <?php endif; ?>
        <table class="table table-bordered">
            <tr>
                <th>No</th>
                <th>Username</th>
                <th>Nama</th>
                <th>Level</th>
                <th>Aksi</th>
            </tr>
            <?php $no = 1; while ($r = mysqli_fetch_assoc($res)): ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= htmlspecialchars($r['username']); ?></td>
                    <td><?= htmlspecialchars($r['nama']); ?></td>
                    <td><?= $r['level'] == 1 ? 'Owner' : 'Kasir'; ?></td>
                    <td>
                        <a href="user_form.php?id=<?= $r['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="user_hapus.php?id=<?= $r['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus data ini?')">Hapus</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>
