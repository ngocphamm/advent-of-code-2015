<?php

function run_board(int $overide_b = null)
{
    $lines = file('input_d07.txt', FILE_IGNORE_NEW_LINES);
    $wires = [];

    while (count($lines) > 0) {
        $line = array_shift($lines);
        $parts = explode(' ', $line);

        if (count($parts) === 3) {
            // Direct wiring
            if (!is_numeric($parts[0]) && !isset($wires[$parts[0]])) {
                array_push($lines, $line);
                continue;
            }

            $val = is_numeric($parts[0]) ? intval($parts[0]) : $wires[$parts[0]];

            $wires[$parts[2]] = $val;
        } else if (count($parts) === 4) {
            // NOT
            if (!is_numeric($parts[1]) && !isset($wires[$parts[1]])) {
                array_push($lines, $line);
                continue;
            }

            $wires[$parts[3]] = 65535 - (is_numeric($parts[1]) ? intval($parts[1]) : $wires[$parts[1]]);
        } else if (count($parts) === 5) {
            switch ($parts[1]) {
                case 'AND':
                    if ((!is_numeric($parts[0]) && !isset($wires[$parts[0]])) ||
                        (!is_numeric($parts[2]) && !isset($wires[$parts[2]]))) {
                        array_push($lines, $line);
                        continue;
                    }

                    $val0 = is_numeric($parts[0]) ? intval($parts[0]) : $wires[$parts[0]];
                    $val2 = is_numeric($parts[2]) ? intval($parts[2]) : $wires[$parts[2]];

                    $wires[$parts[4]] = $val0 & $val2;
                    break;

                case 'OR';
                    if ((!is_numeric($parts[0]) && !isset($wires[$parts[0]])) ||
                        (!is_numeric($parts[2]) && !isset($wires[$parts[2]]))) {
                        array_push($lines, $line);
                        continue;
                    }

                    $val0 = is_numeric($parts[0]) ? intval($parts[0]) : $wires[$parts[0]];
                    $val2 = is_numeric($parts[2]) ? intval($parts[2]) : $wires[$parts[2]];

                    $wires[$parts[4]] = $val0 | $val2;
                    break;

                case 'LSHIFT':
                    if (!is_numeric($parts[0]) && !isset($wires[$parts[0]])) {
                        array_push($lines, $line);
                        continue;
                    }

                    $val0 = is_numeric($parts[0]) ? intval($parts[0]) : $wires[$parts[0]];
                    $val2 = is_numeric($parts[2]) ? intval($parts[2]) : $wires[$parts[2]];

                    $wires[$parts[4]] = $val0 << $val2;
                    break;

                case 'RSHIFT':
                    if (!is_numeric($parts[0]) && !isset($wires[$parts[0]])) {
                        array_push($lines, $line);
                        continue;
                    }

                    $val0 = is_numeric($parts[0]) ? intval($parts[0]) : $wires[$parts[0]];
                    $val2 = is_numeric($parts[2]) ? intval($parts[2]) : $wires[$parts[2]];

                    $wires[$parts[4]] = $val0 >> $val2;
                    break;
            }
        }

        if ($overide_b !== null && isset($wires['b'])) {
            $wires['b'] = $overide_b;
        }
    }

    return $wires;
}

// Part 1
$wires = run_board();
var_dump($wires['a']);

// Part 2
$wires = run_board($wires['a']);
var_dump($wires['a']);