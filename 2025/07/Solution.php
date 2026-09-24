<?php
namespace Aoc\Year2025;

use Aoc\Input;
use Aoc\Puzzle;

class Day07 extends Puzzle {
	public function part1(Input $input): int{
		$total = 0;
		// echo $lines[0]."\n";
		$lines = $input->getLines();
		for($i = 1; $i < count($lines)-1; $i++){
				$beams = $this->getBeamPositions($lines[$i - 1]);
				$splits = $this->splitBeams($lines, $i, $beams);
				$total += $splits;
				// echo $lines[$i].": $splits (total: $total)\n";
		}
		return $total;
	}
	public function part2(Input $input): int{
		$memo = [];
		$lines = $input->getLines();
		$total = $this->getPaths($memo, $lines, 1, strpos($lines[0], "S"));
		return $total;
	}
	public function getPaths(&$memo, $lines, $row, $column){
		$paths = 0;
		if(isset($memo[$row][$column])) return $memo[$row][$column];
		$char = $lines[$row][$column] ?? "END";
		if($char == "."){
			$paths += $this->getPaths($memo, $lines, $row + 1, $column);
		} else if ($char == "^") {
			$paths += $this->getPaths($memo, $lines, $row, $column - 1);
			$paths += $this->getPaths($memo, $lines, $row, $column + 1);
		} else {
			$paths = 1;
		}
		
		return $memo[$row][$column] = $paths;
	}
	public function getBeamPositions($line){
		$positions = [];
		$length = strlen($line);
		for($i=0; $i<$length; $i++){
			if(in_array($line[$i], ["|", "S"])){
				$positions[] = $i;
			}
		}
		return $positions;
	}
	public function splitBeams(&$lines, $i, $beams){
		$splits = 0;
		foreach($beams as $beam){
			$char = $lines[$i][$beam];
			if($char === "."){
				$lines[$i][$beam] = "|";
			} elseif($char === "^"){
				$split = false;
				foreach([-1, 1] as $mod){
				if($lines[$i][$beam + $mod] == "."){
					$split = true;
					$lines[$i][$beam + $mod] = "|";
				}
				}
				if($split) $splits++;
			}
		}
		return $splits;
	}
}