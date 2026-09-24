<?php

namespace Aoc\Year2025;

use Aoc\Input;
use Aoc\Puzzle;

class Day02 extends Puzzle {

	public function part1(Input $input): int {
		$result = 0;
		$lines = $input->getLines(",");
		foreach($lines as $line){
			list($start, $end) = array_map('intval', explode("-", $line));
			for($i = (int)$start; $i <= (int)$end; $i++){
				if(preg_match('/^(\d+)\1$/', (string)$i)){
				$result += $i;
				}
			}
		}        
		return $result;
	}

	public function part2(Input $input): int {
		$result = 0;
		$lines = $input->getLines(",");
		foreach($lines as $line){
			list($start, $end) = array_map('intval', explode("-", $line));
			for($i = (int)$start; $i <= (int)$end; $i++){
				if(preg_match('/^(\d+)\1+$/', (string)$i)){
					$result += $i;
				}
			}
		}        
		return $result;
	}
}
?>