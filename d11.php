<?php

function get_next_letter($char)
{
    $next = ++$char;

    return (strlen($next) === 2) ? $next[0] : $next;
}

function is_good_password($pw)
{
    if (strpos($pw, 'i') !== false ||
        strpos($pw, 'o') !== false ||
        strpos($pw, 'l') !== false) return false;

    $pair_of = [];

    // Look for 2 non-overlapping pairs of letters
    for ($i = 1; $i < strlen($pw); $i++) {
        if (in_array($pw[$i], $pair_of) || $pw[$i] !== $pw[$i-1]) continue;

        array_push($pair_of, $pw[$i]);

        if (count($pair_of) === 2) break;
    }

    if (count($pair_of) < 2) return false;

    // Look for increasing straigt of at least 3 letters
    for ($j = 0; $j < (strlen($pw) - 2); $j++) {
        if ($pw[$j] === 'y' || $pw[$j] === 'z') continue;

        $tmp1 = get_next_letter($pw[$j]);
        $tmp2 = get_next_letter($tmp1);
        if ($tmp1 === $pw[$j+1] && $tmp2 === $pw[$j+2]) {
            return true;
        }
    }

    return false;
}

$pass = 'cqjxjnds';

// Part 1
do {
    // Increment the password
    ++$pass;
} while (!is_good_password($pass));

var_dump($pass);

// Part 2
do {
    // Increment the password
    ++$pass;
} while (!is_good_password($pass));

var_dump($pass);