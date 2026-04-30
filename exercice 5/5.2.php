<?php
$nombre = random_int(1, 20);
$entreeUt = intval(readline("Saisissez un chiffre entre 1 et 20 : "));

while ($nombre != $entreeUt) {
    if ($entreeUt < 1 or $entreeUt > 20) {
        print "uniquement entre 1 et 20 . ";
    }
    if ($nombre > $entreeUt) {
        print "C'est plus grand. ";
    } 
    else if ($nombre < $entreeUt) {
        print "C'est plus petit. ";
    }
    
    $entreeUt = intval(readline("Essayez à nouveau : "));
}


print "Bien joué !";
?>