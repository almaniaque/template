<?php
$prix=[];
$montant=null;


for ($i=0;$i<5;$i++){
    $valeur=intval(readline("entrée le prix de l'article : "));
    $prix[] = $valeur;
    $montant += $valeur;
}
print $montant .PHP_EOL;

$payement=intval(readline("entrée le payement :"));
$monnaie=[0, 0, 0, 0 ];
$somme = [10 , 5 , 2 , 1];
$rendre =$payement-$montant;

if ($payement < $montant) {
    print "payement insuffisant veuillez recommencer " .PHP_EOL;
    
}

for ($t1 = 0; $t1 < count($monnaie); $t1++) {
    while ($rendre >= $somme[$t1]) {
        $rendre = $rendre - $somme[$t1];
        $monnaie[$t1]++;
    }
}

print "montant rendu :" .PHP_EOL;
print "billet de 10 :" .$monnaie[0] .PHP_EOL;
print "billet de 5 :" .$monnaie[1] .PHP_EOL;
print "piece de 2 :" .$monnaie[2] .PHP_EOL;
print "piece de 1 :" .$monnaie[3] .PHP_EOL;

?>