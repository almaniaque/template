<?php

function validsecu() {
    $numSecu = readline("entrée votre numero de carte de sécurité social : ");
    $numSecu = strtoupper(str_replace(" ", "", $numSecu));

    // calcule de la clé de securite
    $numeroSansCle = substr($numSecu, 0, -2);
    $numeroSansCleCalcul = str_replace(["2A", "2B"], ["19", "18"], $numeroSansCle);

    $cleValide = 97 - ($numeroSansCleCalcul % 97);

    print "clé de securité : " . $cleValide . PHP_EOL;

    // découpage avec gestion des départements 970 à 989
    $deptTest = substr($numSecu, 5, 3);

    if (intval($deptTest) >= 970 && intval($deptTest) <= 989) {
        $num = [
            substr($numSecu, 0, 1),
            substr($numSecu, 1, 2),
            substr($numSecu, 3, 2),
            substr($numSecu, 5, 3),
            substr($numSecu, 8, 3),
            substr($numSecu, 11, 3),
            substr($numSecu, 14, 2)
        ];
    } else {
        $num = [
            substr($numSecu, 0, 1),
            substr($numSecu, 1, 2),
            substr($numSecu, 3, 2),
            substr($numSecu, 5, 2),
            substr($numSecu, 7, 3),
            substr($numSecu, 10, 3),
            substr($numSecu, 13, 2)
        ];
    }

    // definition des tranches valides
    $numvalide = [
        "sexe" => ["1", "2", "3", "4", "7", "8"],
        "annee" => array_map(fn($n) => str_pad($n, 2, "0", STR_PAD_LEFT), range(0, 99)),
        "mois" => array_map(fn($n) => str_pad($n, 2, "0", STR_PAD_LEFT), range(1, 12)),
        "departement" => array_merge(
            array_map(fn($n) => str_pad($n, 2, "0", STR_PAD_LEFT), range(1, 95)),
            ["2A", "2B", "99"],
            array_map('strval', range(970, 989))
        ),
        "commune" => array_map(fn($n) => str_pad($n, 3, "0", STR_PAD_LEFT), range(1, 999)),
        "ordre" => array_map(fn($n) => str_pad($n, 3, "0", STR_PAD_LEFT), range(0, 999)),
    ];

    $sexe = $num[0];
    $annee = $num[1];
    $mois = $num[2];
    $departement = $num[3];
    $commune = $num[4];
    $ordre = $num[5];
    $cle = $num[6];

    // verification de la validité
    if (
        in_array($sexe, $numvalide["sexe"]) &&
        in_array($annee, $numvalide["annee"]) &&
        in_array($mois, $numvalide["mois"]) &&
        in_array($departement, $numvalide["departement"]) &&
        in_array($commune, $numvalide["commune"]) &&
        in_array($ordre, $numvalide["ordre"]) &&
        intval($cle) === $cleValide
    ) {
        print "carte valide " . PHP_EOL;
    } else {
        print "carte invalide " . PHP_EOL;
    }

    return;
}

validsecu();

?>