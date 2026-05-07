<?php
// affichage des candidat

function afficherDetailCandidat($ligne) {
    echo "----------------------- Candidat --------------------------" . PHP_EOL;
    echo "Nom : " . $ligne[1] . PHP_EOL;
    echo "Prénom : " . $ligne[2] . PHP_EOL;
    echo "Date de naissance : " . $ligne[4] . PHP_EOL;
    echo "Age : " . $ligne[3] . PHP_EOL;
    echo "Ville : " . $ligne[8] . PHP_EOL;
    echo "Tel : " . $ligne[9] . PHP_EOL;
    echo "Tel fix : " . $ligne[10] . PHP_EOL;
    echo "Email : " . $ligne[11] . PHP_EOL;
    echo "Profil recherché : " . $ligne[12] . PHP_EOL;
    echo "Compétences : " . implode(", ", array_slice($ligne, 13, 10)) . PHP_EOL;
    echo "------------------- Réseaux sociaux -----------------------" . PHP_EOL;
    echo "Site Web : " . $ligne[23] . PHP_EOL;
    echo "Linkedin : " . $ligne[24] . PHP_EOL;
    echo "Viadeo : " . $ligne[25] . PHP_EOL;
    echo "Facebook : " . $ligne[26] . PHP_EOL;
    echo "---------------------------------------------------------" . PHP_EOL;
}



$menu = [
    ["Afficher les candidats par Nom A-Z", "Afficher les candidats par Nom Z-A", "Afficher les candidats par Ville A-Z", "Afficher les candidats par Ville Z-A", "Afficher les candidats par Age croissant", "Afficher les candidats par Age décroissant", "Sélectionner un candidat pour voir les détails", "Retour"],
    "Ajout de candidat",
    "Modification des informations",
    "Recherche",
    "Quitter",
];

// tris des ids et remplacement dans les ids libres
function trouverIdLibre($candidats) {

    $ids = [];

    // récupération des IDs existants
    foreach ($candidats as $ligne) {
        $ids[] = intval($ligne[0]);
    }

    sort($ids);

    $idLibre = 1;

    foreach ($ids as $id) {

        if ($id == $idLibre) {
            $idLibre++;
        }
        else {
            break;
        }
    }

    return $idLibre;
}

// lecture des candidats

function viewCandidat() {
    ini_set('auto_detect_line_endings',TRUE);
    $handle = fopen('hrdata_3.csv','r');
    
    // ignore la premiere ligne

    fgetcsv($handle, 1000, ";");

    $candidats = [];

    while (($ligne = fgetcsv($handle, 1000, ";")) !== false) {

        foreach ($ligne as $index => $valeur) {
            if ($valeur == "NULL") {
                $ligne[$index] = "Non renseigné";
            }
        }
        
        $ligne[3] = age2($ligne[4]);
        

        $candidats[] = $ligne;
    }

    fclose($handle);

    return $candidats;
}

// listing et affichage de tout les candidats

function selectCandidat($candidats) {
    foreach ($candidats as $ligne) {
        echo $ligne[0] ." - " .$ligne[1] . " " .$ligne[2] .PHP_EOL ."Ville : " .$ligne[8] .PHP_EOL ."Profile recherché : " .$ligne[12] .PHP_EOL;
        echo "Age : " .$ligne[3] .PHP_EOL ;
    }
}

// trie des candidats

function trierCandidats($candidats, $colonne, $ordre = "ASC") {

    usort($candidats, function($a, $b) use ($colonne, $ordre) {

        $valA = strtolower($a[$colonne]);
        $valB = strtolower($b[$colonne]);

        // "non renseigné" toujours à la fin
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
    $trouve = false;
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
            afficherDetailCandidat($ligne);
            $trouve = true;
        }
    }

    if (!$trouve) {
        echo "Candidat introuvable." . PHP_EOL;
    }
}

// recherche de candidat par tri

