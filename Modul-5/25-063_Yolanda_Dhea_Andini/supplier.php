<?php
include "koneksi.php";
$data = mysqli_query($koneksi, "SELECT * FROM supplier");
?>
<html>
<head>
    <title>Data Master Supplier</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <a class="hijau tambah" href="supplier_tambah.php">Tambah Data</a>
    <h2>Data Master Supplier</h2>

    <table class="data">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Telp</th>
            <th>Alamat</th>
            <th>Tindakan</th>
        </tr>
        <?php
        $no = 1;
        while ($row = mysqli_fetch_array($data)) {
            echo "<tr>";
            echo "<td>" . $no . "</td>";
            echo "<td>" . $row['nama'] . "</td>";
            echo "<td>" . $row['telp'] . "</td>";
            echo "<td>" . $row['alamat'] . "</td>";
            echo "<td>";
            echo "<a class='oranye' href='supplier_edit.php?id=" . $row['id'] . "'>Edit</a> ";
            echo "<a class='merah' href='supplier_hapus.php?id=" . $row['id'] . "' onclick=\"return confirm('Anda yakin akan menghapus supplier ini?')\">Hapus</a>";
            echo "</td>";
            echo "</tr>";
            $no++;
        }
        ?>
    </table>
</body>
</html>
