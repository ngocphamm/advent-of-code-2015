<?php

function escapedHexToHex($escaped)
{
    return chr(hexdec($escaped[1]));
}

$lines = file('input_d08.txt', FILE_IGNORE_NEW_LINES);

$literal_count = 0;
$char_count  = 0;
$encode_count = 0;
$count = 0;

foreach ($lines as $line) {
    // This is the best approach, from Reddit
    // eval('$str = ' . $line . ';');
    // $count += strlen($line) - strlen($str);

    $literal_count += strlen($line);

    // Part 1
    // Replace hex with its chars, with string inside outer-most double quotes
    $str = preg_replace_callback('/\\\\x([a-f0-9]{2})/i', 'escapedHexToHex', substr($line, 1, -1));

    // Replace double slashes
    $str = str_replace('\\\\', '\\', $str);

    // Replace lash and double quote
    $str = str_replace('\"', '"', $str);
    $char_count += strlen($str);

    // Part 2
    $encode_count += strlen(addslashes($line)) + 2;
}

var_dump($literal_count - $char_count);
var_dump($encode_count - $literal_count);
