<?php

require_once("ClassBanque.php");

class Compte {
    
    Private $nomcompte;
    private $numero;
    private $solde;
    private $transaction;
    private $debit;
    private $credit;
    private $banqueAffilier ;


    public function __construct($nomcompte, $numero, $solde, $transaction, $debit, $credit, Banque $banqueAffilier) {
        $this->nomcompte = $nomcompte ;
        $this->numero = $numero ;
        $this->solde = $solde ;
        $this->transaction = $transaction ;
        $this->debit = $debit ;
        $this->credit = $credit ;
        $this->banqueAffilier = $banqueAffilier ;
    }

    public function getNomCompte(){
        $this->nomcompte = $nomcompte ;
    }
    public function setNomCompte(){
        return $this->nomcompte ;
    }

    public function getNumero(){
        $this->numero = $numero ;
    }
    public function setNumero(){
        return $this->numero ;
    }

    public function getSolde(){
        $this->solde = $solde ;
    }
    public function setSolde(){
        return $this->solde ;
    }

    public function getTransaction(){
        $this->transaction = $transaction ;
    }
    public function setTransaction(){
        return $this->transaction ;
    }

    public function getDebit(){
        $this->debit = $debit ;
    }
    public function setDebit(){
        return $this->debit ;
    }

    public function getCredit(){
        $this->credit = $credit ;
    }
    public function setCredit(){
        return $this->credit ;
    }

    public function getBanqueAffilier(){
        $this->banqueAffilier = $banqueAffilier ;
    }
    public function setBanqueAffilier(Banque $banqueAffilier){
        return $this->banqueAffilier ;
    }

    public static function Transaction(){
        $this->solde = $solde ;
        $this->debit = $debit ;
        $this->credit = $credit ;
        while (true) {
            if ($solde > -2000 and $solde > $debit) {
                $this->solde = $solde - $debit ;
            }
            else if ($solde < -2000 and $solde < $debit) {
                echo "transaction refusé , solde insuffisant."
            }
            
        }
            
    }

}

?>