<?php
require __DIR__ . '/vendor/autoload.php';
use Aoc\Runner;

if (empty($argv[1]) || empty($argv[2])) {
    echo "Usage: php exec.php <year> <day> [input]\n";
    exit(1);
}

$type = isset($argv[3]) ? $argv[3] : 'test';
(new Runner())->run((int) $argv[1], (int) $argv[2], $type);