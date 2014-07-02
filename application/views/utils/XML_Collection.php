<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json');

echo '<?xml version="1.0" encoding="utf-8" ?>';
echo '<results>';
for ($i = 0; $i < sizeof($results); $i++) {
    $item = $results[$i];
    echo '<item>';
    foreach ($item as $field_name => $value) {
        echo '<' . $field_name . '>';
        echo utf8_encode($value);
        echo '<' . $field_name . '>';
    }
    echo '</item>';
}
echo '</results>';
?>