<?php 

function search(string $request, string $fileAddress) : array{
    $arrayData = [];
    $result = [];
    $file = fopen($fileAddress, 'rb');
    while(!feof($file)) {
        $arrayData[] = fgets($file);
    }
    fclose($file);
    foreach($arrayData as $data) {
        if(str_contains(mb_strtolower($data), mb_strtolower($request))) {
           $result[] = $data;
        }
    }
    return $result;
}