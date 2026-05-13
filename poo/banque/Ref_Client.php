<?php

require_once("ClassClient.php");

$clients = [

    new Client (
        "Thiebaut",
        "Davy",
        "3 rue de la republique",
        "02700",
        "Amigny-Rouy",
        Compte::CompteClient($comptes, "Thiebaut"),
        $banques[0],
    )
]

?>