<?php

$fh = fopen('input_d01.txt', 'r');

$floor = 0;
$first_entered = false;
$pos = 1;

while (false !== ($char = fgetc($fh))) {
    $floor = $char === '(' ? $floor + 1 : $floor - 1;

    if ($floor === -1 && $first_entered === false) {
        var_dump($pos);
        $first_entered = true;
    }

    $pos++;
}

var_dump($floor);