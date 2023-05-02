<?php

namespace Tests\Feature\src\Application;

use Src\Rover\Application\DetectObstacleUseCase;

use Tests\TestCase;

class DetectObstacleUseCaseTest extends TestCase
{
  
    private array  $obstacleLists;
    private DetectObstacleUseCase $detectObstacleUseCase; 
    

    public function setUp():void
    {
        parent::setUp();

        $this->obstacleLists = [
            [10,2],
            [1,40],
            [5,200],
            [12,58],
            [141,100],
            [100,57],
            [190,134],
            [37,87],
            [40,105],
            [1,3],
        ];
        $this->detectObstacleUseCase = new DetectObstacleUseCase();
        
    }
   
    public function testCanDetectObstacle(): void
    {
       $detected = $this->detectObstacleUseCase->detect(1,40, $this->obstacleLists);

       $this->assertTrue($detected);
    }
}
