<?php
function villeDetect() {
    ini_set('auto_detect_line_endings',TRUE);
    $handle = fopen('villes_france.csv','r');

    $departements = [];

    while ( ($data = fgetcsv($handle) ) !== FALSE ) {
        $departements[] = $data;
    }

    fclose($handle);

    $ville = [] ;
    $nbdep = readline("entrée un numero de département : ");

    foreach ($departements as $ligne) {
        if ($ligne[1] == $nbdep) { 
            $result= $ligne[8] ." " .$ligne[3];
            array_push($ville , $result);

            
        }
    }
    print_r($ville);
    return;
}
 
villeDetect();

?>