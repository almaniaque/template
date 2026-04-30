<?php


$menu = [
    "Liste des candidats",
    "Ajout de candidat ",
    "Modification des informations d’un candidat ",
    "Recherche ",
    "Quitter",
];
print_r($menu);

$liste = $menu[0];
$ajout = $menu[1];
$modifier = $menu[2];
$recherche = $menu[3];
$quitte = $menu[4];

$MenuSelect= readline("entrée le menu souhaité");


function checkCandidat() {
    ini_set('auto_detect_line_endings',TRUE);
    $handle = fopen('hrdata 3.csv','r');

    $listeCDT = [];
    $detail = [];
    
    while ( ($data = fgetcsv($handle, 1000, ";") ) !== FALSE ) {
        $listeCDT[] = $data;
    }

    fclose($handle);

    foreach ($listeCDT as $ligne) {
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
?>