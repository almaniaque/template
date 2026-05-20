<?php

require_once("ClassCompte.php");
require_once("Ref_Banque.php");

$comptes = [

    new Compte (
        "Thiebaut",
        "Courant",
        01,
        -200,
        0,
        0,
        0,
        -2000,
        $banques[0],
    ),

    new Compte (
        "Thiebaut",
        "Livret A",
        02,
        200,
        0,
        0,
        0,
        0,
        $banques[0],
    ),

    new Compte (
        "Wattrelot",
        "Courant",
        03,
        10000000,
        0,
        0,
        0,
        -2000,
        $banques[1]
    )
];


?>