<?php

$menu = [
    ["Afficher les candidats par Nom A-Z", "Afficher les candidats par Nom Z-A", "Afficher les candidats par Ville A-Z", "Afficher les candidats par Ville Z-A", "Afficher les candidats par Age croissant", "Afficher les candidats par Age décroissant", "Sélectionner un candidat pour voir les détails", "Retour"],
    "Ajout de candidat",
    "Modification des informations",
    "Recherche",
    "Quitter",
];

// lecture des candidats

function viewCandidat() {
    ini_set('auto_detect_line_endings',TRUE);
    $handle = fopen('hrdata_3.csv','r');

    fgetcsv($handle, 1000, ";");

    $candidats = [];

    while (($ligne = fgetcsv($handle, 1000, ";")) !== false) {

        foreach ($ligne as $index => $valeur) {
            if ($valeur == "NULL") {
                $ligne[$index] = "Non renseigné";
            }
        }
        if ($ligne[3] == "NULL" || $ligne[3] == "Non renseigné") {
            $ligne[3] = age2($ligne[4]);
        }

        $candidats[] = $ligne;
    }

    fclose($handle);

    return $candidats;
}


// listing des candidats

function selectCandidat($candidats) {
    foreach ($candidats as $ligne) {
        echo $ligne[0] ." - " .$ligne[1] . " " .$ligne[2] .PHP_EOL ."Ville : " .$ligne[8] .PHP_EOL ."Profile recherché : " .$ligne[12] .PHP_EOL;
        echo "Age : " .$ligne[3] .PHP_EOL ;
    }
}

// le trie des candidats

function trierCandidats($candidats, $colonne, $ordre = "ASC") {

    usort($candidats, function($a, $b) use ($colonne, $ordre) {

        $valA = strtolower($a[$colonne]);
        $valB = strtolower($b[$colonne]);

        // 🔥 priorité : "non renseigné" toujours à la fin
        if ($valA == "non renseigné") return 1;
        if ($valB == "non renseigné") return -1;

        // cas spécial âge
        if ($colonne == 3) {
            $valA = intval($a[$colonne]);
            $valB = intval($b[$colonne]);
        }

        if ($valA == $valB) return 0;

        if ($ordre == "ASC") {
            return ($valA < $valB) ? -1 : 1;
        } else {
            return ($valA > $valB) ? -1 : 1;
        }
    });

    return $candidats;
}

//le calcule de l'age des candidat et le rempalssement dans le tableau

function age2($birthdate) {
    $today = new DateTime();
    $dateofbirth = DateTime::createFromFormat("d/m/Y", $birthdate);

    if (!$dateofbirth) {
        return "Non renseigné";
    }

    $interval = $today->diff($dateofbirth);
    return $interval->format("%Y");

}

// affichage des candidat individuellemnt
function selectedCDT($candidats, $selectCDT) {
    $mots = explode(" ", strtolower(trim($selectCDT)));

    foreach ($candidats as $ligne) {

        $nom = strtolower($ligne[1]);
        $prenom = strtolower($ligne[2]);

        $match = true;

        foreach ($mots as $mot) {
            if (
                stripos($nom, $mot) === false &&
                stripos($prenom, $mot) === false
            ) {
                $match = false;
                break;
            }
        }
    
        if ($match) {
            echo "-----------------------Candidat--------------------------" .PHP_EOL ;
            echo "Nom : " . $ligne[1] . PHP_EOL;
            echo "Prénom : " . $ligne[2] . PHP_EOL;
            echo "Date de naissance : " . $ligne[4] . PHP_EOL;
            echo "Age : " . $ligne[3] . PHP_EOL;
            echo "Ville : " . $ligne[8] . PHP_EOL;
            echo "Tel : " . $ligne[9] . PHP_EOL;
            echo "Email : " . $ligne[11] . PHP_EOL;
            echo "Profil recherché : " . $ligne[12] . PHP_EOL;
            echo "compétence : " .$ligne[13] .", " .$ligne[14] .", " .$ligne[15] .", " .$ligne[16] .", " .$ligne[17] .", " .$ligne[18] .", " .$ligne[19] .", " .$ligne[20] .", " .$ligne[21] .", " .$ligne[22] .PHP_EOL;
            echo "---------------------------------------------------------" .PHP_EOL ;
            echo "Profile Reseau Sociaux : " .PHP_EOL ."Site Web : " .$ligne[23] .PHP_EOL ."Linkedin : "  .$ligne[24] .PHP_EOL ."Viadeo : " .$ligne[25] .PHP_EOL ."Facebook : " .$ligne[26] .PHP_EOL;
            echo "---------------------------------------------------------" .PHP_EOL ;

            $trouve = true;
        }
    }

    if (!$trouve) {
        echo "Candidat introuvable." . PHP_EOL;
    }
}

