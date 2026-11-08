<?php
$koneksi = mysqli_connect("localhost", "root", "", "penjualan");

if (mysqli_connect_error()) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

$id = $_GET['id'];

$query_cek = "SELECT * FROM transaksi_detail WHERE barang_id = '$id'";
$result_cek = mysqli_query($koneksi, $query_cek);

if (mysqli_num_rows($result_cek) > 0) {
    echo "<script>
        alert('Barang tidak bisa dihapus karena masih digunakan pada transaksi!');
        window.location = 'barang.php';
    </script>";
} else {
    $query_hapus = "DELETE FROM barang WHERE id = '$id'";
    mysqli_query($koneksi, $query_hapus);

    echo "<script>
        alert('Data barang berhasil dihapus');
        window.location = 'barang.php';
    </script>";
}

mysqli_close($koneksi);
?>
