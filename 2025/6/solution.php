<?php
   function solve($file){
      $lines = parse($file);
      echo "part1: " . part1($lines) . "\n";
      $lines = parse($file, 2);
      echo "part2: " . part2($lines) . "\n";
   }
   function part1($lines){
      [$transposed, $operators] = transpose($lines);
      $total = 0;
      foreach($operators as $key=>$operator){
         $total += calculate_result($transposed[$key], $operator);
      }
      return $total;
   }

   function part2($lines) {
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
				$result = calculate_result($currentNumbers, $currentOperator);
				echo "Result for operator '$currentOperator' with numbers [" . implode(", ", $currentNumbers) . "] = $result\n";
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
		$result = calculate_result($currentNumbers, $currentOperator);
		echo "Result for operator '$currentOperator' with numbers [" . implode(", ", $currentNumbers) . "] = $result\n";
		$total += $result;

		return $total;
   }

	function calculate_result($numbers, $operator) {
		if($operator == "+"){
			return array_sum($numbers);
		} elseif($operator == "*") {
			return array_product($numbers);
		}
		
		var_dump($numbers, $operator);
		return 0;
	}

   function transpose($lines){
      $transposed = [];
      $operators = [];
      if(empty($lines)) return [$transposed, $operators];
      // assume last line contains operators
      $last = array_pop($lines);
      $operators = $last;
      foreach($lines as $row){
         foreach($row as $i=>$val){
            $transposed[$i][] = is_numeric($val) ? (int)$val : $val;
         }
      }
      return [$transposed, $operators];
   }
   function parse($filename, $part=1){
      $content = file_get_contents($filename);
      if($content === false) return [];
      $rawLines = preg_split('/\R/', trim($content));

      if($part === 2) return $rawLines;

      $lines = [];
      foreach($rawLines as $line){
         if(trim($line) === '') continue;
         preg_match_all('/\S+/', $line, $matches);
         $lines[] = $matches[0];
      }
      return $lines;
   }
?>