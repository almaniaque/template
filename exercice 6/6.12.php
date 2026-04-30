<?php

$moyenne = 0;
$somme= 0;
$nombre=[];
$sup = 0;
$inf =0;
for ($i=0; $i<9; $i++ ){
    $valeur= intval(readline("entrée un numero :"));
    $nombre[$i] = $valeur;
    $somme += $valeur ;
}
$moyenne = $somme / count($nombre);
$compte= count($nombre);

for ( $i=0 ; $i<count($nombre); $i++ ) {
    if ($nombre[$i] < $moyenne){
        $inf++;
    }
    else {
        $sup++;
    }
}
print  " la moyenne est de " .number_format($moyenne,2,","," ");
print " il y a {$sup} note au dessu de la moyenne et {$inf} inferieur a la moyenne ." ;

?>