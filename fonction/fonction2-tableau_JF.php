<?php

$saisie = readline("Entre une anée au format aaaa : ");
$dateSaisie = DateTime::createFromFormat('Y', $saisie);
$year = intval($dateSaisie->format('Y'));

$Date = easter_date($year);
$Day = date('j', $Date);
$Month = date('n', $Date);
$Year = date('Y', $Date);

$feries = [
    mktime(0, 0, 0, 1, 1, $year),      // Jour de l'an
    mktime(0, 0, 0, 5, 1, $year),      // Fête du travail
    mktime(0, 0, 0, 5, 8, $year),      // Victoire 1945
    mktime(0, 0, 0, 7, 14, $year),     // Fête nationale
    mktime(0, 0, 0, 8, 15, $year),     // Assomption
    mktime(0, 0, 0, 11, 1, $year),     // Toussaint
    mktime(0, 0, 0, 11, 11, $year),    // Armistice
    mktime(0, 0, 0, 12, 25, $year),    // Noël

    mktime(0, 0, 0, $Month, $Day + 1, $Year),  // Lundi de Pâques
    mktime(0, 0, 0, $Month, $Day + 39, $Year), // Ascension
    mktime(0, 0, 0, $Month, $Day + 50, $Year), // Pentecôte
];

foreach($feries as $value) {
    
    print date("d/m/Y",$value);
    print PHP_EOL;
}


?>