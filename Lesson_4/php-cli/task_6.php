<?php

// Написать функцию, которая вычисляет текущее время 
// и возвращает его в формате с правильными склонениями, например:
// 22 часа 15 минут
// 21 час 43 минуты.

// docker run --rm -v ${pwd}/php-cli/:/cli php:8.2-cli php /cli/task_6.php

function currentTime(){
    $result = "Текущее время: ";
    $time = getdate();
    $hours = $time["hours"];
    $minutes = $time["minutes"];
    if ($hours == 0 || 5 <= $hours % 10 || $hours % 10 <= 20){
        $cur_hour = $hours . " часов ";
    }
    elseif((1 < $hours % 10 && $hours % 10 < 5) || $hours % 10 <= 21){
        $cur_hour = $hours . " часа ";
    }
    elseif($hours == 1 || $hours == 21){
        $cur_hour = $hours . " час ";
    }
    if (($minutes >= 5 && $minutes <= 20) || $minutes % 10 >= 5 || $minutes % 10 == 0 || $minutes == 0) {
        $cur_min = $minutes . " минут";
    }
    elseif ($minutes == 1 || $minutes % 10 == 1) {
        $cur_min = $minutes . " минута";
    }
    elseif (($minutes <= 2 && $minutes >= 4) || ($minutes % 10 >= 2 && $minutes % 10 <= 4)) {
        $cur_min = $minutes . " минуты";
    }
    $result .= $cur_hour . $cur_min;
    return $result;
}

echo currentTime();