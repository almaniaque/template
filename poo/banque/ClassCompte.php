<?php

require_once("ClassBanque.php");
require_once("ClassClient.php");



class Compte {
    
    Private $nomcompte;
    private $type;
    private $numero;
    private $solde;
    private $transaction;
    private $debit;
    private $credit;
    private $decouverttMax;
    private $banqueAffilier ;


    public function __construct($nomcompte, $type, $numero, $solde, $transaction, $debit, $credit, $decouvertMax, Banque $banqueAffilier) {
        $this->nomcompte = $nomcompte ;
        $this->type = $type ;
        $this->numero = $numero ;
        $this->solde = $solde ;
        $this->transaction = $transaction ;
        $this->debit = $debit ;
        $this->credit = $credit ;
        $this->decouvertMax = $decouvertMax ;
        $this->banqueAffilier = $banqueAffilier ;
    }

    public function getNomCompte(){
        return $this->nomcompte ;    
    
    }
    public function setNomCompte(){
        $this->nomcompte = $nomcompte ;    
    }

    public function getType(){
        return $this->type ;    
    
    }
    public function setType(){
        $this->type = $type ;    
    }
    public function getNumero(){
        return $this->numero ;    
    
    }
    public function setNumero(){
        $this->numero = $numero ;    
    }

    public function getSolde(){
        return $this->solde ;    
    
    }

    public function setSolde(){
        $this->solde = $solde ;    
    }

    public function getTransaction(){
        return $this->transaction ;    
    
    }

    public function setTransaction(){
        $this->transaction = $transaction ;    
    }

    public function getDebit(){
        return $this->debit ;    
    
    }

    public function setDebit(){
        $this->debit = $debit ;    
    }

    public function getCredit(){
        return $this->credit ;    
    
    }

    public function setCredit(){
        $this->decouvertMax = $decouvertMax ;    
    }

    public function getDecouvertMax(){
        return $this->decouvertMax ;    
    
    }

    public function setDecouvertMax(){
        $this->decouvertMax = $decouvertMax ;    
    }

    public function getBanqueAffilier(){
        return $this->banqueAffilier ;    
    
    }

    public function setBanqueAffilier(Banque $banqueAffilier){
        $this->banqueAffilier = $banqueAffilier ;    
    }

        // debite le montant si possible
    public static function Debit(){
        $this->solde = $solde ;
        $this->debit = $debit ;
        $debit = intval(readline("veuillez saisir le montant que vous souhaitez : "));
        while (true) {
            if ($solde > $decouvertMax and $solde > $debit) {
                $this->solde = $solde - $debit ;
            }
            else if ($solde < $decouvertMax and $solde < $debit) {
                echo "transaction refusé , solde insuffisant.";
            }
        }      
    }
        //fonction de virement d'un compte a un autre
    public static function Virement($comptes, $clientChoisi) {
        $choix = redline("veuillez choisir le client :");

    }
        //fonction de type de compte pour la création 

    public static function TypeCompte($message , $type, $erreur) {
        $type = readline("Type de compte (Livret A ou Courant) : ");

        while ($type != "Livret A" && $type != "Courant") {
            echo "Type invalide." . PHP_EOL;
            $type = readline("Type de compte (Livret A ou Courant) : ");
        }
        return $type;
    }
        //fonction de creation de compte avec selection de type de compte

    public static function CreeCompte($comptes, Client $client, Banque $banqueAffilier) {
        $dernierId = 0;

        // sur POO 
        foreach ($comptes as $compte) {
            if ($compte->getNumero() > $dernierId) {
                $dernierId = $compte->getNumero();
            }
        }
        $nomcompte = $client->getNom();
        $type = self::TypeCompte("type de compte (Livret A ou Courant :" , "/^[Livret A]|[Courant]$/" , "Erreur de type de compte veuillez eseiller a nouveau : " ) ;
        $numero = $dernierId +1 ;
        $solde = intval(readline("veuillez faire un depôt de 50€ minimum : "));

        while ($solde < 50) {
        echo "Dépôt minimum obligatoire : 50€" . PHP_EOL;
        $solde = intval(readline("Veuillez faire un dépôt de 50€ minimum : "));
        }

        $transaction = 0 ;
        $debit = 0;
        $credit = 0;
        $decouvertMax = intval(readline("veuillez saisir le decouvert maximum autorisé ( max -2000 ) : "));
        
        while ($decouvertMax < -1000 || $decouvertMax > 0) {
            echo "Découvert invalide." . PHP_EOL;
            $decouvertMax = intval(readline("Veuillez saisir le decouvert maximum autorisé (entre -2000 et 0) : "));
        }

        $nouveauCompte= new Compte (
            $nomcompte ,
            $type ,
            $numero ,
            $solde ,
            $transaction ,
            $debit ,
            $credit ,
            $decouvertMax ,
            $banqueAffilier ,
            
        );

        $comptes[] = $nouveauCompte;
        echo "compte crée " .PHP_EOL;
        return $comptes;
    }
    
    

}

?>