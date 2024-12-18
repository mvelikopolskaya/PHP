<?php
namespace Geekbrains\Application1\Models;
class Validator {
    function validateDate(string $date): bool {
    $dateBlocks = explode("-", $date);
    $year = date('Y');
    if(count($dateBlocks) < 3){
        return false;
    }
    if(isset($dateBlocks[0]) && ($dateBlocks[0] <= 0 || $dateBlocks[0] > 31)) {
        return false;
    }
    if(isset($dateBlocks[1]) && ($dateBlocks[1] <= 0 || $dateBlocks[1] > 12)) {
        return false;
    }
    if(isset($dateBlocks[2]) && ($year - $dateBlocks[2] >= 100 || $dateBlocks[2] > $year)) {
        return false;
    }
    return true;
    }

    function validateName(string $name) : bool {
        if(empty($name) || mb_strlen($name) < 2){
            return false;
        }
        return true;
    }
}
