<?php 
class Shelf {
    protected int $id = 0;
    protected int $capacity;
    protected array $books = [];

    function __construct($id, $capacity) {
        $this->id = $id;
        $this->capacity = $capacity;
    }

    function setID($id) {
        $this->id = $id;
    }

    function setCapacity($capacity) {
        $this->capacity = $capacity;
    }
    
    function getId() : int {
        return $this->id;
    }

    function getCapacity() : int {
        return $this->capacity;
    }

    function getBooksAmount() : int  {
        return count($this->books);
    }

    function putBook(PaperBook $book) {
        if($this->getBooksAmount() < $this->capacity){
            $this->books[] = $book;
        }
    }

    function showInfo() : string {
        return "ID: " . $this->getId() . PHP_EOL . 
                "Capacity: " . $this->getCapacity() . PHP_EOL . 
                "Amount of books: " . $this->getBooksAmount(). PHP_EOL;
    }
}