<?php

require_once __DIR__ . '/vendor/autoload.php';
echo __DIR__ . '/vendor/autoload.php' . PHP_EOL;

$result = main("config.ini");
echo $result; 

// docker build -t lesson_6 .

// docker container run -it -v ${pwd}/php-cli//code:/code/ lesson_6 composer install

// docker run -it -v ${pwd}/php-cli/code:/code lesson_6 php /code/app.php app.php
