# VEHICLE API

## How to used
1. Copy the application folder to your apache server
2. import the ninepine.sql into your mysql database
3. Change your DB credential in Vehicle.model.php

```
    private $servername = "localhost";
    private $username   = "reynard";
    private $password   = "password";
    private $database   = "ninepine";
```

## To use the unit testing
1. Install the PHPUnit
```
composer install
```
2. to test, type in commandline which is point into your api folder
```
vendor/bin/phpunit
```


### Now, you can use your api and you can point it the frontend.
