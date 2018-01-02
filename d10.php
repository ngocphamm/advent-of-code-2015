<?php

$input = '1113122113';

function run($input, $count)
{
    for ($i = 0; $i < $count; $i++) {
        $run = 1;
        $next_input = '';

        for ($j = 1; $j < strlen($input); $j++) {
            if ($input[$j] != $input[$j - 1]) {
                $next_input .= $run . $input[$j - 1];
                $run = 1; // Reset run
            } else {
                $run++;
            }

            if ($j === (strlen($input) - 1)) {
                // At the end
                $next_input .= $run . $input[$j];
            }
        }

        $input = $next_input;
    }

    var_dump(strlen($input));
}

run($input, 40);
run($input, 50);
