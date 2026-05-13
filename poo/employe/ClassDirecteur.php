<?php    

    require_once("ClassEmploye.php");

    class Directeur {

        private $nom;
        private $prenom;
        private $enfant;
        private $entree;
        private $poste;
        private $salaire;
        private $service;
        private $Agence;

        public function __construct($nom ,$prenom ,$entree ,$poste ,$salaire ,$service, Agence $Agence, array $enfant = []) {
        $this->nom = $nom; 
        $this->prenom = $prenom;
        $this->enfant = $enfant;
        $this->entree = $entree;
        $this->poste = $poste;
        $this->salaire = $salaire;
        $this->service = $service;
        $this->Agence = $Agence;

        }

    public function getNom(){
        return $this->nom;
    }
    public function setNom(){
        $this->nom = $nom;
    }

    public function getPrenom(){
        return $this->prenom;
    }
    public function setPrenom(){
        $this->prenom = $prenom;
    }


    public function getEntree(){
        return $this->entree;
    }
    public function setEntree(){
        $this->entree = $entree;
    } 
    
    
    public function getPoste(){
        return $this->poste;
    }
    public function setPoste(){
        $this->poste =$poste;
    } 
    
    
    public function getSalaire(){
        return $this->salaire;
    }
    public function setSalaire(){
        $this->salaire =$salaire;
    }
    
    
    public function getService(){
        return $this->service;
    }
    public function setService(){
        $this->service = $service;
    }
    
    public function getAgence(){
        return $this->Agence;
    }
    public function setAgence(Agence $Agence){
        $this->Agence = $Agence;
    }

    public function getEnfant(){
        return $this->enfant;
    }
    public function setEnfant(array $enfants = []){
        $this->enfant = $enfants;
    }

    public function calculAnciennete(){
        $today = new DateTime();
        $dateEntree = DateTime::createFromFormat("d/m/Y", $this->entree);

        $anciennete = $today->diff($dateEntree);

        return $anciennete->format("%Y");
    }

    public function primeSalaire(){
        $salaireInt = str_replace("k", "", strtolower($this->salaire));
        $salaireBrut = (int)$salaireInt * 1000;

        return $salaireBrut * 0.07;
    }

    public function PrimeAnciennete(){
        $salaireInt = str_replace("k", "", strtolower($this->salaire));
        $salaireBrut = (int)$salaireInt * 1000;
        $primeAnciennete =($salaireBrut * 0.03) * $this->calculAnciennete();
        
        return $primeAnciennete;
    }

    public function VersementPrime() {
        $Date = "30/11" ;
        $today = new DateTime();
        
        if ($today->format("d/m") == $Date){
            echo "virement emis ce jour : " .$Date .PHP_EOL;
        }
        else {
            echo "Trop tot pour la prime ";
        }
    }

    public static function MassSalarialbrut($employe) {

        $total = 0 ; 

        foreach ($employe as $ligne) {

            $salaireInt = str_replace("k", "", strtolower($ligne->getSalaire()));
            $salaireBrut = (int)$salaireInt * 1000;

            $total += $salaireBrut;
        }
        return $total;
    }

    public static function MassSalarialbrutTotal($employe) {

        $total = 0 ; 

        foreach ($employe as $ligne) {

            $salaireInt = str_replace("k", "", strtolower($ligne->getSalaire()));
            $salaireBrut = (int)$salaireInt * 1000;

            $total += ($salaireBrut + $ligne->primeSalaire() + $ligne->PrimeAnciennete()) ;
        }
        return $total;
    }
    
    public function ChequeVacance() {
        
        if ($this->calculAnciennete() > 1 ) {
            echo "Eligible";
        }
        else {
            echo "Non éligible";
        }
    }
    public static function EnfantEmploye($EnfantsEmploye, $nom) {
        $resultat = [];

        foreach ($EnfantsEmploye as $enfant) {

            if (strtolower($enfant->getNomParent()) == strtolower($nom)) {
                $resultat[] = $enfant;
            }
        }

        return $resultat;
    }


}
?>