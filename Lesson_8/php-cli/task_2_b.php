<?php
// 6. Дан код:

// docker run --rm -v ${pwd}/php-cli/:/cli php:8.2-cli php /cli/task_2_b.php

// Немного изменим п.5

class A {
    public function foo() {
    static $x = 0;
    echo ++$x . PHP_EOL;
    }
}

class B extends A {
    
}
$a1 = new A();
$b1 = new B();
$a1->foo();
$b1->foo();
$a1->foo();
$b1->foo();

// Что он выведет на каждом шаге? Почему?

// 1
// 2
// 3
// 4

// Слово static определяет статическую область видимости, т.е. переменная сохраняет свое значение между вызовами функции.