<?php

// С помощью рекурсии организовать функцию возведения числа в степень.
// Формат: function power($val, $pow), где $val – заданное число, $pow – степень. 

// docker run --rm -v ${pwd}/php-cli/:/cli php:8.2-cli php /cli/task_5.php

echo power(2, 2);
function power($val, $pow): int{
    $result = 0;
    if ($pow == 0){
        $result = 1;
    }
    else {
        $result = $val * power($val, $pow - 1);
    }
    return $result;
}