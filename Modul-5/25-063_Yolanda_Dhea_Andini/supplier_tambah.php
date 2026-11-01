<?php
include "koneksi.php";

if (isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    $telp = $_POST['telp'];
    $alamat = $_POST['alamat'];

    mysqli_query($koneksi, "INSERT INTO supplier (nama, telp, alamat) VALUES ('$nama', '$telp', '$alamat')");
    header("location: supplier.php");
}
?>
<html>
<head>
    <title>Tambah Data Supplier</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Tambah Data Master Supplier Baru</h2>

    <form method="post">
        <table class="form">
            <tr>
                <td class="label">Nama</td>
                <td><input type="text" name="nama" placeholder="Nama" size="40"></td>
            </tr>
            <tr>
                <td class="label">Telp</td>
                <td><input type="text" name="telp" placeholder="telp" size="22"></td>
            </tr>
            <tr>
                <td class="label">Alamat</td>
                <td><input type="text" name="alamat" placeholder="alamat" size="22"></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="submit" name="simpan" value="Simpan" class="hijau">
                    <a class="merah" href="supplier.php">Batal</a>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>
