<?php 

class PaperBook extends Book {
    protected bool $isTaken = false;

    function __construct($name, $author, $year) {
        parent::__construct($name, $author, $year);
    }

    function returnBook() {
        $this->isTaken = false;
    }

    function getIsTaken() : bool {
        return $this->isTaken;
    }

    function setAddress(string $bookAddress) {
        $this->address = $bookAddress;
    }

    function takeBook(){
        parent::takeBook();
        $this->isTaken = true;
    }

    function takeBookFromLibrary() : bool {
        if($this->isTaken) {
            return false;
        }
        $this->takeBook();
        return true;
    }
}