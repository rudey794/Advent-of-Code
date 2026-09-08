<?php 
Namespace Aoc;

class Input {
    public String $rawfile;

    function __construct(String $file) {
        $this->rawfile = file_get_contents($file);
    }

    function getLines() {
        return explode("\n", $this->rawfile);
    }


    function get2dArrayBySpaces() {
        $lines = [];
        foreach($this->getLines() as $line){
            if(trim($line) === '') continue;
            preg_match_all('/\S+/', $line, $matches);
            $lines[] = $matches[0];
        }
        return $lines;
    }
}