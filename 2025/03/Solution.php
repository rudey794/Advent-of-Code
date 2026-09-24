<?php
namespace Aoc\Year2025;

use Aoc\Input;
use Aoc\Puzzle;

class Day03 extends Puzzle {

	public function part1(Input $input): int{
		$result = 0;
		$lines = $input->getLines();
		foreach($lines as $line){
			$joltage = $this->buildJoltage($line, 2)."\n";
			// echo $joltage."\n";
			$result += intval($joltage);
		}
		return $result;
	}
	
	public function part2(Input $input): int{
		$result = 0;
		$lines = $input->getLines();
		foreach($lines as $line){
			$joltage = $this->buildJoltage($line, 12)."\n";
			// echo $joltage."\n";
			$result += intval($joltage);
		}
		return $result;
	}

	private function buildJoltage($line, $length){
		$strlen = strlen($line);
		$joltage = "";
		$start = 0;
		for($i = 0; $i < $length; $i++){
			$maxChar = 0;
			$end = $strlen - ($length - $i);
			$maxPos = $start;
			for($j = $start; $j <= $end; $j++){
				$char = intval($line[$j]);
				if($char > $maxChar){
					$maxChar = $char;
					$maxPos = $j;
					if($maxChar == 9) break;
				}
			}
			// echo "selected char $maxChar at pos $maxPos\n";
			$joltage .= strval($maxChar);
			$start = $maxPos + 1;
		}
		return $joltage;
	}
}
?>