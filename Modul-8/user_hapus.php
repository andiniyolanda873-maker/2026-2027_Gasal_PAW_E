<?php
include "cek_owner.php";
$koneksi = mysqli_connect("localhost", "root", "", "db_penjualan");
if (mysqli_connect_error()) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

$id = (int) ($_GET['id'] ?? 0);

if ($id == $_SESSION['id_user']) {
    header("Location: user.php?pesan=sendiri");
    exit;
}

mysqli_query($koneksi, "DELETE FROM user WHERE id = $id");
header("Location: user.php");
exit;
