<?php
session_start();

if (isset($_SESSION['login'])) {
    header("Location: index.php");
    exit;
}

$koneksi = mysqli_connect("localhost", "root", "", "db_penjualan");
if (mysqli_connect_error()) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

if (empty($_POST['username']) || empty($_POST['password'])) {
    header("Location: login.php?pesan=kosong");
    exit;
}

$username = mysqli_real_escape_string($koneksi, $_POST['username']);
$password = md5($_POST['password']);

$q = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
$res = mysqli_query($koneksi, $q);

if (mysqli_num_rows($res) == 1) {
    $r = mysqli_fetch_assoc($res);
    $_SESSION['login'] = true;
    $_SESSION['id_user'] = $r['id'];
    $_SESSION['username'] = $r['username'];
    $_SESSION['nama'] = $r['nama'];
    $_SESSION['level'] = $r['level'];
    header("Location: index.php");
} else {
    header("Location: login.php?pesan=gagal");
}
exit;