function searchCDT($candidats, $search) {
    $trouve = false;
    $mots = explode(" ", strtolower(trim($search)));

    foreach ($candidats as $ligne) {
        $champs = [
            strtolower($ligne[1]),  // nom
            strtolower($ligne[2]),  // prénom
            strtolower($ligne[8]),  // ville
            strtolower($ligne[12]), // profil
            strtolower($ligne[3]),  // âge
        ];

        for ($i = 13; $i <= 22; $i++) {
            $champs[] = strtolower($ligne[$i]);
        }

        $match = true;

        foreach ($mots as $mot) {
            $motTrouve = false;

            foreach ($champs as $champ) {
                if (stripos($champ, $mot) !== false) {
                    $motTrouve = true;
                    break;
                }
            }

            if (!$motTrouve) {
                $match = false;
                break;
            }
        }

        if ($match) {
            afficherDetailCandidat($ligne);
            $trouve = true;
        }
    }

    if (!$trouve) {
        echo "Aucun résultat trouvé." . PHP_EOL;
    }
}

$candidats = viewCandidat();



// ajout de candidat 

function ajouter($candidats) {
    $ligne = [];
    $dernierId = 0;

    $ligne[0] = trouverIdLibre($candidats);;
    $ligne[1] = demander("Nom : ", "/^[a-zA-ZÀ-ÿ' -]{2,}$/", "Nom invalide.");
    $ligne[2] = demander("Prénom : ", "/^[a-zA-ZÀ-ÿ' -]{2,}$/", "Prénom invalide.");
    $ligne[3] = demander("Age : ", "/^[0-9]{1,3}$/", "Age invalide.");
    $ligne[4] = demander("Date de naissance jj/mm/aaaa : ", "/^(0[1-9]|[12][0-9]|3[01])\/(0[1-9]|1[0-2])\/(19[5-9][0-9]|2[0]{2}[0-8])$/", "Date invalide.");
    $ligne[5] = readline("Adresse : ");
    $ligne[6] = readline("Complément d'adresse : ");
    $ligne[7] = demander("Code postal : ", "/^[0-9]{5}$/", "Code postal invalide.");
    $ligne[8] = readline("Ville : ");
    $ligne[9] = demander("Téléphone portable : ", "/^0[1-9]([ .-]?[0-9]{2}){4}$/", "Téléphone invalide.");

    $ligne[10] = readline("Téléphone fixe ou Non renseigné : ");
    while ($ligne[10] != "Non renseigné" && !preg_match("/^0[1-9]([ .-]?[0-9]{2}){4}$/", $ligne[10])) {
        echo "Téléphone fixe invalide." . PHP_EOL;
        $ligne[10] = readline("Téléphone fixe ou Non renseigné : ");
    }

    $ligne[11] = demander("Email : ", "/^[^\s@]+@[^\s@]+\.[^\s@]+$/", "Email invalide.");
    $ligne[12] = readline("Profil souhaité : ");

    for ($i = 13; $i <= 22; $i++) {
        $ligne[$i] = readline("Compétence " . ($i - 12) . " : ");
    }

    $ligne[23] = readline("Site web : ");
    $ligne[24] = readline("LinkedIn : ");
    $ligne[25] = readline("Viadeo : ");
    $ligne[26] = readline("Facebook : ");



    if (checkValid($ligne)) {
        $fp = fopen('hrdata_3.csv', 'a');
        fputcsv($fp, $ligne, ";");
        fclose($fp);

        echo "Candidat ajouté." . PHP_EOL;
    } else {
        echo "Candidat non ajouté." . PHP_EOL;
    }

}

// sauvegarde des modification 

function sauvegarderCandidats($candidats) {
    $fp = fopen('hrdata_3.csv', 'w');

    fputcsv($fp, [
        "Id", "Nom", "Prénom", "Âge", "Date de naissance", "Adresse", "Adresse 1",
        "Code postal", "ville", "Numéro de téléphone portable", "Numéro de téléphone fixe",
        "Email", "Profil", "Compétence 1", "Compétence 2", "Compétence 3", "Compétence 4",
        "Compétence 5", "Compétence 6", "Compétence 7", "Compétence 8", "Compétence 9",
        "Compétence 10", "Site Web", "Profil Linkedin", "Profil Viadeo", "Profil facebook"
    ], ";");

    foreach ($candidats as $ligne) {
        fputcsv($fp, $ligne, ";");
    }

    fclose($fp);
}

// modification des information 

