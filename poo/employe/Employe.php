<?php
require_once("ClassEmploye.php");
include "ref_employe.php";
$totalEmp = count($employe);

echo "Nmobre d'employé : " .$totalEmp .PHP_EOL; 
echo "Masse salariale brut annuelle : " .Employe::MassSalarialbrut($employe) . " €" .PHP_EOL;;
echo "Masse salariale brut total annuelle : " .Employe::MassSalarialbrutTotal($employe) . " €" .PHP_EOL;;

while (true) {
echo "---------- Menu ----------" .PHP_EOL;
echo "1. tri dans l'ordre alphabetique croissant " .PHP_EOL;
echo "2. tri dans l'ordre alphabetique decroissant" .PHP_EOL;
echo "3. tri par service dans l'ordre croissant" .PHP_EOL;
echo "4. tri par service dans l'ordre decroissant" .PHP_EOL;
echo "5. retour " .PHP_EOL;

    $tris= readline("quel trie souhaitez vous ? ");
    if ($tris== 1){
        Afficher(trierEmploye($employe, "nom" , "ASC"));
    }
    else if ($tris== 2){
        Afficher(trierEmploye($employe, "nom" , "DESC"));
    }

    else if ($tris== 3){
        Afficher(trierEmploye($employe, "service" , "ASC"));
    }
    else if ($tris== 4){
        Afficher(trierEmploye($employe, "service" , "DESC"));
    }
    else if ($tris== 5){
        break;
    }
}



function Afficher($employe) {
    foreach ($employe as $ligne){
        echo "--------------------Employé--------------------".PHP_EOL;
        echo "Nom : " .$ligne->getnom() .PHP_EOL;
        echo "Prenom : " .$ligne->getprenom() .PHP_EOL;
        echo "Service : " .$ligne->getService() .PHP_EOL;
        echo "Ancienneté :" .$ligne->calculAnciennete() ." ans" .PHP_EOL;
        echo "Prime sur Salaire : " .$ligne->primeSalaire() ."€ par ans" .PHP_EOL;
        echo "Prime sur l'ancienneté : " .$ligne->PrimeAnciennete() ."€ cette Année " .PHP_EOL;
        echo $ligne->VersementPrime().PHP_EOL;
        echo "agence : " .$ligne->getAgence()->getNomAgence().PHP_EOL;
        echo "adresse : " .$ligne->getAgence()->getAdresse().PHP_EOL;
        echo "CP : " .$ligne->getAgence()->getCP().PHP_EOL;
        echo "Ville : " .$ligne->getAgence()->getVille().PHP_EOL;
        echo "Restauration : " .$ligne->getAgence()->getRestauration().PHP_EOL;
        echo " à l'attribution de cheque vacance " .$ligne->ChequeVacance().PHP_EOL;
        echo "Enfants : " . PHP_EOL;
        foreach ($ligne->getEnfant() as $enfant) {
            echo "- " . $enfant->getPrenom()
            . " (" . $enfant->getAgeEnfant() . " ans)"
            . " : cheque noel = "
            . $enfant->chequeNoel()
            . " €"
            . PHP_EOL;
        }
        echo "-----------------------------------------------".PHP_EOL;
    }
    
}

function trierEmploye($employe, $colonne, $ordre = "ASC") {
    
    usort($employe, function($a, $b) use ($colonne, $ordre) {

        if ($colonne == "nom"){
            $valA = strtolower($a->getNom());
            $valB = strtolower($b->getNom());
            if (($valA == $valB) == 0) {
                $valA = strtolower($a->getPrenom());
                $valB = strtolower($b->getPrenom());
            }
        }

        if ($colonne == "service"){
            $valA = strtolower($a->getService());
            $valB = strtolower($b->getService());
        }

        if ($valA == $valB) return 0;

        if ($ordre == "ASC") {
            return ($valA < $valB) ? -1 : 1;
        } 
        else {
            return ($valA > $valB) ? -1 : 1;
        };

        
    });
    return $employe;
}

?>