<?php

namespace Aoc\Year2025;

use Aoc\Input;
use Aoc\Puzzle;

class Day05 extends Puzzle {

    public function part1(Input $input): int{
		list($fresh, $ingredients)= $this->parse($input);

		$available = 0;
		$fresh_ranges = $this->getFreshRanges($fresh);
		foreach($ingredients as $ingred){
			$fresh = false;
			foreach($fresh_ranges as $range){
				if($ingred >= $range[0] && $ingred  <= $range[1]){
				$fresh = true;
				break;
				}
			}
			if($fresh) $available++;
		}
		return $available;
    }

    public function part2(Input $input): int{
		list($fresh, $ingredients)= $this->parse($input);

		$total = 0;
		$ranges = $this->getFreshRanges($fresh);
		$this->sortRanges($ranges);
		$merged = $this->mergeRanges($ranges);
		var_dump(count($merged));
		foreach($merged as $range){
			$total += ($range[1] - $range[0] + 1);
		}
		return $total;
    }
    
    public function parse(Input $input): array{
        $data = $input->rawfile;
		$parts = preg_split("/\R\s*\R/", $data, 2);
		return [preg_split("/\R/", $parts[0]), preg_split("/\R/", $parts[1])];
    }

	public function getFreshRanges($list){
		$fresh = [];
		foreach($list as $items){
			$fresh[] = explode("-", $items);
		}
		return $fresh;
	}

	public function getHighestRange($ranges){
		$highest = 0;
		foreach($ranges as $range){
			if($range[1] > $highest) $highest = $range[1];
		}
		return $highest;
	}

	public function mergeRanges($ranges){
		$merged = [];
		foreach($ranges as $range){
			[$start, $end] = $range;
			if(empty($merged)){
				$merged[] = $range;
				continue;
			}
			[$lastStart, $lastEnd] = $merged[count($merged) - 1];
			if($start <= $lastEnd+1) {
				$merged[count($merged) - 1][1] = max($lastEnd, $end);
			} else {
				$merged[] = $range;
			}
		}
		var_dump(count($merged));
		return $merged;
	}

	public function sortRanges(&$ranges){
		usort($ranges, function ($a, $b){
			return $a[0] <=> $b[0];
		});
	}

}

?>