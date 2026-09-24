<?php

namespace Aoc;

class Runner {
    public function run(int $year, int $day, string $type = 'test'): void {
        $day = str_pad($day, 2, '0', STR_PAD_LEFT);
        $directory = dirname(__DIR__) . "/$year/$day";
        $solutionFile = "$directory/Solution.php";
        $class = "Aoc\\Year$year\\Day$day";
        $inputFile = "$directory/$type.txt";

        if (!is_file($solutionFile)) {
            throw new \RuntimeException("Solution not found: $solutionFile");
        }
        if (!is_file($inputFile)) {
            throw new \RuntimeException("Input not found: $inputFile");
        }

        require_once $solutionFile;

        if (!class_exists($class)) {
            throw new \RuntimeException("Class not found: $class");
        }

        $solution = new $class();
        $result = $solution->solve($inputFile);

        echo "Year $year, Day $day ($type)\n";
        printf("  Part 1: %-20s (%.4fms)\n", $result['part1'], $result['timings']['part1'] * 1000);
        printf("  Part 2: %-20s (%.4fms)\n", $result['part2'], $result['timings']['part2'] * 1000);
    }
}