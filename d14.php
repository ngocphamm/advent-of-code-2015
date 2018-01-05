<?php

$rs = [];
$max_distance = 0;
$sec = 2503;

foreach (file('input_d14.txt', FILE_IGNORE_NEW_LINES) as $line) {
    $parts = explode(' ', $line);

    $r = [
        'name' => $parts[0],
        'speed' => intval($parts[3]),
        'run' => intval($parts[6]),
        'rest' => intval($parts[13])
    ];

    array_push($rs, $r);

    $distance = floor($sec / ($r['run'] + $r['rest'])) * $r['speed'] * $r['run'];

    $remain = $sec % ($r['run'] + $r['rest']);
    $distance += min($remain, $r['run']) * $r['speed'];

    $max_distance = max($distance, $max_distance);
}

var_dump($max_distance);