<?php
require_once("ClassCompte.php");
require_once("Ref_Compte.php");

class Banque {
    
    private $nom ;
    private $adresse ;
    private $CP ;
    private $ville ;

    public function __construct($nom, $adresse, $CP, $ville ) {
        $this->nom = $nom ;
        $this->adresse = $adresse ;
        $this->CP = $CP ;
        $this->ville = $ville ;
    }

    public function getNom(){
        return $this->nom ;    
    }
    public function setNom(){
        $this->nom =$nom ;    
    
    }

    public function getAdresse(){
        return $this->adresse ;    
    }
    public function setAdresse(){
        $this->adresse = $adresse ;    
    
    }

    public function getCP(){
        return $this->CP ;   
    }
    public function setCP(){
        $this->CP = $CP ;    
 
    }

    public function getVille(){
        return $this->ville ;    
    }
    public function setVille(){
        $this->ville = $ville ;    
    
    }
}

?>