<?php

function checkparking($nomPark) {
    ini_set('auto_detect_line_endings',TRUE);
    $handle = fopen('https://data.strasbourg.eu/api/explore/v2.1/catalog/datasets/occupation-parkings-temps-reel/exports/csv?lang=fr&timezone=Europe%2FBerlin&use_labels=true&delimiter=%3B','r');

    $parking = [];
    $detail = [];
    
    while ( ($data = fgetcsv($handle, 1000, ";") ) !== FALSE ) {
        $parking[] = $data;
    }

    fclose($handle);

    foreach ($parking as $ligne) {
        if ($nomPark == "check" ) {
            $result= $ligne[0] ." : " .$ligne[4];
            $detail[] = $result;
            
        }
        if ($ligne[0] == $nomPark) { 
            $result= $ligne[0] ." : " .$ligne[4] .", "  ." palce libre : " .$ligne[6];
            $detail[] = $result;            
        }

    }
    
    return $detail;
}
$nomPark = readline("Entrez le nom du parking ou sinon entrez : check : ");

$resultat = checkparking($nomPark);

print_r($resultat);

?>