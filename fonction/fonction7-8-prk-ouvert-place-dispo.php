<?php

function checkparking($nomPark) {
    ini_set('auto_detect_line_endings',TRUE);
    $handle = fopen('occupation-parkings-temps-reel.csv','r');

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
    print_r($detail);

}
$nomPark = readline("entree le nom du parking ou sinon entree : check : ");
  
checkparking($nomPark);

?>