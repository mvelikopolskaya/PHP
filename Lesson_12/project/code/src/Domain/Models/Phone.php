<?php 

namespace Geekbrains\Application1\Domain\Models;
class Phone {
    private string $number;

    function __construct(){
        $this->number = "+79992360671";
    }

    function getPhone() {
        return $this->number;
    }
}