<?php

$saisie=intval(readline("entrée le nombre de valeur souhaité :"));
$valeur=[];
$pos=0;
$neg=0;

for($i=0; $i<$saisie;$i++) {
    $entree=intval(readline("entée vos valeur (positive ou négative) : "));
    $valeur[$i] = $entree;
    if ($entree < 0) {
        $neg++;
    }
    else if ($entree < 0){
        $pos++;
    }
}
print "valeur positive :" .$pos .PHP_EOL ;
print "valeur négative :" .$neg  ;
?>