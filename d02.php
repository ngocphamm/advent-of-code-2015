<?php

$sqft = 0;
$ft = 0;
$lines = file('input_d02.txt', FILE_IGNORE_NEW_LINES);

foreach ($lines as $line) {
    $dim = explode('x', $line);

    sort($dim); // Smallest dimensions first

    $sqft += 2 * ($dim[0]*$dim[1] + $dim[1]*$dim[2] + $dim[0]*$dim[2]) + $dim[0]*$dim[1];
    $ft += 2 * ($dim[0] + $dim[1]) + $dim[0]* $dim[1]* $dim[2];
}

var_dump($sqft, $ft);