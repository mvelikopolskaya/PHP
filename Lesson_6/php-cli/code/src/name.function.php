<?php 

function validateName(string $name) : bool {
    if(empty($name) || mb_strlen($name) < 2){
        return false;
    }
    return true;
}