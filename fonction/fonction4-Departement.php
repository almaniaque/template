<?php
function depDetect() {
    ini_set('auto_detect_line_endings',TRUE);
    $handle = fopen('departement.csv','r');

    $departements = [];

    while ( ($data = fgetcsv($handle) ) !== FALSE ) {
        $departements[] = $data;
    }

    fclose($handle);

    $nbdep = readline("entrée un code de département : ");

    foreach ($departements as $ligne) {
        if ($ligne[1] == $nbdep) { // colonne du numéro
            print "Nom du département : " . $ligne[3] . PHP_EOL;
        }
}
    return;
}
 
depDetect();

?>