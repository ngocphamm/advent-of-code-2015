<?php

$rs = [];

$sec = 2503;

foreach (file('input_d14.txt', FILE_IGNORE_NEW_LINES) as $line) {
    $parts = explode(' ', $line);

    $r = [
        'name' => $parts[0],
        'speed' => intval($parts[3]),
        'run' => intval($parts[6]),
        'rest' => intval($parts[13]),
        'distance' => 0,
        'points' => 0
    ];

    array_push($rs, $r);
}

function part_1($rs, $sec)
{
    $max_distance = 0;

    foreach ($rs as $r) {
        $distance = floor($sec / ($r['run'] + $r['rest'])) * $r['speed'] * $r['run'];

        $remain = $sec % ($r['run'] + $r['rest']);
        $distance += min($remain, $r['run']) * $r['speed'];

        $max_distance = max($distance, $max_distance);
    }

    var_dump($max_distance);
}

function part_2($rs, $sec)
{
    $max_distance = 0;

    for ($i = 1; $i <= $sec; $i++) {
        foreach ($rs as &$r) {
            $remain = $i % ($r['run'] + $r['rest']);
            if ($remain > 0 && $remain <= $r['run']) {
                $r['distance'] += $r['speed'];

                $max_distance = max($r['distance'], $max_distance);
            }
        }

        foreach ($rs as &$r) {
            if ($r['distance'] === $max_distance) {
                $r['points']++;
            }
        }
    }

    var_dump($rs);
}

part_1($rs, $sec);
part_2($rs, $sec);