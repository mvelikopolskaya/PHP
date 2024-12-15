<?php 

abstract class Book {

    protected string $name;
    protected string $author;
    protected int $year;
    protected int $amountOfTakes = 0;
    protected string $address = "";

    function __construct($name, $author, $year) {
        $this->name = $name;
        $this->author = $author;
        $this->year = $year;
    }
    
    function setName($name) {
        $this->name = $name;
    }

    function setAuthor($author) {
        $this->author = $author;
    }

    function setYear($year) {
        $this->name = $year;
    }

    function getName() : string {
        return $this->name;
    }

    function getAuthor() : string {
        return $this->author;
    }

    function getYear() : int {
        return $this->year;
    }

    abstract function setAddress(string $text);

    function getAddress() : string {
        return $this->address;
    }

    function getAmountOfTakes() : string {
        return "The book {$this->getName()} was taken: {$this->amountOfTakes} times";
    }

    protected function incrementAmountOfTakes() {
        $this->amountOfTakes++;
    }

    protected function takeBook() {
        $this->incrementAmountOfTakes();
    }

    function showInfo() : string {
        return "Name: " . $this->getName() . PHP_EOL . 
                "Author: " . $this->getAuthor() . PHP_EOL . 
                "Address: " . $this->getAddress() . PHP_EOL;
    }
}

