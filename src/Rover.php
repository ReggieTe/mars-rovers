<?php 
namespace MarsRover;


class Rover
{
    private $directions;

    private $plateauGrid=  ['x'=>5,'y'=>5];

    private $rovers;    
    
    public function __construct($grid=['x'=>0,'y'=>0])
    {
        $this->directions = ['N' => 0,'E' => 90,'S' => 180,'W' => 270]; 
        $this->plateauGrid = $grid;
    }

    public function loadRovers(array $rovers) :Rover {        
        $this->rovers = $rovers;
        return $this;
    }

    public function processRovers()
    {   $results = [];
        if(count($this->rovers)>1){
            foreach($this->rovers as $rover) {
                array_push($results,implode(" ",$this->moveRover($rover)));            
              }
              return implode("\n",$results);
        }else{
            $result = $this->moveRover(reset($this->rovers));
            if(is_array($result)){
                return implode(" ",$result); 
            }

        }        
    }

    private function moveRover(array $rover):array
    {   
        if(in_array($rover['position'],$rover)&& in_array($rover['instructions'],$rover)){
            $currentRoverPosition = [];
            if(in_array($rover['position']['direction'],$this->directions)){
                $rover['position']['direction'] = $this->directions[$rover['position']['direction']];
                $currentRoverPosition = $rover['position'];
                foreach ($rover['instructions'] as $instruction) {
                    $currentRoverPosition = $this->processInstruction($instruction, $currentRoverPosition);
                }
                $currentRoverPosition['direction'] = array_search($currentRoverPosition['direction'], $this->directions);
            
            }
        }
        return $currentRoverPosition;

    }

    private function processInstruction(string $instruction, array $currentRoverPosition):array
    {
        $updateRoverPosition = $currentRoverPosition;
        switch ($instruction) {
            case 'L':
                $updateRoverPosition['direction'] = ($updateRoverPosition['direction'] - 90 + 360) % 360;
                break;
            case 'R':
                $updateRoverPosition['direction'] = ($updateRoverPosition['direction'] + 90) % 360;
                break;
            case 'M':
                switch ($updateRoverPosition['direction']) {
                    case 0:
                        $updateRoverPosition['y'] = $this->calcalatePosition($updateRoverPosition['y']);
                        break;
                    case 90:
                        $updateRoverPosition['x'] = $this->calcalatePosition($updateRoverPosition['x']);
                        $updateRoverPosition['y'] = $this->calcalatePosition($updateRoverPosition['y'], false);
                        break;
                    case 180:
                        $updateRoverPosition['y'] = $this->calcalatePosition($updateRoverPosition['y'], false);
                        break;
                    case 270:
                        $updateRoverPosition['x'] = $this->calcalatePosition($updateRoverPosition['x'], false);
                        $updateRoverPosition['y'] = $this->calcalatePosition($updateRoverPosition['y']);
                        break;
                    case 360:
                        $updateRoverPosition['y'] = $this->calcalatePosition($updateRoverPosition['y'], false);
                        break;
                    default:
                        break;
                }
                break;
            default:
                break;
        }
        return $updateRoverPosition;
    }

    private function calcalatePosition($position, $add = true): int
    {   
        $result = abs($add ? $position + 1 : $position - 1);        
        if($result>=0 && $result<=$this->plateauGrid['y']){
            return $result;
        }
        return $position;
    }

}