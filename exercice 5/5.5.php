<?php
$table=intval(readline("entrée un nombre de votre choix"));

for( $i = 0 ; $i <= 10 ; $i++ ) {
    $result = $table*$i;
    print "$table x $i = " .$result ;
    print PHP_EOL;
}

?>