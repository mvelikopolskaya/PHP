<?php 
interface PatternCheck {
    function checkUrl(string $text) : bool;
}

class DigitalBook extends Book implements PatternCheck{
    function __construct($name, $author, $year) {
        parent::__construct($name, $author, $year);
    }

    function setAddress(string $url) {
        $this->address = $url;
    }

    function downloadBook(){
        $url = $this->checkUrl($this->getAddress());
        if($url) {
            $this->takeBook();
            return "You downloaded the book {$this->getName()}" . PHP_EOL;
        }
        return "Check your url";
    }

    function checkUrl(string $url) : bool {
        $regex = "/^(https?:\/\/)?([\da-z.-]+)\.([a-z.]{2,6})([\/\w.-]*)*\/?$/";
        if(!preg_match($regex, $url)) {
            return false;
        }
        return true;
    }
}