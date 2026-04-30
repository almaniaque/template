<?php
$nombre=intval(readline("entrée un nombre : "));
$result=intval(0);

for ($i=0;$i<=$nombre;$i++) {
    $result=$i+$result;
    print $result;
    print PHP_EOL;
}
?>