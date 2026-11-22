<?php
include "cek_login.php";
$koneksi = mysqli_connect("localhost", "root", "", "db_penjualan");
if (mysqli_connect_error()) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

$pesan = $_GET['pesan'] ?? '';
$error = '';

if (isset($_POST['simpan'])) {
    $tanggal = mysqli_real_escape_string($koneksi, $_POST['waktu_transaksi']);
    $pelanggan_id = mysqli_real_escape_string($koneksi, $_POST['pelanggan_id']);
    $keterangan = mysqli_real_escape_string($koneksi, trim($_POST['keterangan']));
    $total = (int) $_POST['total'];

    $cek = mysqli_query($koneksi, "SELECT id FROM pelanggan WHERE id = '$pelanggan_id'");

    if (mysqli_num_rows($cek) == 0) {
        $error = "Pelanggan tidak ditemukan";
    } elseif ($total < 1) {
        $error = "Total harus lebih dari 0";
    } else {
        mysqli_query($koneksi, "INSERT INTO transaksi (waktu_transaksi, keterangan, total, pelanggan_id) VALUES ('$tanggal', '$keterangan', $total, '$pelanggan_id')");
        header("Location: transaksi.php?pesan=sukses");
        exit;
    }
}

$pelanggan = mysqli_query($koneksi, "SELECT * FROM pelanggan ORDER BY nama");
$res = mysqli_query($koneksi, "SELECT t.*, p.nama FROM transaksi t JOIN pelanggan p ON t.pelanggan_id = p.id ORDER BY t.waktu_transaksi DESC, t.id DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Transaksi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <?php include "navbar.php"; ?>
    <div class="container" style="margin-top: 30px;">
        <h2>Transaksi</h2>
        <br>
        <?php if ($pesan == 'sukses'): ?>
            <div class="alert alert-success">Transaksi berhasil disimpan</div>
        <?php endif; ?>
        <?php if ($error != ''): ?>
            <div class="alert alert-danger"><?= $error; ?></div>
        <?php endif; ?>
        <div class="card">
            <div class="card-header">
                <h5>Tambah Transaksi</h5>
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="row">
                        <div class="col-3">
                            <label>Tanggal</label>
                            <input type="date" name="waktu_transaksi" class="form-control" value="<?= date('Y-m-d'); ?>" required>
                        </div>
                        <div class="col-3">
                            <label>Pelanggan</label>
                            <select name="pelanggan_id" class="form-select" required>
                                <option value="">- Pilih -</option>
                                <?php while ($p = mysqli_fetch_assoc($pelanggan)): ?>
                                    <option value="<?= htmlspecialchars($p['id']); ?>"><?= htmlspecialchars($p['nama']); ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="col-3">
                            <label>Keterangan</label>
                            <input type="text" name="keterangan" class="form-control" value="Pembelian barang" required>
                        </div>
                        <div class="col-3">
                            <label>Total</label>
                            <input type="number" name="total" class="form-control" min="1" required>
                        </div>
                    </div>
                    <br>
                    <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
        <br>
        <table class="table table-bordered">
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Pelanggan</th>
                <th>Keterangan</th>
                <th>Total</th>
            </tr>
            <?php $no = 1; while ($r = mysqli_fetch_assoc($res)): ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= date('d M Y', strtotime($r['waktu_transaksi'])); ?></td>
                    <td><?= htmlspecialchars($r['nama']); ?></td>
                    <td><?= htmlspecialchars($r['keterangan']); ?></td>
                    <td>Rp. <?= number_format($r['total'], 0, ',', '.'); ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>
