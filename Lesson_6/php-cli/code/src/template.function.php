<?php 
function handleError(string $errorText) : string {
    return "\033[31m" . $errorText . " \r\n \033[97m";
}

function helpFunction() : string {
    $help = "A program for managing the storage of files" . PHP_EOL;
    $help .= "The call order" . PHP_EOL . PHP_EOL;
    $help .= "php /code/app.php [COMMAND]" . PHP_EOL . PHP_EOL;
    $help .= "Available commands:" . PHP_EOL;
    $help .= "read–all - read the whole file" . PHP_EOL;
    $help .= "add - add an entry" . PHP_EOL;
    $help .= "birthday - shows who's having a birthday today" . PHP_EOL;
    $help .= "read-profiles - read a profiles directory" . PHP_EOL;
    $help .= "read-profile - read a profile" . PHP_EOL;
    $help .= "delete - delete an entry" . PHP_EOL;
    $help .= "clear - clear the file" . PHP_EOL;
    $help .= "help - help ";
    return $help;
}