function Modification($candidats, $search) {

    $indexTrouve = null;

    foreach ($candidats as $index => $ligne) {
        if (
            strtolower($ligne[1]) == strtolower($search) ||
            strtolower($ligne[2]) == strtolower($search) ||
            strtolower($ligne[1] . " " . $ligne[2]) == strtolower($search)
        ) {
            $indexTrouve = $index;
            break;
        }
    }

    if ($indexTrouve === null) {
        echo "Candidat introuvable." . PHP_EOL;
        return $candidats;
    }

    while (true) {
        echo "------------------- Menu modification ----------------------" . PHP_EOL;
        echo "1 - Nom, Prenom" . PHP_EOL; 
        echo "2 - Date de naissance" . PHP_EOL;
        echo "3 - Adresse ou complément d'adresse" . PHP_EOL;
        echo "4 - Téléphone ou téléphone fixe" . PHP_EOL;
        echo "5 - Email" . PHP_EOL;
        echo "6 - Profil recherché" . PHP_EOL;
        echo "7 - Compétence" . PHP_EOL;
        echo "8 - Profil social" . PHP_EOL;
        echo "9 - Retour/sauvegarder modification" . PHP_EOL;

        $ModifSelect = readline("Choix de la modification : ");

        if ($ModifSelect == "1") {
            $candidats[$indexTrouve][1] = demander("Entrée le Nom (min 2 lettres) : ", "/^[a-zA-ZÀ-ÿ' -]{2,}$/", "Nom invalide.");
            $candidats[$indexTrouve][2] = demander("Entrée le Prénom (min 2 lettres) : ", "/^[a-zA-ZÀ-ÿ' -]{2,}$/", "Prénom invalide.");
        }

        else if ($ModifSelect == "2") {
            $candidats[$indexTrouve][4] = demander("Entrée la Date de naissance jj/mm/aaaa : ", "/^(0[1-9]|[12][0-9]|3[01])\/(0[1-9]|1[0-2])\/\(19[5-9][0-9]|2[0]{2}[0-8])$/", "Date invalide.");
            $candidats[$indexTrouve][3] = age2($candidats[$indexTrouve][4]);
        }

        else if ($ModifSelect == "3") {
            $candidats[$indexTrouve][5] = readline("Entrée l'Adresse : ");
            $candidats[$indexTrouve][6] = readline("Entrée le Complément d'adresse : ");
            $candidats[$indexTrouve][7] = demander("Entrée le Code postal : ", "/^[0-9]{5}$/", "Code postal invalide.");
            $candidats[$indexTrouve][8] = readline("Entrée la Ville : ");
        }

        else if ($ModifSelect == "4") {
            $candidats[$indexTrouve][9] = demander("Entrée le numero de Téléphone portable : ", "/^0[1-9]([ .-]?[0-9]{2}){4}$/", "Téléphone invalide.");

            $fixe = readline("Entrée le numero de Téléphone fixe ou Non renseigné : ");
            while ($fixe != "Non renseigné" && !preg_match("/^0[1-9]([ .-]?[0-9]{2}){4}$/", $fixe)) {
                echo "Téléphone fixe invalide." . PHP_EOL;
                $fixe = readline("Téléphone fixe ou Non renseigné : ");
            }

            $candidats[$indexTrouve][10] = $fixe;
        }

        else if ($ModifSelect == "5") {
            $candidats[$indexTrouve][11] = demander("Entrée l'Email : ", "/^[^\s@]+@[^\s@]+\.[^\s@]+$/", "Email invalide.");
        }

        else if ($ModifSelect == "6") {
            $candidats[$indexTrouve][12] = readline("Entrée le Profil souhaité : ");
        }

        else if ($ModifSelect == "7") {
            for ($i = 13; $i <= 22; $i++) {
                $candidats[$indexTrouve][$i] = readline("Entrée les Compétence ( 10 max )" . ($i - 12) . " : ");
            }
        }

        else if ($ModifSelect == "8") {
            $candidats[$indexTrouve][23] = readline("Entrée le Site web : ");
            $candidats[$indexTrouve][24] = readline("Entrée le profil LinkedIn : ");
            $candidats[$indexTrouve][25] = readline("Entrée le Viadeo : ");
            $candidats[$indexTrouve][26] = readline("Entrée le Facebook : ");
        }

        else if ($ModifSelect == "9") {
            sauvegarderCandidats($candidats);
            echo "Candidat modifié." . PHP_EOL;
            return $candidats;
        }

        else {
            echo "Choix invalide." . PHP_EOL;
        }
    }
}

