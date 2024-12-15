<?php 
class Bookcase {
    protected static int $id = 0;
    protected int $capacity;
    protected array $shelves = [];

    function __construct($capacity) {
        Bookcase::$id++;
        $this->capacity = $capacity;
    }

    function setCapacity($capacity) {
        $this->capacity = $capacity;
    }
    
    function getId() : int {
        return Bookcase::$id;
    }

    function getCapacity() : int {
        return $this->capacity;
    }

    function getShelvesAmount() : int  {
        return count($this->shelves);
    }

    function setShelves(Shelf $shelf) {
        if($this->getShelvesAmount() < $this->capacity){
            $this->shelves[] = $shelf;
        }
    }


    function showInfo() : string {
        return "ID: " . $this->getId() . PHP_EOL . 
                "Capacity: " . $this->getCapacity() . PHP_EOL . 
                "Amount of shelves: " . $this->getShelvesAmount(). PHP_EOL;
    }
}