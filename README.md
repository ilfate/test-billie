#Coding Challenge – Earth To Mars Time Conversion Service (MarsTimeService)

A service to calculate Mars Sol Date(MSD) and Martian Coordinated Time(MCT)

## How to run
`composer install`

`docker-compose up -d`

open `http://localhost:8023/` - to see the result

open `http://127.0.0.1:8023/?time=1585723803` - to test the result calculation of predefined date

Find the API contract in `swagger.yaml` file

run `php vendor/phpunit/phpunit/phpunit test` for tests
