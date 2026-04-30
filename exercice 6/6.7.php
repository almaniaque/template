<?php
$moyenne = 0;
$somme= 0;
$nombre=[];

for ($i=0; $i<9; $i++ ){
    $valeur= intval(readline("entrée un numero :"));
    $nombre[$i] = $valeur;
    $somme += $valeur ;
}
$moyenne = $somme / count($nombre);
$compte= count($nombre);

print_r ($nombre);
print $somme .PHP_EOL;
print "{$somme} / {$compte}".PHP_EOL;
print $moyenne .PHP_EOL;

?>