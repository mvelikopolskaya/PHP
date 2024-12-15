<?php
// 6. Дан код:

// docker run --rm -v ${pwd}/php-cli/:/cli php:8.2-cli php /cli/task_2_a.php

class A {
    public function foo() {
    static $x = 0;
    echo ++$x . PHP_EOL;
    }
}

$a1 = new A();
$a2 = new A();
$a1->foo();
$a2->foo();
$a1->foo();
$a2->foo();

// Что он выведет на каждом шаге? Почему?

// 1
// 2
// 3
// 4

// Слово static определяет статическую область видимости, т.е. переменная сохраняет свое значение между вызовами функции.