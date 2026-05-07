<?php
function villeDetect($nbdep) {
    ini_set('auto_detect_line_endings',TRUE);
    $handle = fopen('villes_france.csv','r');

    $departements = [];

    while ( ($data = fgetcsv($handle) ) !== FALSE ) {
        $departements[] = $data;
    }

    fclose($handle);

    $ville = [] ;
    

    foreach ($departements as $ligne) {
        if ($ligne[1] == $nbdep) { 
            $result= $ligne[8] ." " .$ligne[3];
            array_push($ville , $result);

            
        }
    }
    
    return;
}

$nbdep = readline("entrée un numero de département : ");
print_r(villeDetect($nbdep));


?>