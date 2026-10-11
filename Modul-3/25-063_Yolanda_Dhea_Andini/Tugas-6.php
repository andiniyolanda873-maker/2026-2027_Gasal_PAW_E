<?php
echo 'Array awal: ("A")<br>';
$arr1 = array("A");
array_push($arr1, "B", "C");
echo 'Hasil array_push: ' . $arr1[0] . ' ' . $arr1[1] . ' ' . $arr1[2] . '<br><br>';

echo 'Array awal: ("A", "B") digabung dengan ("C")<br>';
$arr2 = array_merge(array("A", "B"), array("C"));
echo 'Hasil array_merge: ' . $arr2[0] . ' ' . $arr2[1] . ' ' . $arr2[2] . '<br><br>';

echo 'Array awal: ("x" => 1, "y" => 2)<br>';
$arr3 = array("x" => 1, "y" => 2);
$vals = array_values($arr3);
echo 'Hasil array_values: ' . $vals[0] . ' ' . $vals[1] . '<br><br>';

echo 'Mencari "B" pada array: ("A", "B", "C")<br>';
$arr4 = array("A", "B", "C");
echo 'Hasil array_search: ' . array_search("B", $arr4) . '<br><br>';

echo 'Array awal: (0, 1, false, 2, "", 3, "array")<br>';
$arr5 = array(0, 1, false, 2, "", 3, "array");
$filter = array_filter($arr5);
echo 'Hasil array_filter: ';
foreach ($filter as $f) {
    echo $f . ' ';
}
echo '<br><br>';

echo 'Array awal: (3, 1, 2)<br>';
$arr6 = array(3, 1, 2);
sort($arr6);
echo 'Hasil sort: ' . $arr6[0] . ' ' . $arr6[1] . ' ' . $arr6[2] . '<br>';
rsort($arr6);
echo 'Hasil rsort: ' . $arr6[0] . ' ' . $arr6[1] . ' ' . $arr6[2] . '<br><br>';

echo 'Array awal: ("Peter"=>35, "Ben"=>37, "Joe"=>43)<br>';
$arr7 = array("Peter" => 35, "Ben" => 37, "Joe" => 43);

asort($arr7);
echo 'Hasil asort: ';
foreach ($arr7 as $k => $v) {
    echo $k . '=> ' . $v . ', ';
}
echo '<br>';

ksort($arr7);
echo 'Hasil ksort: ';
foreach ($arr7 as $k => $v) {
    echo $k . '=> ' . $v . ', ';
}
echo '<br>';

arsort($arr7);
echo 'Hasil arsort: ';
foreach ($arr7 as $k => $v) {
    echo $k . '=> ' . $v . ', ';
}
echo '<br>';

krsort($arr7);
echo 'Hasil krsort: ';
foreach ($arr7 as $k => $v) {
    echo $k . '=> ' . $v . ', ';
}
echo '<br>';
?>