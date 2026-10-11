<?php
echo "<h2>Soal Nomor 1.1</h2>";

$fruits = array("Avocado", "Blueberry", "Cherry");

$fruits[] = "Durian";
$fruits[] = "Elderberry";
$fruits[] = "Fig";
$fruits[] = "Grape";
$fruits[] = "Honeydew";

print_r($fruits);
echo "<br>";

$jumlahdata = count($fruits);
echo "Nilai dengan indeks tertinggi: " . $fruits[$jumlahdata - 1];

echo "<h2>Soal Nomor 1.2</h2>";

$fruits = array("Avocado", "Blueberry", "Cherry", "Durian", "Elderberry", "Fig", "Grape", "Honeydew");

$jumlahdata = count($fruits);
unset($fruits[1]);

echo "Data Blueberry dihapus.<br>";
print_r($fruits);

echo "<br>Nilai dengan indeks tertinggi: " . $fruits[$jumlahdata - 1];
?>
