<?php
$koneksi = mysqli_connect("localhost", "root", "", "penjualan");

if (mysqli_connect_error()) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

if (!isset($_GET['id'])) {
    header("Location: transaksi.php");
    exit;
}

$id = $_GET['id'];

if (isset($_POST['simpan'])) {
    $barang_id = $_POST['barang_id'];
    $qty = $_POST['qty'];

    if ($barang_id == "" || $qty < 1) {
        echo "<script>alert('Barang dan qty harus diisi dengan benar!');</script>";
    } else {
        $query_cek = "SELECT * FROM transaksi_detail
                      WHERE transaksi_id = '$id' AND barang_id = '$barang_id'";
        $result_cek = mysqli_query($koneksi, $query_cek);

        if (mysqli_num_rows($result_cek) > 0) {
            echo "<script>alert('Barang sudah ada di transaksi ini!');</script>";
        } else {
            $query_harga = "SELECT harga FROM barang WHERE id = '$barang_id'";
            $result_harga = mysqli_query($koneksi, $query_harga);
            $data_harga = mysqli_fetch_assoc($result_harga);
            $harga = $data_harga['harga'];

            $query_simpan = "INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty)
                             VALUES ('$id', '$barang_id', '$harga', '$qty')";
            mysqli_query($koneksi, $query_simpan);

            $query_total = "SELECT SUM(harga * qty) AS total
                            FROM transaksi_detail
                            WHERE transaksi_id = '$id'";
            $result_total = mysqli_query($koneksi, $query_total);
            $data_total = mysqli_fetch_assoc($result_total);
            $total = $data_total['total'];

            $query_update = "UPDATE transaksi SET total = '$total' WHERE id = '$id'";
            mysqli_query($koneksi, $query_update);

            header("Location: detail_transaksi.php?id=" . $id);
            exit;
        }
    }
}

$query_master = "SELECT transaksi.*, pelanggan.nama
                 FROM transaksi
                 JOIN pelanggan ON transaksi.pelanggan_id = pelanggan.id
                 WHERE transaksi.id = '$id'";
$result_master = mysqli_query($koneksi, $query_master);
$master = mysqli_fetch_assoc($result_master);

if (!$master) {
    die("Data transaksi tidak ditemukan");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Detail Transaksi</title>
    <link rel="stylesheet" href="style_modul6.css">
</head>
<body>
    <h1>Detail Transaksi</h1>
    <a href="transaksi.php">Kembali</a>

    <h3>Data Transaksi (Master)</h3>
    <table>
        <tr>
            <td>ID Transaksi</td>
            <td>: <?php echo $master['id']; ?></td>
        </tr>
        <tr>
            <td>Tanggal</td>
            <td>: <?php echo $master['waktu_transaksi']; ?></td>
        </tr>
        <tr>
            <td>Pelanggan</td>
            <td>: <?php echo $master['nama']; ?></td>
        </tr>
        <tr>
            <td>Keterangan</td>
            <td>: <?php echo $master['keterangan']; ?></td>
        </tr>
        <tr>
            <td>Total</td>
            <td>: <?php echo $master['total']; ?></td>
        </tr>
    </table>

    <h3>Tambah Barang</h3>
    <form method="post" action="">
        Barang :
        <select name="barang_id">
            <option value="">-- Pilih Barang --</option>
            <?php
            $query_barang = "SELECT id, nama_barang, harga FROM barang
                             WHERE id NOT IN (SELECT barang_id FROM transaksi_detail
                                              WHERE transaksi_id = '$id')";
            $result_barang = mysqli_query($koneksi, $query_barang);

            while ($b = mysqli_fetch_assoc($result_barang)) {
                echo "<option value='" . $b['id'] . "'>" . $b['nama_barang'] . " - Rp " . $b['harga'] . "</option>";
            }
            ?>
        </select>
        Qty :
        <input type="number" name="qty" min="1" value="1">
        <input type="submit" name="simpan" value="Simpan">
    </form>

    <h3>Daftar Barang (Detail)</h3>
    <table>
        <tr>
            <th>No</th>
            <th>Nama Barang</th>
            <th>Harga</th>
            <th>Qty</th>
            <th>Subtotal</th>
        </tr>
        <?php
        $query_detail = "SELECT transaksi_detail.*, barang.nama_barang
                         FROM transaksi_detail
                         JOIN barang ON transaksi_detail.barang_id = barang.id
                         WHERE transaksi_detail.transaksi_id = '$id'";
        $result_detail = mysqli_query($koneksi, $query_detail);

        $no = 1;
        while ($row = mysqli_fetch_assoc($result_detail)) {
            $subtotal = $row['harga'] * $row['qty'];
            echo "<tr>";
            echo "<td>" . $no . "</td>";
            echo "<td>" . $row['nama_barang'] . "</td>";
            echo "<td>" . $row['harga'] . "</td>";
            echo "<td>" . $row['qty'] . "</td>";
            echo "<td>" . $subtotal . "</td>";
            echo "</tr>";
            $no++;
        }

        mysqli_close($koneksi);
        ?>
    </table>
</body>
</html>
