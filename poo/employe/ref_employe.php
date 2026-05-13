<?php
require_once("ClassEmploye.php");
require_once("ClassDirecteur.php");
require_once("ClassEnfant.php");
require_once("Agence_ref.php");
require_once("Enfant_ref.php");


$employe = [

    new Employe(
        "Thiebaut",
        "Davy",
        "23/03/2016",
        "developpeur senior",
        "30k",
        "developpement",
        $agence[0],
        Employe::EnfantEmploye($Enfant, "Thiebaut"),
    ),

    new Employe(
        "Faidherbe",
        "Alisson",
        "23/03/2010",
        "comptable",
        "30k",
        "RH",
        $agence[1],
        Employe::EnfantEmploye($Enfant, "Faidherbe"),
    ),

    new Employe(
        "Gublin",
        "Caroline",
        "23/03/2026",
        "secretaire",
        "26k",
        "RH",
        $agence[0],
        Employe::EnfantEmploye($Enfant, "Gublin"),
    ),

    new Employe(
        "Lombaard",
        "reiner",
        "23/03/2015",
        "responssable developpement ",
        "35k",
        "developpement",
        $agence[1],
        Employe::EnfantEmploye($Enfant, "Lombaard"),
    ),

    new Directeur(
        "Lesains",
        "Jerome",
        "23/03/2005",
        "directeur",
        "50k",
        "direction",
        $agence[0],
        Employe::EnfantEmploye($Enfant, "Lesains"),
   ) 

];




?>