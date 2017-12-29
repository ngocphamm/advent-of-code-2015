<?php

function setup_lights_1(&$grid, $startX, $startY, $endX, $endY, $action)
{
    for ($i = $startX; $i <= $endX; $i++) {
        for ($j = $startY; $j <= $endY; $j++) {
            switch ($action) {
                case 'turn on':
                    $grid[$i][$j] = 1;
                    break;

                case 'turn off':
                    $grid[$i][$j] = 0;
                    break;

                case 'toggle':
                    $grid[$i][$j] ^= 1;
                    break;
            }
        }
    }
}

function setup_lights_2(&$grid, $startX, $startY, $endX, $endY, $action)
{
    for ($i = $startX; $i <= $endX; $i++) {
        for ($j = $startY; $j <= $endY; $j++) {
            switch ($action) {
                case 'turn on':
                    $grid[$i][$j]++;
                    break;

                case 'turn off':
                    if ($grid[$i][$j] > 0) $grid[$i][$j]--;
                    break;

                case 'toggle':
                    $grid[$i][$j] += 2;
                    break;
            }
        }
    }
}

$lines = file('input_d06.txt', FILE_IGNORE_NEW_LINES);

// Init
for ($i = 0; $i < 1000; $i++) {
    for ($j = 0; $j < 1000; $j++) {
        $grid1[$i][$j] = 0;
        $grid2[$i][$j] = 0;
    }
}

foreach ($lines as $line) {
    $matches = [];
    preg_match(
        '/^(turn on|turn off|toggle) (\d{1,3}),(\d{1,3}) through (\d{1,3}),(\d{1,3})$/',
        $line,
        $matches
    );

    setup_lights_1($grid1, $matches[2], $matches[3], $matches[4], $matches[5], $matches[1]);
    setup_lights_2($grid2, $matches[2], $matches[3], $matches[4], $matches[5], $matches[1]);
}

// Part 1
$on_count = 0;
for ($i = 0; $i < 1000; $i++) {
    for ($j = 0; $j < 1000; $j++) {
        if ($grid1[$i][$j] === 1) $on_count++;
    }
}

var_dump($on_count);


// Part 2
$brightness = 0;
for ($i = 0; $i < 1000; $i++) {
    for ($j = 0; $j < 1000; $j++) {
        $brightness += $grid2[$i][$j];
    }
}

var_dump($brightness);