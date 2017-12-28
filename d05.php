<?php

function is_nice_1(string $input)
{
    if (strpos($input, 'ab') !== false ||
        strpos($input, 'cd') !== false ||
        strpos($input, 'pq') !== false ||
        strpos($input, 'xy') !== false) return false;

    $vowel_count = 0;
    $has_dup = false;
    for ($i = 0; $i < strlen($input); $i++) {
        if ($input[$i] === 'a' ||
            $input[$i] === 'e' ||
            $input[$i] === 'i' ||
            $input[$i] === 'o' ||
            $input[$i] === 'u') $vowel_count++;

        if ($has_dup === false && $i < (strlen($input) - 1) && $input[$i] === $input[$i+1])
            $has_dup = true;
    }

    if ($vowel_count >= 3 && $has_dup) return true;

    return false;
}

function is_nice_2(string $input)
{
    $len = strlen($input);

    $has_repeat = false;
    $has_dup_pair = false;

    for ($i = 0; $i < $len; $i++) {
        if (!$has_repeat && $i > 0 && $i < ($len - 1) && $input[$i-1] === $input[$i+1])
            $has_repeat = true;

        if (!$has_dup_pair && $i < ($len - 3) &&
            strpos($input, "{$input[$i]}{$input[$i+1]}", $i + 2) !== false)
            $has_dup_pair = true;
    }

    return $has_dup_pair && $has_repeat;
}

$nice1_count = 0;
$nice2_count = 0;

foreach (file('input_d05.txt', FILE_IGNORE_NEW_LINES) as $line) {
    if (is_nice_1(trim($line))) $nice1_count++;
    if (is_nice_2(trim($line))) $nice2_count++;
}

var_dump($nice1_count, $nice2_count);