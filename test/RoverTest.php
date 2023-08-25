<?php

namespace MarsRover\Test;

use MarsRover\Rover;
use PHPUnit\Framework\TestCase;

class RoverTest extends TestCase
{
    private $rover;
    
    public function setUp()
    {
        $this->rover = new Rover(['x'=>5,'y'=>5]);
    }

    public function testRoverOne()
    {
        $this->rover->loadRovers([
            [
                "position" => ['x' => 1,'y' => 2,'direction' => 'N'],
                "instructions" => ['L','M','L','M','L','M','L','M','M']
            ]
            ]);

           $result =  $this->rover->processRovers();
           $this->assertEquals("1 3 N",$result);
    }

    public function testRoverTwo()
    {
        $this->rover->loadRovers([
            [
                "position" => ['x' => 3,'y' => 3,'direction' => 'E'],
                "instructions" => ['M','M','R','M','M','R','M','R','R','M']
            ]
            ]);

           $result =  $this->rover->processRovers();
           $this->assertEquals("5 1 E",$result);
    }

    public function testAllRovers()
    {
        $this->rover->loadRovers([
            [
                "position" => ['x' => 1,'y' => 2,'direction' => 'N'],
                "instructions" => ['L','M','L','M','L','M','L','M','M']
            ],
            [
                "position" => ['x' => 3,'y' => 3,'direction' => 'E'],
                "instructions" => ['M','M','R','M','M','R','M','R','R','M']
            ]
            ]);

           $result =  $this->rover->processRovers();
           $this->assertEquals("1 3 N\n5 1 E",$result);
    }
}
