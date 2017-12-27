<?php

function find(string $input, int $leading_zeros_count, int $start = 1)
{
    while (1) {
        $hash = md5("{$input}{$start}");

        if (substr($hash, 0, $leading_zeros_count) === str_pad('', $leading_zeros_count, '0')) {
            return $start;
        }

        $start++;
    }
}

$input = 'bgvyzdsv';

$num = find($input, 5);
var_dump($num);

var_dump(find($input, 6, $num));