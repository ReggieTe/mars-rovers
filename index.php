<?php
declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

use \MarsRover\Rover;

if (STDIN) {
    $data = [];
    $inputLine = fgets(STDIN);
    $plateauGrid = explode(" ", $inputLine);
    if(count($plateauGrid)==2){
        $data['grid'] = ['x'=>$plateauGrid[0],'y'=>$plateauGrid[1]];
    }
    
    $inputCommandNumber = 1;
    $squadCounter = 0;

    while (($input = fgets(STDIN)) !== false) {                
                if($inputCommandNumber == 1) {
                    $roverPosition = explode(" ", $input);
                    if(count($roverPosition) == 3) {
                        $data['position'] = ['x' => trim($roverPosition[0]),'y' => trim($roverPosition[1]),'direction' => strtoupper(trim($roverPosition[2]))];
                    }
                }
                if($inputCommandNumber == 2) {
                    $data['instructions'] = str_split(strtoupper($input));
                    $rover =  new Rover($data['grid']);
                    $rover->loadRovers([$data]);
                    $result = $rover->processRovers();
                    echo $result."\n";
                    echo "Press 5 to exit or add detail of the next rover\n";
                    $inputCommandNumber=0;
                } 
                
                if($input == 5){
                    break;
                }                
            $inputCommandNumber++;        
    }
    
}else{
    echo "Run this code on terminal";
}
