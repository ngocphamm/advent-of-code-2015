<?php

$json = json_decode(file_get_contents('input_d12.txt'));

function get_sum($obj)
{
    if (is_int($obj)) return $obj;

    $sum = 0;
    if (is_array($obj)) {
        foreach ($obj as $key => $value) {
            $sum += get_sum($value);
        }
    } else if (is_object($obj)) {
        foreach ($obj as $prop => $value) {
            $sum += get_sum($value);
        }
    }

    return $sum;
}

var_dump(get_sum($json));

function get_sum_red($obj)
{
    if (is_int($obj)) return $obj;

    $sum = 0;
    if (is_array($obj)) {
        foreach ($obj as $key => $value) {
            $sum += get_sum_red($value);
        }
    } else if (is_object($obj)) {
        foreach ($obj as $prop => $value) {
            if ($value === 'red') {
                return 0;
            }
            $sum += get_sum_red($value);
        }
    }

    return $sum;
}

var_dump(get_sum_red($json));