$candidats = viewCandidat();

// ajout de candidat 

function ajouter($candidats) {
    $ligne = [];

    $ligne[0] = count($candidats) + 2;
    $ligne[1] = readline("Nom : ");
    $ligne[2] = readline("Prénom : ");
    $ligne[3] = readline("Age : ");
    $ligne[4] = readline("Date de naissance : ");
    $ligne[5] = readline("Adresse : ");
    $ligne[6] = readline("Complément d'adresse : ");
    $ligne[7] = readline("Code postal : ");
    $ligne[8] = readline("Ville : ");
    $ligne[9] = readline("Téléphone portable : ");
    $ligne[10] = readline("Téléphone fixe : ");
    $ligne[11] = readline("Email : ");
    $ligne[12] = readline("Profil souhaité : ");

    for ($i = 13; $i <= 22; $i++) {
        $ligne[$i] = readline("Compétence " . ($i - 12) . " : ");
    }

    $ligne[23] = readline("Site web : ");
    $ligne[24] = readline("LinkedIn : ");
    $ligne[25] = readline("Viadeo : ");
    $ligne[26] = readline("Facebook : ");

    $fp = fopen('hrdata_3.csv', 'a');

    fputcsv($fp, $ligne, ";");

    fclose($fp);

    echo "Candidat ajouté." . PHP_EOL;
}

// modification des information 

function Modification($candidats, $selectCDT) {
    ;
}

// navigation dans le menu

while (true) {
    echo "=== MENU PRINCIPAL ===" .PHP_EOL;
    echo "0 - Liste des candidats" .PHP_EOL;
    echo "1 - Ajout de candidat" .PHP_EOL;
    echo "2 - Modification des informations" .PHP_EOL;
    echo "3 - Recherche" .PHP_EOL;
    echo "4 - Quitter" .PHP_EOL;

    $MenuSelect = readline("Choix : ");

    if ($MenuSelect == "0") {
        
        echo "=== SOUS-MENU CANDIDATS ===" .PHP_EOL;

        foreach ($menu[0] as $index => $item) {
            echo $index ." - " .$item .PHP_EOL;
        }

        $SousMenu = readline("Sous-choix : ");
        
        //sous menu afficher tout les candidat

        if ($SousMenu == "0") {
            selectCandidat(trierCandidats($candidats, 1, "ASC"));
            $selectCDT = readline("Entrez le nom du candidat souhaité pour voir ses details : ");
            selectedCDT($candidats, $selectCDT);
        }
        else if ($SousMenu == "1") {
            selectCandidat(trierCandidats($candidats, 1, "DESC"));
            $selectCDT = readline("Entrez le nom du candidat souhaité pour voir ses details : ");
            selectedCDT($candidats, $selectCDT);
        }
        else if ($SousMenu == "2") {
            selectCandidat(trierCandidats($candidats, 8, "ASC"));
            $selectCDT = readline("Entrez le nom du candidat souhaité pour voir ses details : ");
            selectedCDT($candidats, $selectCDT);
        }
        else if ($SousMenu == "3") {
            selectCandidat(trierCandidats($candidats, 8, "DESC"));
            $selectCDT = readline("Entrez le nom du candidat souhaité pour voir ses details : ");
            selectedCDT($candidats, $selectCDT);
        }
        else if ($SousMenu == "4") {
            
            selectCandidat(trierCandidats($candidats, 3, "ASC"));
            $selectCDT = readline("Entrez le nom du candidat souhaité pour voir ses details : ");
            selectedCDT($candidats, $selectCDT);
        }
        else if ($SousMenu == "5") {
            selectCandidat(trierCandidats($candidats, 3, "DESC"));
            $selectCDT = readline("Entrez le nom du candidat souhaité pour voir ses details : ");
            selectedCDT($candidats, $selectCDT);
        }

        //sous menu selection du candidat

        else if ($SousMenu == "6") {
            $selectCDT = readline("Entrez le nom du candidat souhaité : ");
            selectedCDT($candidats, $selectCDT);
        }
        // fin du sous menu
        
    } 

    else if ($MenuSelect == "1") {
        ajouter($candidats);
        $candidats = viewCandidat();
    }

    else if ($MenuSelect == "2") {
        Modification($candidats, $selectCDT);

    }

    else if ($MenuSelect == "3") {
        $search = readline("saisisez : un nom, une ville , un age , ou une competence sinon taper < retour > pour revenir au menu pricipale : ");
        
        
        if ($search != "retour") {
           
        }

    }

    else {
        break ;
    }
}




?>

