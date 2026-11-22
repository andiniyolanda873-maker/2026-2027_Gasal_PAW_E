<?php
include "cek_owner.php";
$koneksi = mysqli_connect("localhost", "root", "", "db_penjualan");
if (mysqli_connect_error()) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

$id = mysqli_real_escape_string($koneksi, $_GET['id'] ?? '');

mysqli_query($koneksi, "DELETE FROM barang WHERE id = '$id'");
header("Location: barang.php");
exit;
