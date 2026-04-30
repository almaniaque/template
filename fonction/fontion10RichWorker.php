<?php

function checkRichWorker() {
    include "tableau_datas.php"; 
        $Nom = "";      
        $Salaire = intval(0);
        

    foreach ($tableau as $ligne) {
    
        $salaireClean = intval(str_replace([",", "$"], "", $ligne[5]));

        if ($Salaire < $salaireClean) {
            $Salaire = $salaireClean;
            $Nom = $ligne[0];
        }

    }
print "le salaire le plus elever est : " .$Salaire ."$" .PHP_EOL ."Et la personne qui le touche s'appelle : " .$Nom;
}

checkRichWorker();
?>