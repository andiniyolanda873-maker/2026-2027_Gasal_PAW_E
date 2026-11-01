<?php
include "koneksi.php";

$id = $_GET['id'];

mysqli_query($koneksi, "DELETE FROM supplier WHERE id=$id");
header("location: supplier.php");
?>
