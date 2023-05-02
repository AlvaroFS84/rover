<?php

namespace Tests\Feature\src\Application;

use PHPUnit\Framework\MockObject\MockObject;
use Src\Rover\Application\DetectObstacleUseCase;
use Src\Rover\Application\MoveRoverUseCase;
use Src\Rover\Domain\Exceptions\CommandNotValidException;
use Src\Rover\Domain\Exceptions\RoverOutOfBoundsException;
use Src\Rover\Domain\Repositories\RoverRepositoryInterface;
use Src\Rover\Domain\Rover;
use Src\Rover\Domain\ValueObjects\ObstaclesList;
use Src\Rover\Domain\ValueObjects\Position;
use Src\Rover\Infrastructure\Repositories\Rover as RepositoriesRover;
use Tests\TestCase;

class MoveRoverUseCaseTest extends TestCase
{
    private MockObject | Position $position;
    private MockObject | ObstaclesList $obstacleLists;
    private Rover $rover;
    private MoveRoverUseCase $moveRoverUseCase;
    private DetectObstacleUseCase $detectObstacleUseCase;
    private RoverRepositoryInterface $roverRepository;

    public function setUp():void
    {
        parent::setUp();

        $this->position = $this->getMockBuilder(Position::class)->disableOriginalConstructor()->getMock();
        $this->obstacleLists = $this->getMockBuilder(ObstaclesList::class)->disableOriginalConstructor()->getMock();
        $this->rover = new Rover($this->position, $this->obstacleLists);
        $this->detectObstacleUseCase = $this->getMockBuilder(DetectObstacleUseCase::class)->disableOriginalConstructor()->getMock();
        $this->roverRepository = $this->getMockBuilder(RoverRepositoryInterface::class)->disableOriginalConstructor()->getMock();
        $this->moveRoverUseCase = new MoveRoverUseCase($this->detectObstacleUseCase, $this->roverRepository);

         $this->obstacleLists->method('getObstacles')->willReturn([
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
        ]);
    }

    /*********Move forward ******************/
    
    public function testMoveForwardNorth(): void
    {
        $this->position->method('getX')->willReturn(5);
        $this->position->method('getY')->willReturn(5);
        $this->position->method('getDirection')->willReturn('N');
       
        $this->detectObstacleUseCase->method('detect')->willReturn(false);

        $this->moveRoverUseCase->__invoke($this->rover,'F');

        $this->assertEquals(5, $this->rover->getPosition()->getX());
        $this->assertEquals(6, $this->rover->getPosition()->getY());
        $this->assertEquals('N', $this->rover->getPosition()->getDirection());
    }

    public function testMoveForwardEast(): void
    {
        $this->position->method('getX')->willReturn(5);
        $this->position->method('getY')->willReturn(5);
        $this->position->method('getDirection')->willReturn('E');
       
        $this->detectObstacleUseCase->method('detect')->willReturn(false);

        $this->moveRoverUseCase->__invoke($this->rover, 'F');

        $this->assertEquals(6, $this->rover->getPosition()->getX());
        $this->assertEquals(5, $this->rover->getPosition()->getY());
        $this->assertEquals('E', $this->rover->getPosition()->getDirection());
    }

    public function testMoveForwardSouth(): void
    {
        $this->position->method('getX')->willReturn(5);
        $this->position->method('getY')->willReturn(5);
        $this->position->method('getDirection')->willReturn('S');
       
        $this->detectObstacleUseCase->method('detect')->willReturn(false);

        $this->moveRoverUseCase->__invoke($this->rover, 'F');

        $this->assertEquals(5, $this->rover->getPosition()->getX());
        $this->assertEquals(4, $this->rover->getPosition()->getY());
        $this->assertEquals('S', $this->rover->getPosition()->getDirection());
    }

    public function testMoveForwardWest(): void
    {
        $this->position->method('getX')->willReturn(5);
        $this->position->method('getY')->willReturn(5);
        $this->position->method('getDirection')->willReturn('W');
       
        $this->detectObstacleUseCase->method('detect')->willReturn(false);

        $this->moveRoverUseCase->__invoke($this->rover, 'F');

        $this->assertEquals(4, $this->rover->getPosition()->getX());
        $this->assertEquals(5, $this->rover->getPosition()->getY());
        $this->assertEquals('W', $this->rover->getPosition()->getDirection());
    }

   /*********Move Right******************/

   public function testMoveRightNorth(): void
    {
        $this->position->method('getX')->willReturn(5);
        $this->position->method('getY')->willReturn(5);
        $this->position->method('getDirection')->willReturn('N');
       
        $this->detectObstacleUseCase->method('detect')->willReturn(false);

        $this->moveRoverUseCase->__invoke($this->rover, 'R');

        $this->assertEquals(6, $this->rover->getPosition()->getX());
        $this->assertEquals(5, $this->rover->getPosition()->getY());
        $this->assertEquals('E', $this->rover->getPosition()->getDirection());
    }

    public function testMoveRightEast(): void
    {
        $this->position->method('getX')->willReturn(5);
        $this->position->method('getY')->willReturn(5);
        $this->position->method('getDirection')->willReturn('E');
       
        $this->detectObstacleUseCase->method('detect')->willReturn(false);

        $this->moveRoverUseCase->__invoke($this->rover, 'R');

        $this->assertEquals(5, $this->rover->getPosition()->getX());
        $this->assertEquals(4, $this->rover->getPosition()->getY());
        $this->assertEquals('S', $this->rover->getPosition()->getDirection());
    }

