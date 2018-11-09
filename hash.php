<?php

    // php hash.php [-hash]+ [-options]*

    $OPTIONS = ["-help"];

    // check arg length 
    if(count($argv) <= 1) {
        echo "Invalid arguments. First argument must be your file and remaining arguments should be your preferred hash algorithm and/or options. Use \"-help\" for more information. \n";

    } elseif (count($argv) >= 2 )  {

        // display help
        if($argv[1] == $OPTIONS[0]) {
            printhelp();
        } elseif (  !($argv[1] == $OPTIONS[0]) && (file_exists($argv[1])) ) {

            $file = $argv[1];
            echo "File: " . $file . PHP_EOL;

            foreach($argv as $value) {

                $hashoption = substr($value, 1); //extract -

                if( in_array($hashoption, hash_algos() ) ) {
                    
                    $hash = hash_file($hashoption, $file);
                    echo printf("[%-15s] %s", $hashoption, $hash) . PHP_EOL;

                }                
            }

        } else {
            echo "\nFile not found, please check path and try again.";
        }
    }

    function printhelp() {
        echo "\nUsage: php hash.php <file> [-hashes...] [-help] ........  \n";
        echo ".. Supported hash algorithms are: \n";
        echo print_r(hash_algos());
        echo "\nCheck out: http://php.net/manual/en/function.hash-algos.php for more information";
    }

?>