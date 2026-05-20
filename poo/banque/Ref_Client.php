<?php

require_once("ClassClient.php");
require_once("ClassCompte.php");
require_once("ClassBanque.php");

require_once("Ref_Compte.php");
require_once("Ref_Banque.php");

$clients = [

    new Client (
        "1",
        "Thiebaut",
        "Davy",
        "3 rue de la republique",
        "02700",
        "Amigny-Rouy",
        "23/03/2024",
        $banques[0],
        Client::CompteClient($comptes, "Thiebaut"),
        
    ),
    new Client (
        "2",
        "Wattrelot",
        "Maxence",
        "1 rue de la liberte",
        "02000",
        "neuchatel",
        "02/01/2024",
        $banques[1],
        Client::CompteClient($comptes, "Wattrelot"),
    )

];

?>