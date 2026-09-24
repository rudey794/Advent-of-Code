<?php
namespace Aoc;

abstract class Puzzle{

    public function solve(String $file): Array {

		$input = new Input($file);

        $start = microtime(true);
        $part1 = $this->part1($input);
        $part1Time = microtime(true) - $start;

        $start = microtime(true);
        $part2 = $this->part2($input);
        $part2Time = microtime(true) - $start;

		return [
            'part1' => $part1,
            'part2' => $part2,
            'timings' => [
                'part1' => $part1Time,
                'part2' => $part2Time,
            ],
        ];
    }

    abstract public function part1(Input $input): int;
    abstract public function part2(Input $input): int;
}