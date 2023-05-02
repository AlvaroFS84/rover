# MarsRover

This application has been developed using PHP 8.1.12 and Laravel 10.9.0 it consists in an API that  have to endpont the first endpont store the position and facing direction of the rover and stores on the database, the second endpoint receives a movemnet command to be execute dby the rover.
For simplicity the aplication only stores one rover at the database, if exits  a rover is deleted an a new one is stored, once the rover is stored its ready to receive command with the move-rover endpoint.
The rover moves on a 200 x 200 square planet, can receive x and y  values from 0 to 199 and direction values N,S,E,W.
The comand values can bea combination of L,R and F characters.

## Example urls
To start the  rover on a position and direction(POST):
http://127.0.0.1:8000/api/rover/start-rover
```javascript
{
    "command":"FLFFR"
}
```

To send a command to the  rover (PATCH):
http://127.0.0.1:8000/api/rover/move-rover
with the example data:
```javascript
    {
          "x": "10",
          "y": "5",
          "direction": "N"
    }
```

## Implementation

This applicattion has been developed using three layers:

- Applicaction, that contains the use cases that the application can perform
- Domain , with the domain Entities, Value Objects, repository contracts and the custom Exceptions created for this application
- Infrastructure, that contains the framework elements, in this case the controller that receives the request and the providers for routes and autowiring

More implementation details on code comments.
 
## Testing

Test are located on tests\Unit\src\Application folder, there is three test files
- DetectObstacleUseCaseTest.php that check the correct work of the DetectObstacleUseCase class
- MoveRoverUseCaseTest, this class test everyspossible movement and orientation combination as well as the detection of the exit of the square planet limits and the entering an incorrect command

## Database

An sql file  named rover.sql is included on the project root folder