    public function testMoveRightSouth(): void
    {
        $this->position->method('getX')->willReturn(5);
        $this->position->method('getY')->willReturn(5);
        $this->position->method('getDirection')->willReturn('S');
       
        $this->detectObstacleUseCase->method('detect')->willReturn(false);

        $this->moveRoverUseCase->__invoke($this->rover, 'R');

        $this->assertEquals(4, $this->rover->getPosition()->getX());
        $this->assertEquals(5, $this->rover->getPosition()->getY());
        $this->assertEquals('W', $this->rover->getPosition()->getDirection());
    }

    public function testMoveRightWest(): void
    {
        $this->position->method('getX')->willReturn(5);
        $this->position->method('getY')->willReturn(5);
        $this->position->method('getDirection')->willReturn('W');
       
        $this->detectObstacleUseCase->method('detect')->willReturn(false);

        $this->moveRoverUseCase->__invoke($this->rover, 'R');

        $this->assertEquals(5, $this->rover->getPosition()->getX());
        $this->assertEquals(6, $this->rover->getPosition()->getY());
        $this->assertEquals('N', $this->rover->getPosition()->getDirection());
    }

    /*********Move Left ******************/
    
    public function testMoveLeftNorth(): void
    {
        $this->position->method('getX')->willReturn(5);
        $this->position->method('getY')->willReturn(5);
        $this->position->method('getDirection')->willReturn('N');
       
        $this->detectObstacleUseCase->method('detect')->willReturn(false);

        $this->moveRoverUseCase->__invoke($this->rover, 'L');

        $this->assertEquals(4, $this->rover->getPosition()->getX());
        $this->assertEquals(5, $this->rover->getPosition()->getY());
        $this->assertEquals('W', $this->rover->getPosition()->getDirection());
    }

    public function testMoveLeftEast(): void
    {
        $this->position->method('getX')->willReturn(5);
        $this->position->method('getY')->willReturn(5);
        $this->position->method('getDirection')->willReturn('E');
       
        $this->detectObstacleUseCase->method('detect')->willReturn(false);

        $this->moveRoverUseCase->__invoke($this->rover, 'L');

        $this->assertEquals(5, $this->rover->getPosition()->getX());
        $this->assertEquals(6, $this->rover->getPosition()->getY());
        $this->assertEquals('N', $this->rover->getPosition()->getDirection());
    }

    public function testMoveLeftSouth(): void
    {
        $this->position->method('getX')->willReturn(5);
        $this->position->method('getY')->willReturn(5);
        $this->position->method('getDirection')->willReturn('S');
       
        $this->detectObstacleUseCase->method('detect')->willReturn(false);

        $this->moveRoverUseCase->__invoke($this->rover, 'L');

        $this->assertEquals(6, $this->rover->getPosition()->getX());
        $this->assertEquals(5, $this->rover->getPosition()->getY());
        $this->assertEquals('E', $this->rover->getPosition()->getDirection());
    }

    public function testMoveLeftWest(): void
    {
        $this->position->method('getX')->willReturn(5);
        $this->position->method('getY')->willReturn(5);
        $this->position->method('getDirection')->willReturn('W');
       
        $this->detectObstacleUseCase->method('detect')->willReturn(false);

        $this->moveRoverUseCase->__invoke($this->rover, 'L');

        $this->assertEquals(5, $this->rover->getPosition()->getX());
        $this->assertEquals(4, $this->rover->getPosition()->getY());
        $this->assertEquals('S', $this->rover->getPosition()->getDirection());
    }

     /*********Test out of bounds ******************/

    public function testOutOfBoundsNorth(): void
    {
        $this->position->method('getX')->willReturn(0);
        $this->position->method('getY')->willReturn(199);
        $this->position->method('getDirection')->willReturn('N');
       
        $this->detectObstacleUseCase->method('detect')->willReturn(false);
        $this->expectException(RoverOutOfBoundsException::class);
        $this->moveRoverUseCase->__invoke($this->rover, 'F');
    }

    public function testOutOfBoundsEast(): void
    {
        $this->position->method('getX')->willReturn(199);
        $this->position->method('getY')->willReturn(2);
        $this->position->method('getDirection')->willReturn('E');
       
        $this->detectObstacleUseCase->method('detect')->willReturn(false);
        $this->expectException(RoverOutOfBoundsException::class);
        $this->moveRoverUseCase->__invoke($this->rover, 'F');
    }

    public function testOutOfBoundsSouth(): void
    {
        $this->position->method('getX')->willReturn(0);
        $this->position->method('getY')->willReturn(0);
        $this->position->method('getDirection')->willReturn('S');
       
        $this->detectObstacleUseCase->method('detect')->willReturn(false);
        $this->expectException(RoverOutOfBoundsException::class);
        $this->moveRoverUseCase->__invoke($this->rover, 'F');
    }

    public function testOutOfBoundsWest(): void
    {
        $this->position->method('getX')->willReturn(0);
        $this->position->method('getY')->willReturn(0);
        $this->position->method('getDirection')->willReturn('W');
       
        $this->detectObstacleUseCase->method('detect')->willReturn(false);
        $this->expectException(RoverOutOfBoundsException::class);
        $this->moveRoverUseCase->__invoke($this->rover, 'F');
    }

     /*********Test invalid command ******************/
    public function testInvalidCommand(): void
     {
         $this->position->method('getX')->willReturn(5);
         $this->position->method('getY')->willReturn(5);
         $this->position->method('getDirection')->willReturn('W');
        
         $this->detectObstacleUseCase->method('detect')->willReturn(false);
         $this->expectException(CommandNotValidException::class);
         $this->moveRoverUseCase->__invoke($this->rover, 'FFFZRL');
     }
}
