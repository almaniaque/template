<?php

$nombre = [];
$entree = null;
$plusGrand = null;
$position = 0;
$index = 0;

while (true) {
    $entree = intval(readline("Entre un nombre : "));

    if ($entree === 0) {
        break;
    }

    $nombre[] = $entree;
    $index++;

    if ($plusGrand === null || $entree > $plusGrand) {
        $plusGrand = $entree;
        $position = $index;
    }
}

print "Le nombre le plus grand est : " . $plusGrand . " et il était à la position : " . $position ;

?>