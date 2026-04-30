<?php

$nombre=[];

for ($i=0; $i<9; $i++ ){
    $valeur= intval(readline("entrée un numero :"));
    $nombre[$i] = $valeur;
}
print_r ($nombre);
?>