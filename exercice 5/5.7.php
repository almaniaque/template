<?php

$nombre=intval(readline("entrée un nombre : "));
$result=intval(1);

for ($i=$nombre;$i>1 ; $i--) {
    $result=$result*$i;
   
    
}
 print "la factorielle est : " .$result ;
?>