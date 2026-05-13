<?php

class Agence {
    
    private $NomAgence;
    private $adresse;
    private $CP;
    private $Ville;
    private $Restauration;

    public function __construct($NomAgence, $adresse, $CP, $Ville, $Restauration) {
        $this->NomAgence = $NomAgence; 
        $this->adresse = $adresse;
        $this->CP = $CP;
        $this->Ville  = $Ville;
        $this->Restauration  = $Restauration;


    }

    public function getNomAgence(){
        return $this->NomAgence;
    }
    public function setNomAgence(){
        $this->NomAgence = $NomAgence;
    }

    public function getAdresse(){
        return $this->adresse;
    }
    public function setNomAdressee(){
        $this->adresse = $adresse;
    }

    public function getCP(){
        return $this->CP;
    }
    public function setCP(){
        $this->CP = $CP;
    }

    public function getVille(){
        return $this->Ville;
    }
    public function setVille(){
        $this->Ville = $Ville;
    }

    public function getRestauration(){
        return $this->Restauration;
    }
    public function setRestauration(){
        $this->Restauration = $Restauration;
    }

    
}



?>