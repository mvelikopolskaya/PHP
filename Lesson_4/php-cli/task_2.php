<?php
require_once("task_1.php");
/*
Реализовать функцию с тремя параметрами: function mathOperation($arg1, $arg2, $operation), 
где $arg1, $arg2 – значения аргументов, $operation – строка с названием операции. 
В зависимости от переданного значения операции выполнить одну из арифметических операций 
(использовать функции из пункта 3) и вернуть полученное значение (использовать switch).
*/

// docker run --rm -v ${pwd}/php-cli/:/cli php:8.2-cli php /cli/task_2.php

print(mathOperation(3, 6, "+")) . PHP_EOL;
print(mathOperation(3, 6, "-")) . PHP_EOL;
print(mathOperation(3, 6, "*")) . PHP_EOL;
print(mathOperation(3, 6, "/")) . PHP_EOL;
print(mathOperation(3, 0, "/")) . PHP_EOL;


function mathOperation($arg1, $arg2, $operation): float | string{
    $result = 0;
    switch($operation){
        case "+":
            $result = addition($arg1, $arg2);
            break;
        case "-":
            $result = subtraction($arg1, $arg2);
            break;
        case "*":
            $result = multiplication($arg1, $arg2);
            break;
        case "/":
            $result = division($arg1, $arg2);
            break;
    }
    return "$arg1 $operation $arg2 = $result";
}