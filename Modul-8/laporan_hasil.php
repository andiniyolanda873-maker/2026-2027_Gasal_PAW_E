<?php include "cek_login.php"; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Rekap Laporan Penjualan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        @media print {
            .no-print {
                display: none !important;
            }
        }
    </style>
</head>
<body>
    <?php include "navbar.php"; ?>
    <div class="container" style="margin-top: 30px;">
        <h2>
            Rekap Laporan Penjualan
            <small class="text-muted">
                <?= htmlspecialchars($_GET['tanggal_mulai'] ?? ''); ?> sampai <?= htmlspecialchars($_GET['tanggal_selesai'] ?? ''); ?>
            </small>
        </h2>
        <br>

        <div class="no-print">
            <a href="laporan.php" class="btn btn-primary">Kembali</a>
            <button onclick="window.print()" class="btn btn-warning">Cetak</button>
            <a href="export_excel.php?tanggal_mulai=<?= urlencode($_GET['tanggal_mulai'] ?? ''); ?>&tanggal_selesai=<?= urlencode($_GET['tanggal_selesai'] ?? ''); ?>" class="btn btn-warning">Excel</a>
        </div>

        <?php
        $koneksi = mysqli_connect("localhost", "root", "", "db_penjualan");
        if (mysqli_connect_error()) {
            die("Koneksi database gagal: " . mysqli_connect_error());
        }

        $labels = [];
        $data_total = [];
        $rekap = [];
        $total_pendapatan = 0;
        $total_pelanggan = 0;

        if (!empty($_GET['tanggal_mulai']) && !empty($_GET['tanggal_selesai'])) {
            $mulai = mysqli_real_escape_string($koneksi, $_GET['tanggal_mulai']);
            $selesai = mysqli_real_escape_string($koneksi, $_GET['tanggal_selesai']);

            $q = "SELECT DATE(waktu_transaksi) AS tgl, SUM(total) AS total_harian
                  FROM transaksi WHERE waktu_transaksi BETWEEN '$mulai' AND '$selesai'
                  GROUP BY DATE(waktu_transaksi) ORDER BY tgl ASC";
            $res = mysqli_query($koneksi, $q);
            while ($r = mysqli_fetch_assoc($res)) {
                $labels[] = $r['tgl'];
                $data_total[] = $r['total_harian'];
                $rekap[] = $r;
                $total_pendapatan += $r['total_harian'];
            }

            $qp = "SELECT COUNT(DISTINCT pelanggan_id) AS jml FROM transaksi
                   WHERE waktu_transaksi BETWEEN '$mulai' AND '$selesai'";
            $rp = mysqli_fetch_assoc(mysqli_query($koneksi, $qp));
            $total_pelanggan = $rp['jml'] ?? 0;
        }
        ?>

        <?php if (!empty($labels)): ?>
            <br><br>
            <div style="width: 700px; height: 350px;">
                <canvas id="myChart"></canvas>
            </div>
            <script>
                const ctx = document.getElementById('myChart').getContext('2d');
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: <?= json_encode($labels); ?>,
                        datasets: [{
                            label: 'Total',
                            data: <?= json_encode($data_total); ?>
                        }]
                    }
                });
            </script>
            <br>

            <table class="table table-bordered">
                <tr>
                    <th>No</th>
                    <th>Total Pendapatan</th>
                    <th>Tanggal Transaksi</th>
                </tr>
                <?php $no = 1; foreach ($rekap as $row): ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td>Rp. <?= number_format($row['total_harian'], 0, ',', '.'); ?></td>
                        <td><?= date('d M Y', strtotime($row['tgl'])); ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>

            <div class="row">
                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                            Jumlah Pelanggan
                            <b style="float: right;"><?= $total_pelanggan; ?> Orang</b>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                            Jumlah Pendapatan
                            <b style="float: right;">Rp. <?= number_format($total_pendapatan, 0, ',', '.'); ?></b>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <br><br>
            <div class="alert alert-warning">Tidak ada data transaksi pada tanggal tersebut</div>
        <?php endif; ?>
    </div>
</body>
</html>
