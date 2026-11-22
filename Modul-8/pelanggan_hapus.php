<?php
include "cek_owner.php";
$koneksi = mysqli_connect("localhost", "root", "", "db_penjualan");
if (mysqli_connect_error()) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

$id = mysqli_real_escape_string($koneksi, $_GET['id'] ?? '');

$cek = mysqli_query($koneksi, "SELECT COUNT(*) AS jml FROM transaksi WHERE pelanggan_id = '$id'");
$r = mysqli_fetch_assoc($cek);

if ($r['jml'] > 0) {
    header("Location: pelanggan.php?pesan=dipakai");
    exit;
}

mysqli_query($koneksi, "DELETE FROM pelanggan WHERE id = '$id'");
header("Location: pelanggan.php");
exit;
