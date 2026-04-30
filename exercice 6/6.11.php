<?php

$tab1 = [4,8,7,9,1,5,4,6];
$tab2 = [7,6,5,2,1,3,7,4];
$somme=0;

for ($i=0 ; $i<count($tab1); $i++ ){
    for($i2=0 ; $i2<count($tab2); $i2++ )
        $somme += $tab1[$i] * $tab2[$i2];
}
 
print $somme
?>