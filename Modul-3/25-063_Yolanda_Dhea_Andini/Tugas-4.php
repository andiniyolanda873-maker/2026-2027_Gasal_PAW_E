<?php
echo "<h2>Soal 4.1</h2>";

$height = array("Andy" => "176", "Barry" => "165", "Charlie" => "170");

$height["David"] = "180";
$height["Ethan"] = "172";
$height["Frank"] = "168";
$height["George"] = "175";
$height["Harry"] = "182";

echo 'height = (';
foreach ($height as $nama => $tinggi) {
    echo '"' . $nama . '"=>"' . $tinggi . '", ';
}
echo ')<br><br>';

foreach ($height as $nama => $tinggi) {
    echo $nama . ' is ' . $tinggi . ' cm tall.<br>';
}


echo "<h2>Soal 4.2</h2>";

$weight = array("Andy" => "70", "Barry" => "65", "Charlie" => "75");

echo 'weight = (';
foreach ($weight as $nama => $berat) {
    echo '"' . $nama . '"=>"' . $berat . '", ';
}
echo ')<br><br>';

$keys = array_keys($weight);
$values = array_values($weight);

for ($x = 0; $x < count($weight); $x++) {
    echo $keys[$x] . ' is ' . $values[$x] . ' kg.<br>';
}
?>