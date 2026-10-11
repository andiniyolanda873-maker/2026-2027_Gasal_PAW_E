<?php
echo "<h2>Soal Nomer 3.1</h2>";

$height = array("Andy" => "176", "Barry" => "165", "Charlie" => "170");

$height["David"] = "180";
$height["Ethan"] = "172";
$height["Frank"] = "168";
$height["George"] = "175";
$height["Harry"] = "182";

print_r($height);

foreach ($height as $nama => $tinggi) {
}
echo '<br>Nilai dengan indeks terakhir: ' . $tinggi;

unset($height["Barry"]);

echo '<br>';
print_r($height);

foreach ($height as $nama => $tinggi) {
}
echo '<br>Nilai dengan indeks terakhir setelah dihapus: ' . $tinggi;

echo "<h2>Soal Nomer 3.2</h2>";

$weight = array("Andy" => "65", "Barry" => "70", "Charlie" => "68");

$keys = array_keys($weight);
echo 'Data kedua: ' . $weight[$keys[1]];
?>