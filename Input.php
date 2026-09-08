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
}