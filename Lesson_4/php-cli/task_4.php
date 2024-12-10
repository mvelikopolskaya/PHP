<?php
/*
Объявить массив, индексами которого являются буквы русского языка, 
а значениями – соответствующие латинские буквосочетания 
(‘а’=> ’a’, ‘б’ => ‘b’, ‘в’ => ‘v’, ‘г’ => ‘g’, …, ‘э’ => ‘e’, ‘ю’ => ‘yu’, ‘я’ => ‘ya’). 
Написать функцию транслитерации строк.
*/

// docker run --rm -v ${pwd}/php-cli/:/cli php:8.2-cli php /cli/task_4.php

$alphabet = [
    'а' => 'a', 'б' => 'b', 'в' => 'v', 
    'г' => 'g', 'д' => 'd', 'е' => 'e', 
    'ё' => 'yo', 'ж' => 'zh', 'з' => 'z', 
    'и' => 'i', 'й' => 'y', 'к' => 'k', 
    'л' => 'l', 'м' => 'm', 'н' => 'n', 
    'о' => 'o', 'п' => 'p', 'р' => 'r', 
    'с' => 's', 'т' => 't', 'у' => 'u', 
    'ф' => 'f', 'х' => 'h', 'ц' => 'c', 
    'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sch', 
    'ъ' => '\'', 'ы' => "y'", 'ь' => '\'', 
    'э' => 'e', 'ю' => 'yu', 'я' => 'ya'
];

$str = "Привет, мИр!";

echo transliteration($str, $alphabet);

function transliteration($text, $transliterator){
    $result = "";
    for($i = 0; $i < strlen($text); $i++) {
        $key = mb_substr($text, $i, 1);
        if (mb_strtolower($key) != $key){
            $key = mb_strtolower($key);
            if (array_key_exists($key, $transliterator) ){
                $result .= mb_strtoupper($transliterator[$key]);
            } else {
                $result .= mb_strtoupper($key);
            }
        } else {
            if (array_key_exists($key, $transliterator) ){
            $result .= $transliterator[$key];
        } else {
            $result .= $key;
        }
        }
    }
    return $result;
}