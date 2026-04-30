<?php

function daydetec($day) {
    $dateObj = DateTime::createFromFormat('d/m/Y', $day);

    if (!$dateObj) {
        return "Date invalide";
    }

    $D = [
        'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'
    ];

    $FD = [
        'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'
    ];

    $jourAnglais = $dateObj->format('l');

    $index = array_search($jourAnglais, $D);

    return $FD[$index];
}

$date = readline("Saisissez une date au format jj/mm/aaaa : ");

$day = daydetec($date);

print $day . PHP_EOL;


?>