<?php 

require_once __DIR__ . '/vendor/autoload.php';

$bookcase = new Bookcase(3);
$bookcaseID = $bookcase->getId();

$shelf = new Shelf(1, 5);
$shelfID = $shelf->getId();

$book_1 = new PaperBook("A", "AA", "1111");
$address = showBookAddress($bookcaseID, $shelfID);
$book_1->setAddress($address);

$book_2 = new DigitalBook("B", "BB", "2222");
$book_2->setAddress("http://www.library.com");

$bookcase->setShelves($shelf);
$shelf->putBook($book_1);

$book_1->takeBookFromLibrary();
$book_1->returnBook();
$book_1->takeBookFromLibrary();
$book_1->returnBook();
$book_1->takeBookFromLibrary();
$book_1->returnBook();
$book_1->takeBookFromLibrary();
$book_1->returnBook();
echo $book_1->getAmountOfTakes() . PHP_EOL;

echo $book_2->downloadBook();
echo $book_2->downloadBook();
echo $book_2->getAmountOfTakes();


function showBookAddress($bookcaseID, $shelfID){
    return "Book's address is bookcase №$bookcaseID, shelf №$shelfID";
}