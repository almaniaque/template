<?php

class Enfant {

    private $nomParent;
    private $prenom;
    private $ageEnfant;


    public function __construct($nomParent, $prenom, $ageEnfant) {
        $this->nomParent = $nomParent; 
        $this->prenom = $prenom;
        $this->ageEnfant = $ageEnfant;
    }

    
    public function getNomParent(){
        return $this->nomParent;
    }
    public function setNomParent(){
        $this->nomParent = $nomParent;
    }

    public function getPrenom(){
        return $this->prenom;
    }
    public function setPrenom(){
        $this->prenom = $prenom;
    }

        public function getAgeEnfant(){
        return $this->ageEnfant;
    }
    public function setAgeEnfant(){
        $this->ageEnfant = $ageEnfant;
    }

    public function chequeNoel() {

    $ageEnfant = $this->ageEnfant;

    if ($ageEnfant > 0 && $ageEnfant <= 10) {
        return 20;
    }
    else if ($ageEnfant >= 11 && $ageEnfant <= 15) {
        return 30;
    }
    else if ($ageEnfant >= 16 && $ageEnfant <= 18) {
        return 50;
    }

    return 0;
}

}



?>