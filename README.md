# Mars Rovers

## How to execute the program:
- PHP version >= 5.3 is required
- Run `composer update`
- Run on terminal `./vendor/bin/phpunit -c phpunit.xml  test/RoverTest.php`

##  Example
- Run on terminal
*Test input:*  
5 5  
1 2 N  
LMLMLMLMM  
3 3 E  
MMRMMRMRRM  

*Test output:*  
1 3 N  
5 1 E  

## Assumption
Rover must stay within it's prescribed grid even if commands are saying otherwise
