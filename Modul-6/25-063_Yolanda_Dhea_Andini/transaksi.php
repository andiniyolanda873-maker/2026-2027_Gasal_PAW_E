<?php
$koneksi = mysqli_connect("localhost", "root", "", "penjualan");

if (mysqli_connect_error()) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

if (isset($_POST['simpan'])) {
    $tanggal = $_POST['tanggal'];
    $keterangan = $_POST['keterangan'];
    $pelanggan_id = $_POST['pelanggan_id'];

    $query_tambah = "INSERT INTO transaksi (waktu_transaksi, keterangan, total, pelanggan_id)
                     VALUES ('$tanggal', '$keterangan', 0, '$pelanggan_id')";
    mysqli_query($koneksi, $query_tambah);

    $id_baru = mysqli_insert_id($koneksi);
    header("Location: detail_transaksi.php?id=" . $id_baru);
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Data Transaksi</title>
    <link rel="stylesheet" href="style_modul6.css">
</head>
<body>
    <h1>Data Transaksi</h1>
    <a href="barang.php">Ke Data Barang</a>

    <h3>Tambah Transaksi</h3>
    <form method="post" action="">
        Tanggal :
        <input type="date" name="tanggal" required>
        Pelanggan :
        <select name="pelanggan_id" required>
            <option value="">-- Pilih Pelanggan --</option>
            <?php
            $result_pelanggan = mysqli_query($koneksi, "SELECT id, nama FROM pelanggan");
            while ($p = mysqli_fetch_assoc($result_pelanggan)) {
                echo "<option value='" . $p['id'] . "'>" . $p['nama'] . "</option>";
            }
            ?>
        </select>
        Keterangan :
        <input type="text" name="keterangan">
        <input type="submit" name="simpan" value="Simpan">
    </form>

    <h3>Daftar Transaksi</h3>
    <table>
        <tr>
            <th>ID</th>
            <th>Tanggal</th>
            <th>Pelanggan</th>
            <th>Keterangan</th>
            <th>Total</th>
            <th>Aksi</th>
        </tr>
        <?php
        $query = "SELECT transaksi.*, pelanggan.nama
                  FROM transaksi
                  JOIN pelanggan ON transaksi.pelanggan_id = pelanggan.id
                  ORDER BY transaksi.id";
        $result = mysqli_query($koneksi, $query);

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['waktu_transaksi'] . "</td>";
            echo "<td>" . $row['nama'] . "</td>";
            echo "<td>" . $row['keterangan'] . "</td>";
            echo "<td>" . $row['total'] . "</td>";
            echo "<td><a href='detail_transaksi.php?id=" . $row['id'] . "'>Lihat Detail</a></td>";
            echo "</tr>";
        }

        mysqli_close($koneksi);
        ?>
    </table>
</body>
</html>
