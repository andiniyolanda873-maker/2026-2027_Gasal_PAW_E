<?php
include "cek_login.php";

$koneksi = mysqli_connect("localhost", "root", "", "db_penjualan");
if (mysqli_connect_error()) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

$jml_pelanggan = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS jml FROM pelanggan"));
$jml_transaksi = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS jml FROM transaksi"));
$jml_pendapatan = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT SUM(total) AS jml FROM transaksi"));
?>
<!DOCTYPE html>
<html>
<head>
    <title>Home - Sistem Penjualan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <?php include "navbar.php"; ?>
    <div class="container" style="margin-top: 30px;">
        <h2>Selamat datang, <?= htmlspecialchars($_SESSION['nama']); ?></h2>
        <p>Anda login sebagai <b><?= $_SESSION['level'] == 1 ? 'Owner' : 'Kasir'; ?></b></p>
        <br>
        <div class="row">
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        Jumlah Pelanggan
                        <b style="float: right;"><?= $jml_pelanggan['jml']; ?></b>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        Jumlah Transaksi
                        <b style="float: right;"><?= $jml_transaksi['jml']; ?></b>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        Total Pendapatan
                        <b style="float: right;">Rp. <?= number_format($jml_pendapatan['jml'] ?? 0, 0, ',', '.'); ?></b>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