//validateur de données conformes

function demander($message, $regex, $erreur) {
    while (true) {
        $valeur = readline($message);

        if (preg_match($regex, $valeur)) {
            return $valeur;
        }

        echo $erreur . PHP_EOL;
    }
}


function checkValid($ligne) {

    // Nom / prénom
    if (!preg_match("/^[a-zA-ZÀ-ÿ' -]{2,}$/", $ligne[1])) {
        echo "Nom invalide" . PHP_EOL;
        return false;
    }

    if (!preg_match("/^[a-zA-ZÀ-ÿ' -]{2,}$/", $ligne[2])) {
        echo "Prénom invalide" . PHP_EOL;
        return false;
    }

    // Age
    if (!preg_match("/^[0-9]{1,3}$/", $ligne[3])) {
        echo "Age invalide" . PHP_EOL;
        return false;
    }

    // Date
    if (!preg_match("/^(0[1-9]|[12][0-9]|3[01])\/(0[1-9]|1[0-2])\/\d{4}$/", $ligne[4])) {
        echo "Format de date invalide" . PHP_EOL;
        return false;
    }

    [$jour, $mois, $annee] = explode("/", $ligne[4]);

    if (!checkdate(intval($mois), intval($jour), intval($annee))) {
        echo "Date impossible" . PHP_EOL;
        return false;
    }

    // Code postal
    if (!preg_match("/^[0-9]{5}$/", $ligne[7])) {
        echo "Code postal invalide" . PHP_EOL;
        return false;
    }

    // Téléphone portable
    if (!preg_match("/^0[1-9]([ .-]?[0-9]{2}){4}$/", $ligne[9])) {
        echo "Téléphone portable invalide" . PHP_EOL;
        return false;
    }

    // Téléphone fixe
    if ($ligne[10] != "Non renseigné" && !preg_match("/^0[1-9]([ .-]?[0-9]{2}){4}$/", $ligne[10])) {
        echo "Téléphone fixe invalide" . PHP_EOL;
        return false;
    }

    // Email
    if (!filter_var($ligne[11], FILTER_VALIDATE_EMAIL)) {
        echo "Email invalide" . PHP_EOL;
        return false;
    }

    return true;
}


// navigation dans le menu

while (true) {
    
    echo "------------------- MENU PRINCIPAL -------------------" .PHP_EOL;
    echo "0 - Liste des candidats" .PHP_EOL;
    echo "1 - Ajout de candidat" .PHP_EOL;
    echo "2 - Modification des informations" .PHP_EOL;
    echo "3 - Recherche" .PHP_EOL;
    echo "4 - Quitter" .PHP_EOL;

    $MenuSelect = readline("Choix du menu : ");

    if ($MenuSelect == "0") {
        
        echo "------------------- SOUS-MENU CANDIDATS -------------------" .PHP_EOL;

        foreach ($menu[0] as $index => $item) {
            echo $index ." - " .$item .PHP_EOL;
        }

        $SousMenu = readline("menu souhaité : ");
        
        //sous menu afficher tout les candidat en fonction d'un tri

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
    //menu ajout de candidat
    else if ($MenuSelect == "1") {
        ajouter($candidats);
        $candidats = viewCandidat();
    }
    // menu modification
    else if ($MenuSelect == "2") {
        selectCandidat($candidats);

        $search = readline("Saisissez le nom du candidat à modifier ou retour pour annuler : ");

        if (strtolower($search) != "retour") {
            searchCDT($candidats, $search);
            $candidats = Modification($candidats, $search);
        }
    }
    // menu recherche
    else if ($MenuSelect == "3") {
        $search = readline("Saisissez un nom, une ville, un âge, une compétence ou <retour> : ");

        if (strtolower($search) != "retour") {
            searchCDT($candidats, $search);
        }
    }

    else {
        break ;
    }
}

?>

