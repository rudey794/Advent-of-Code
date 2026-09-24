<?php

namespace Aoc\Year2025;

use Aoc\Input;
use Aoc\Puzzle;

class Day01 extends Puzzle {

	public function part1(Input $input): int {
		$lines = $input->getLines();
		$dial = 50;
		$password = 0;
		foreach($lines as $line){
			$dir = ($line[1] == "L") ? -1 : 1;
			$pointer = (int)substr($line, 1);
			while ($pointer > 0){
				$dial += $dir;
				$pointer--;
				if($dial < 0){ 
					$dial += 100;
				} else if ($dial > 99){ 
					$dial -= 100;
				}
			}
			if($dial == 0){ echo "yo\n";$password++; } 
		}
		return $password;
	}

	public function part2(Input $input): int {
		$lines = $input->getLines();
		$dial = 50;
		$password = 0;
		foreach($lines as $line){
			$dir = ($line[1] == "L") ? -1 : 1;
			$pointer = (int)substr($line, 1);
			while ($pointer > 0){
				$dial += $dir;
				$pointer--;
				if($dial < 0){ $dial += 100;} else if ($dial > 99){ $dial -= 100;}
				if($dial == 0){ $password++; }
			}
		}
		return $password;
	}

}
?>