<?php
include "koneksi.php";

$id = $_GET['id'];

if (isset($_POST['update'])) {
    $nama = $_POST['nama'];
    $telp = $_POST['telp'];
    $alamat = $_POST['alamat'];

    mysqli_query($koneksi, "UPDATE supplier SET nama='$nama', telp='$telp', alamat='$alamat' WHERE id=$id");
    header("location: supplier.php");
}
?>
<html>
<head>
    <title>Edit Data Supplier</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Edit Data Master Supplier</h2>

    <form method="post">
        <table class="form">
            <tr>
                <td class="label">Nama</td>
                <td><input type="text" name="nama" size="40"></td>
            </tr>
            <tr>
                <td class="label">Telp</td>
                <td><input type="text" name="telp" size="22"></td>
            </tr>
            <tr>
                <td class="label">Alamat</td>
                <td><input type="text" name="alamat" size="22"></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="submit" name="update" value="Update" class="hijau">
                    <a class="merah" href="supplier.php">Batal</a>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>
