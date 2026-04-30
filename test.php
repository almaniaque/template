<?php

function checkWorker($nomVille) {
    include "tableau_datas.php"; 

    $Nom = [];
    $Post = [];
    $Ville = [];
    $Salaire = [];

    foreach ($tableau as $ligne) {

        if ($nomVille == "check") {
            $Ville[] = $ligne[2];
        }

        else if ($ligne[2] == $nomVille) {
            $Ville[] = $ligne[2];
            $Nom[] = $ligne[0];
            $Post[] = $ligne[1];
            $Salaire[] = $ligne[5];
        }
    }

    if ($nomVille == "check") {
        $detail = array_unique($Ville);
        print_r($detail);
    } else {
        print "Nombre de personnes trouvées : " . count($Nom) . PHP_EOL;
        print_r($Nom);
               
    }
}

$nomVille = readline("Entrez une ville ou 'check' : ");

checkWorker($nomVille);

?>