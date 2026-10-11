<?php
echo "<h2>Soal Nomer 2.1</h2>";
$fruits = array("Avocado", "Blueberry", "Cherry");
$arrlength = count($fruits);

$dataBaru = array("Durian", "Elderberry", "Fig", "Grape", "Honeydew");
for ($i = 0; $i < count($dataBaru); $i++) {
    $fruits[] = $dataBaru[$i];
}

echo 'Panjang array: ' . count($fruits) . '<br>';
print_r($fruits);

$arrlength = count($fruits);
for ($x = 0; $x < $arrlength; $x++) {
    echo '<br>' . $fruits[$x];
}
echo "<h2>Soal Nomer 2.2</h2>";
$vegies = array("Carrot", "Brokoli", "Spinach");

$arrlength  = count($vegies);
for ($x = 0; $x < $arrlength; $x++) {
    echo "<br>" . $vegies[$x];
}
?>