<?php

require_once("ClassBanque.php");
require_once("ClassCompte.php");

require_once("Ref_Compte.php");
require_once("Ref_Banque.php");

class Client {
    
    private $ID ;
    private $nom ;
    private $prenom ;
    private $adresse ;
    private $CP ;
    private $ville ;
    private $ouverture ;
    private $comptes ;
    private $banque ;

    public function __construct($ID, $nom, $prenom, $adresse, $CP, $ville, $ouverture, Banque $banque, array $comptes = []) {
        
        $this->ID = $ID;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->adresse = $adresse;
        $this->CP = $CP;
        $this->ville = $ville;
        $this->ouverture = $ouverture;
        $this->banque = $banque;
        $this->comptes = $comptes;
    }
    
      
    public function getID(){ 
        return $this->ID; 
    }
    public function setID($ID){ 
        $this->ID = $ID; 
    }

    public function getNom(){ 
        return $this->nom; 
    }
    public function setNom($nom){ 
        $this->nom = $nom; 
    }

    public function getPrenom(){ 
        return $this->prenom; 
    }
    public function setPrenom($prenom){ 
        $this->prenom = $prenom; 
    }

    public function getAdresse(){ 
        return $this->adresse; 
    }
    public function setAdresse($adresse){ 
        $this->adresse = $adresse; 
    }

    public function getCP(){ 
        return $this->CP; 
    }
    public function setCP($CP){ 
        $this->CP = $CP; 
    }

    public function getVille(){ 
        return $this->ville; 
    }
    public function setVille($ville){ 
        $this->ville = $ville; 
    }

    public function getOuverture(){ 
        return $this->ouverture; 
    }
    public function setOuverture($ouverture){ 
        $this->ouverture = $ouverture; 
    }

    public function getComptes(){ 
        return $this->comptes; 
    }
    public function setComptes(array $comptes){ 
        $this->comptes = $comptes; 
    }

    public function getBanque(){ 
        return $this->banque; 
    }
    public function setBanque(Banque $banque){ 
        $this->banque = $banque; 
    }


    public static function Select($clients, $comptes) {

        echo "------ Liste des Comptes ------" . PHP_EOL;

        foreach ($comptes as $index => $compte) {
            echo $index . " - " . $compte->getNom() . PHP_EOL;
            echo "   - solde disponible " .$compte->getSolde() . PHP_EOL;
        }

    }
  
        // validateur de donner pour l'ajout de client
    public static function demander($message, $regex, $erreur) {
        while (true) {
            $valeur = readline($message);

            if (preg_match($regex, $valeur)) {
                return $valeur;
            }

            echo $erreur . PHP_EOL;
        }
    }

    // ajoute un nouveau client

    public static function ajouter($clients, $banques, $comptes) {
        
        $dernierId = 0;
        /*
            //pour csv

        $ligne = [];

        
        foreach ($clients as $client) {
            if (intval($client[0]) > $dernierId) {
             $dernierId = intval($client[0]);
            }
        }
            
        $ligne[0] = $dernierId + 1 ;
        $ligne[1] = demander("Nom : ", "/^[a-zA-ZÀ-ÿ' -]{2,}$/", "Nom invalide.");
        $ligne[2] = demander("Prénom : ", "/^[a-zA-ZÀ-ÿ' -]{2,}$/", "Prénom invalide.") ;
        $ligne[5] = readline("Adresse : ") ;
        $ligne[6] = readline("Complément d'adresse : ") ;
        $ligne[7] = demander("Code postal : ", "/^[0-9]{5}$/", "Code postal invalide.") ;
        $ligne[8] = readline("Ville : ") ;
        $clients[] = $ligne;

        return $clients;
        */

            //pour la POO

        foreach ($clients as $client) {
            if ($client->getID() > $dernierId) {
                $dernierId = $client->getID();
            }
        }
        $ID = $dernierId + 1;
        $nom = self::demander("Nom : ", "/^[a-zA-ZÀ-ÿ' -]{2,}$/", "Nom invalide.");
        $prenom = self::demander("Prénom : ", "/^[a-zA-ZÀ-ÿ' -]{2,}$/", "Prénom invalide.");
        $adresse = readline("Adresse : ");
        $cp = self::demander("Code postal : ", "/^[0-9]{5}$/", "Code postal invalide.");
        $ville = readline("Ville : ");
        $ouverture = date("d/m/Y");

            //affiche et recherche les banque du fichier Ref_Banque

        echo "------ Liste des banques ------" . PHP_EOL;

        foreach ($banques as $index => $banque) {
            echo $index . " - " . $banque->getNom() . PHP_EOL;
        }

        $choixBanque = readline("Choisissez une banque : ");

        while (!isset($banques[$choixBanque])) {
            echo "Banque invalide." . PHP_EOL;
            $choixBanque = readline("Choisissez une banque : ");
        }
        $banqueChoisie = $banques[$choixBanque];

        $nouveauClient = new Client(
            $ID,
            $nom,
            $prenom,
            $adresse,
            $cp,
            $ville,
            $ouverture,
            $banqueChoisie,
            [],
        );

        $choixCompte = readline("Voulez-vous créer un compte maintenant ? oui/non : ");

        if (strtolower($choixCompte) == "oui") {
            $comptes = Compte::CreeCompte($comptes, $nouveauClient, $banqueChoisie);
            $nouveauClient->setComptes(Client::CompteClient($comptes, $nouveauClient->getNom()));
        }

        $clients[] = $nouveauClient;

        echo "Client ajouté." . PHP_EOL;
        return [$clients, $comptes];

    }
        //permet de rechercher un client sur la Ref_client 
public static function Recherche($clients) {

    $choix = readline("Entrez un nom de client : ");

    foreach ($clients as $client) {

        if (strtolower($client->getNom()) == strtolower($choix)) {

            echo "-------------------- Client --------------------" . PHP_EOL;
            echo "Nom : " . $client->getNom() . PHP_EOL;
            echo "Prenom : " . $client->getPrenom() . PHP_EOL;
            echo "Adresse : " . $client->getAdresse() . PHP_EOL;
            echo "CP : " . $client->getCP() . PHP_EOL;
            echo "Ville : " . $client->getVille() . PHP_EOL;

            echo "----------------- Compte Affilié ----------------" . PHP_EOL;

            foreach ($client->getComptes() as $compte) {
                echo "Type de Compte : " . $compte->getType() . PHP_EOL;
                echo "Numero de compte : " . $compte->getNumero() . PHP_EOL;

                if ($compte->getSolde() < 0) {
                    echo "A decouvert" . PHP_EOL;
                }

                echo "Solde : " . $compte->getSolde() . " €" . PHP_EOL;
                echo "-------------------" . PHP_EOL;
            }

            echo "---------------- Banque Affilié ----------------" . PHP_EOL;

            $banque = $client->getBanque();

            echo "Banque Affilié : " . $banque->getNom() . PHP_EOL;
            echo "Adresse : " . $banque->getAdresse() . PHP_EOL;
            echo "CP : " . $banque->getCP() . PHP_EOL;
            echo "Ville : " . $banque->getVille() . PHP_EOL;

            echo "------------------------------------------------" . PHP_EOL;

            return $client;
        }
    }

    echo "Client introuvable" . PHP_EOL;
    return null;
}

    //recherche tout les compte associer au client
    public static function CompteClient($comptes, $nom) {
        $resultat = [];

        foreach ($comptes as $compte) {
            if (strtolower($compte->getNomCompte()) == strtolower($nom)) {
                $resultat[] = $compte;
            }
        }

        return $resultat;
    }


}
?>