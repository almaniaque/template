<?php
$plusGrand =0;
$position =0;
$nombre=[];

for ($i=0; $i<20 ; $i++) {
    $entree=intval(readline("entrée un nombre "));
    $nombre[$i] = $entree;
    if ($entree > $plusGrand) {
        $plusGrand = $entree;
        $position = $i;
    }
}
print "le nombre le plus grand est : " .$plusGrand ." et il etait a la position :" .$position;

?>