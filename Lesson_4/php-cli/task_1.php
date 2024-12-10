<?php

//  Реализовать основные 4 арифметические операции в виде функции с тремя параметрами – 
//  два параметра это числа, третий – операция. Обязательно использовать оператор return.

// docker run --rm -v ${pwd}/php-cli/:/cli php:8.2-cli php /cli/task_1.php

function addition($numA, $numB): int |float{
    return $numA + $numB;
}

function subtraction($numA, $numB): int | float {
    return $numA - $numB;
}

function multiplication($numA, $numB): int | float{
    return $numA * $numB;
}

function division($numA, $numB): float | int | string {
    return ($numB != 0) ? $numA / $numB : "You can't divide by zero";
}