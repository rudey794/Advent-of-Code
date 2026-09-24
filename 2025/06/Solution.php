<?php

namespace Aoc\Year2025;

use Aoc\Input;
use Aoc\Puzzle;

    class Day06 extends Puzzle {

    public function part1(Input $input): int{
        $lines = $input->get2dArraySplitByChar();
        $operators = array_pop($lines);
        $lines = $input->transpose($lines);



        $total = 0;
        foreach($operators as $key=>$operator){
            $total += $this->calculate_result($lines[$key], $operator);
        }
        return $total;
    }

    public function part2(Input $input): int{
        $lines = $input->getLines();
        $width = max(array_map('strlen', $lines));
        foreach($lines as &$line){
            $line = str_pad($line, $width);
        }
        unset($line);

        $operators = array_pop($lines);

        // make sure lines are all the the same length

            $currentNumbers = [];
            $currentOperator = '';
            $total = 0;
        for($i = 0; $i < $width; $i++) {
                $number = '';
                foreach($lines as $line) {
                    $number .= $line[$i];
                }

                $operator = $operators[$i];
                
                if (empty(trim($number)) && empty(trim($operator))) {
                    $result = $this->calculate_result($currentNumbers, $currentOperator);
                    // echo "Result for operator '$currentOperator' with numbers [" . implode(", ", $currentNumbers) . "] = $result\n";
                    $total += $result;
                    $currentNumbers = [];
                    $currentOperator = '';
                    continue;
                
                }

                if(!empty($number)) {
                    $currentNumbers[] = (int)$number;
                }

                if(in_array($operator, ['+', '*'])) {
                    $currentOperator = $operator;
                }

        }
            $result = $this->calculate_result($currentNumbers, $currentOperator);
            // echo "Result for operator '$currentOperator' with numbers [" . implode(", ", $currentNumbers) . "] = $result\n";
            $total += $result;

            return $total;
    }

    public function calculate_result($numbers, $operator) {
        if($operator == "+"){
            return array_sum($numbers);
        } elseif($operator == "*") {
            return array_product($numbers);
        }
        
        return 0;
    }
}