<?php

/* Объявить массив, в котором в качестве ключей будут использоваться названия областей,
а в качестве значений – массивы с названиями городов из соответствующей области. 
Вывести в цикле значения массива, чтобы результат был таким:
Московская область: Москва, Зеленоград, Клин Ленинградская область: Санкт-Петербург, 
Всеволожск, Павловск, Кронштадт Рязанская область …
(названия городов можно найти на maps.yandex.ru).
*/

// docker run --rm -v ${pwd}/php-cli/:/cli php:8.2-cli php /cli/task_3.php

$cities = array(
  'Московская область' => ['Москва', 'Зеленоград', 'Клин'],
  'Ленинградская область' => ['Санкт-Петербург', 'Всеволожск', 'Павловск', 'Кронштадт'],
  'Рязанская область' => ['Рязань', 'Рыбное', 'Спасск-Рязанский']
);

foreach($cities as $key => $value){
  $region =  $key. ": ";
  $townsList = "";
  foreach($value as $town){
      (next(array: $value)) ? $townsList .= $town . ", " : $townsList .= "$town\n";
  }
  echo "$region $townsList";
} 