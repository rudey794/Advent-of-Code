<?php
namespace Aoc\Year2025;

use Aoc\Input;
use Aoc\Puzzle;

class Day04 extends Puzzle {

	public function part1(Input $input): int{
		$lines = $input->getLines();
		return $this->getAccessibleRolls($lines);
	}

	public function part2(Input $input): int{
		$lines = $input->getLines();
		return $this->getRemovedRolls($lines);
	}

	public function getAccessibleRolls(&$lines, $adjust = false){
		$accessible = 0;
		for($r = 0; $r < count($lines); $r++){
			for($c = 0; $c < strlen($lines[0]); $c++){
				if(($lines[$r][$c] ?? '') != "@") continue;
				$adjacent = $this->getAdjacentStacks($lines, $r, $c);
				if($adjacent < 5){
					$accessible++;
					if($adjust) $lines[$r][$c] = "x";
				}
			}
		}
		return $accessible;
	}
	public function getRemovedRolls($lines){
		$removedRolls = 0;
		do{
			$removed = $this->getAccessibleRolls($lines, true);
			$removedRolls += $removed;
		} while($removed > 0);

		return $removedRolls;
	}
	public function getAdjacentStacks($lines, $row, $col){
		$adjacent = 0;
		$maxrow = count($lines);
		$maxcol =  strlen($lines[0]);
		foreach(range(-1, 1) as $r){
			foreach(range(-1, 1) as $c){
				$rr = $row + $r;
				$cc = $col + $c;
				if($rr < 0 || $rr >= $maxrow || $cc < 0 || $cc >= $maxcol) continue;
				$char = $lines[$rr][$cc] ?? ".";
				if($char == "@") $adjacent++;
			}
		}
		return $adjacent;
	}
}
?>