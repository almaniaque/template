<?php


class Banque {
    
    private $nom ;
    private $adresse ;
    private $CP ;
    private $ville ;

    public function __construct($nom, $adresse, $CP, $ville ) {
        $this->nom = $nom ;
        $this->adress = $adresse ;
        $this->CP = $CP ;
        $this->ville = $ville ;
    }

    public function getNom(){
        $this->nom =$nom ;
    }
    public function setNom(){
        return $this->nom ;
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
}

?>