<?php
require __DIR__ . "/vendor/autoload.php";

class Runner {
    public function run(int $year, int $day, string $type = 'test'): void {
        $directory = __DIR__ . "/$year/$day";
        $solutionFile = "$directory/solution.php";
        $inputFile = "$directory/$type.txt";

        if (!is_file($solutionFile)) {
            throw new RuntimeException("Solution not found: $solutionFile");
        }
        if (!is_file($inputFile)) {
            throw new RuntimeException("Input not found: $inputFile");
        }

        require_once $solutionFile;

        $class = "Aoc\\Year$year\\Day$day";
        if (!class_exists($class)) {
            throw new RuntimeException("Class $class does not exist in $solutionFile");
        }

        $solution = new $class();
        $result = $solution->solve($inputFile);
        print_r($result);
    }
}