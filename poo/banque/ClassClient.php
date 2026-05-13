<?php

require_once("ClassBanque.php");
require_once("ClassCompte.php");


class Client {
    
    private $nom ;
    private $prenom ;
    private $adresse ;
    private $CP ;
    private $ville ;
    private $ouverture ;
    private $comptes ;
    private $banque ;

    public function __construct($nom, $prenom, $adresse, $CP, $ville, $ouverture, array $comptes = [] , Banque $banque ) {
        $this->nom = $nom ;
        $this->prenom = $prenom ;
        $this->adresse = $adresse ;
        $this->CP = $CP ;
        $this->ville = $ville ;
        $this->ouverture = $ouverture ;
        $this->comptes = $comptes ;
        $this->banque = $banque ;
    }

    public function getNom(){
        $this->nom = $nom ;
    }
    public function setNom(){
        return $this->nom ;
    }

    public function getPrenom(){
        $this->prenom = $prenom;
    }
    public function setPrenom(){
        return $this->prenom ;
    }

    public function getAdresse(){
        $this->adresse = $adresse ;
    }
    public function setAdresse(){
        return $this->adresse ;
    }

    public function getCP(){
        $this->CP = $CP ;
    }
    public function setCP(){
        return $this->CP ;
    }

    public function getVille(){
        $this->ville = $ville ;
    }
    public function setVille(){
        return $this->ville ;
    }

    public function getOuverture(){
        $this->ouverture = $ouverture ;
    }
    public function setOuverture(){
        return $this->ouverture ;
    }

    public function getCompte(){
        $this->comptes = $comptes ;
    }
    public function setCompte(array $comptes = []){
        return $this->comptes ;
    }

    public function getBanque(){
        $this->banque = $banque ;
    }
    public function setBanque(Banque $banque){
        return $this->banque ;
    }


    public static function CompteClient($CompteAffilie, $nom) {
        $resultat = [];

        foreach ($ompteAffilie as $comptes) {

            if (strtolower($comptes->getNomCompte()) == strtolower($nom)) {
                $resultat[] = $comptes;
            }
        }

        return $resultat;
    }

}

?>