<?php 
namespace Aoc\Year2025;

use Aoc\Input;
use Aoc\Puzzle;


class Day09 extends Puzzle {

    public function part1(Input $input): int {
        $coords = $input->get2dArraySplitByChar(",");
        $maxSquare = 0;
        for($i = 0; $i < count($coords); $i++){
            for($j = 1; $j < count($coords); $j++){
                $area = (abs($coords[$i][0] - $coords[$j][0]) + 1) * (abs($coords[$i][1] - $coords[$j][1]) + 1);
                $maxSquare = max($maxSquare, $area);
            }
        }

        return $maxSquare;
    }

    public function part2(Input $input): int {
        return 0;
    }
}