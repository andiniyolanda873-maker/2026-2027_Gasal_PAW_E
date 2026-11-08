<?php
$koneksi = mysqli_connect("localhost", "root", "", "penjualan");

if (mysqli_connect_error()) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Data Barang</title>
    <link rel="stylesheet" href="style_modul6.css">
</head>
<body>
    <h1>Data Barang</h1>
    <a href="transaksi.php">Ke Data Transaksi</a>
    <br><br>
    <table>
        <tr>
            <th>No</th>
            <th>Kode</th>
            <th>Nama Barang</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Supplier</th>
            <th>Aksi</th>
        </tr>
        <?php
        $query = "SELECT barang.*, supplier.nama AS nama_supplier
                  FROM barang
                  JOIN supplier ON barang.supplier_id = supplier.id";
        $result = mysqli_query($koneksi, $query);

        $no = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $no . "</td>";
            echo "<td>" . $row['kode_barang'] . "</td>";
            echo "<td>" . $row['nama_barang'] . "</td>";
            echo "<td>" . $row['harga'] . "</td>";
            echo "<td>" . $row['stok'] . "</td>";
            echo "<td>" . $row['nama_supplier'] . "</td>";
            echo "<td><a href='hapus_barang.php?id=" . $row['id'] . "' onclick=\"return confirm('Yakin hapus barang ini?')\">Hapus</a></td>";
            echo "</tr>";
            $no++;
        }

        mysqli_close($koneksi);
        ?>
    </table>
</body>
</html>
