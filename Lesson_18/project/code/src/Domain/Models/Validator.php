<?php
namespace Geekbrains\Application1\Domain\Models;
class Validator {
    public static function validateDate(string $date): bool {
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

    public static function validateText(string $text) : bool {
        if(empty($text) || mb_strlen($text) < 2){
            return false;
        }
        return true;
    }

    public static function dateMatch(string $date) : bool {
        $patternDate = '/^(\d{2}-\d{2}-\d{4})$/';
        return preg_match($patternDate,$date);
    }

    public static function textMatch(string $text) : bool{
        $patternNotHTML = '/<([^>]+)>/';
        return preg_match($patternNotHTML, $text);
    }
    
    
}