<?php include "cek_login.php"; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Laporan Penjualan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <?php include "navbar.php"; ?>
    <div class="container" style="max-width: 500px; margin-top: 60px;">
        <div class="card">
            <div class="card-header">
                <h4>Filter Laporan Penjualan</h4>
            </div>
            <div class="card-body">
                <form method="GET" action="laporan_hasil.php">
                    <label>Tanggal Mulai</label>
                    <input type="date" name="tanggal_mulai" class="form-control" required>
                    <br>
                    <label>Tanggal Selesai</label>
                    <input type="date" name="tanggal_selesai" class="form-control" required>
                    <br>
                    <button type="submit" class="btn btn-primary">Tampilkan</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
