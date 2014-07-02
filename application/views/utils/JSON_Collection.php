<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//header('Cache-Control: no-cache, must-revalidate');
//header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
//header('Content-type: application/json');

function get_last_key($array) {
    end($array);
    return key($array);
}

$size = sizeof($results);
echo '[';

for ($i = 0; $i < $size; $i++) {
    $item = $results[$i];
    echo '{';
    $last_field = get_last_key($item);
    foreach ($item as $field_name => $value) {
        echo '"$' . $field_name . '":' . json_encode($value);
        if ($field_name != $last_field) {
            echo ',';
        }
    }
    
    echo '}';

    if ($i < $size - 1) {
        echo ',';
    }
}
echo ']';
?>