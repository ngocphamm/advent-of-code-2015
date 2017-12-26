<?php

function part_1()
{
    $delivered = 0;
    $houses = [];
    $x = $y = 0;

    $fh = fopen('input_d03.txt', 'r');

    while (false !== ($char = fgetc($fh))) {
        if (!isset($houses[$x][$y])) {
            $houses[$x][$y] = 1;
            $delivered++;
        }

        move($char, $x, $y);
    }

    var_dump($delivered);
}

function part_2()
{
    $delivered = 0;
    $houses = [];
    $step = 0;
    $sx = $sy = 0;  // Position of Santa
    $rx = $ry = 0;  // Position of Robo-Santa

    $fh = fopen('input_d03.txt', 'r');

    while (false !== ($char = fgetc($fh))) {
        if ($step % 2 === 0) { // Santa
            $x = $sx;
            $y = $sy;
        } else { // Robo-Santa
            $x = $rx;
            $y = $ry;
        }

        if (!isset($houses[$x][$y])) {
            $houses[$x][$y] = 1;
            $delivered++;
        }

        if ($step % 2 === 0) move($char, $sx, $sy);
        else move($char, $rx, $ry);

        $step++;
    }

    var_dump($delivered);
}

function move($char, &$x, &$y)
{
    // Move to next house
    switch ($char) {
        case '^':
            $y--;
            break;
        case '>':
            $x++;
            break;
        case 'v':
            $y++;
            break;
        case '<':
            $x--;
            break;
    }
}

part_1();
part_2();