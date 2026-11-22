<?php
include "cek_login.php";

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=rekap_penjualan.xls");

$koneksi = mysqli_connect("localhost", "root", "", "db_penjualan");
if (mysqli_connect_error()) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

$mulai = mysqli_real_escape_string($koneksi, $_GET['tanggal_mulai'] ?? '');
$selesai = mysqli_real_escape_string($koneksi, $_GET['tanggal_selesai'] ?? '');
$total_pendapatan = 0;

$q = "SELECT DATE(waktu_transaksi) AS tgl, SUM(total) AS total_harian
      FROM transaksi WHERE waktu_transaksi BETWEEN '$mulai' AND '$selesai'
      GROUP BY DATE(waktu_transaksi) ORDER BY tgl ASC";
$res = mysqli_query($koneksi, $q);

$qp = "SELECT COUNT(DISTINCT pelanggan_id) AS jml FROM transaksi
       WHERE waktu_transaksi BETWEEN '$mulai' AND '$selesai'";
$rp = mysqli_fetch_assoc(mysqli_query($koneksi, $qp));
$total_pelanggan = $rp['jml'] ?? 0;
?>
<h2>Rekap Laporan Penjualan</h2>
<p>Periode: <?= htmlspecialchars($mulai); ?> sampai <?= htmlspecialchars($selesai); ?></p>

<table border="1">
    <tr>
        <th>No</th>
        <th>Total Pendapatan</th>
        <th>Tanggal Transaksi</th>
    </tr>
    <?php $no = 1; while ($r = mysqli_fetch_assoc($res)): ?>
        <?php $total_pendapatan += $r['total_harian']; ?>
        <tr>
            <td><?= $no++; ?></td>
            <td>Rp. <?= number_format($r['total_harian'], 0, ',', '.'); ?></td>
            <td><?= date('d M Y', strtotime($r['tgl'])); ?></td>
        </tr>
    <?php endwhile; ?>
    <tr>
        <td colspan="2"><b>Jumlah Pelanggan</b></td>
        <td><?= $total_pelanggan; ?> Orang</td>
    </tr>
    <tr>
        <td colspan="2"><b>Jumlah Pendapatan</b></td>
        <td>Rp. <?= number_format($total_pendapatan, 0, ',', '.'); ?></td>
    </tr>
</table>
