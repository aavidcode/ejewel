
<?php 

$arr = array(
    'key1' => 'value1',
    'key2' => 'value2',
    'key3' => 'value3',
);

$arr1 = new stdClass();
$arr1->key1 = "value fd";
$arr1->key2 = "value2";
$arr1->key3 = "dfasdfsad";

$arr2 = json_decode(json_encode($arr1),true);
$arr3 = array_diff_assoc($arr2, $arr);
print_r($arr3);
?>