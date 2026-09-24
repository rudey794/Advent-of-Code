<?php 
Namespace Aoc;

class Input {
    public String $rawfile;

    function __construct(String $file) {
        $this->rawfile = file_get_contents($file);
    }

    function getLines(String $delimiter = "\n") {
        return explode($delimiter, $this->rawfile);
    }

    function get2dArraySplitByChar(String $char = ' ') {
        $lines = [];
        foreach($this->getLines() as $line){
            if(trim($line) === '') continue;
            preg_match_all('/[^' . preg_quote($char, '/') . ']+/', $line, $matches);
            $lines[] = $matches[0];
        }
        return $lines;
    }

    function transpose($input) {
        return array_map(null, ...$input);
    }
}