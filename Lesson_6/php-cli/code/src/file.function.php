<?php 

function readAllFunction(array $config) : string {
    $address = $config['storage']['address'];
    if (file_exists($address) && is_readable($address)) {
        $file = fopen($address, 'rb');
        $content = '';
        while(!feof($file)) {
            $content .= fread($file, 100);
        }
        fclose($file);
        return $content;
    }
    else {
        return handleError("File doesn't exist");
    }
}

function addFunction(array $config) : string {
    $address = $config['storage']['address'];
    $name = readline("Enter name: ");
    $date = readline("Enter birth date (dd-MM-YYYY): ");

    if(validateDate($date) && validateName($name)) {
        $data = $name . ", " . $date . PHP_EOL;
        $fileHandler = fopen($address, 'a');
        if (fwrite($fileHandler, $data)) {
            fclose($fileHandler);
            return "Entry $data added into the file $address";
        }
        else {
            fclose($fileHandler);
            return handleError("Entry error. Data is not saved.");
        }
    } 
    else {
        return handleError("Entry error. Data is not saved.");
    }
}

function clearFunction(array $config) : string {
        $address = $config['storage']['address'];
    if (file_exists($address) && is_readable($address)) {
        $file = fopen($address, 'w');
        fwrite($file, '');
        fclose($file);
        return "File is cleared";
    }
    else {
        return handleError("File doesn't exist");
    }
}

function help() : string {
    return helpFunction();
}

function readConfig(string $configAddress): array | false {
    return parse_ini_file($configAddress, true);
}

function readProfilesDirectory (array $config) : string {
    $profilesDirectory = $config['profiles']['address'];
    if(!is_dir($profilesDirectory)) {
        mkdir($profilesDirectory);
    }
    else {
        $profiles = scandir($profilesDirectory);
        $result = "";
        if(count($profiles) > 2) {
            foreach($profiles as $profile){
                if(in_array($profile, ['.', '..'])) {
                    continue;
                }
                $result .= $profile . PHP_EOL;
            }
        }
        else {
            $result .= "The directory is empty" . PHP_EOL;
        }
        return $result;
    }
}

function readProfile(array $config) : string {
    $profilesDirectoryAddress = $config['profiles']['address'];

    if(!isset($_SERVER['argv'][2])) {
        return handleError("The profile's file isn't specified");
    }

    $profileFileName = $profilesDirectoryAddress . $_SERVER['argv'][2] . ".json";
    if(!file_exists($profileFileName)){
        return handleError("File $profileFileName doesn't exist");
    }

    $contentJson = file_get_contents($profileFileName);
    $contentArray = json_decode($contentJson, true);
    $info = "Name: " . $contentArray['name'] . PHP_EOL;
    $info .= "Last name: " . $contentArray['lastname'] . PHP_EOL;
    return $info;
}

function isBirthdayFunction(array $config): string {
    $address = $config['storage']['address'];
    $today = date("d-m");
    $celebrants = search($today, $address);
    if(!empty($celebrants)){
        return "Today is the birthday of:" . PHP_EOL . implode($celebrants);
    }
    else {
        return "Nobody has birthday today.";
    }
}

function deleteFunction(array $config) : string {
    $address = $config['storage']['address'];
    $requiredEntry = readline("Enter required name or date: ");
    $flag = false;
    if (file_exists($address) && is_readable($address)) {
        $file = fopen($address, 'rb');
        $content = [];
        while(!feof($file)) {
            $content[] = fgets($file);
        }
        fclose($file);
        foreach($content as &$data) {
            if(str_contains(mb_strtolower($data), mb_strtolower($requiredEntry))) {
                $data = "";
                $flag = true;
            }
        }
        $file = fopen($address, 'w');
        foreach($content as $data){
            if($data == ""){
                continue;
            }
            else {
                fwrite($file, $data);
            }  
        }
    }
    if(!$flag) {
        return "The $requiredEntry wasn't found";
    } 
    else {
        return "The $requiredEntry was deleted";
    }
}