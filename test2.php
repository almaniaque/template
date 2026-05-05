<?php



//le calcule de l'age des candidat
function age2($birthdate) {
    $today = new DateTime();
    $dateofbirth = DateTime::createFromFormat("d/m/Y", $birthdate);

    if (!$dateofbirth) {
        return "Non renseigné";
    }

    $interval = $today->diff($dateofbirth);
    return $interval->format("%Y");
}

ini_set('auto_detect_line_endings', TRUE);
$handle = fopen('hrdata_3.csv', 'r');

fgetcsv($handle, 1000, ";");

$candidats = [];

while (($ligne = fgetcsv($handle, 1000, ";")) !== false) {

    if ($ligne[3] == "NULL" || $ligne[3] == "Non renseigné") {
        $ligne[3] = age2($ligne[4]);
    }

    $candidats[] = $ligne;
}

fclose($handle);



?>

        $ville = strtolower($ligne[8]);
        $age = strtolower($ligne[3]);
        $comptence = strtolower($ligne[13],$ligne[14],$ligne[15],$ligne[16],$ligne[17],$ligne[18],$ligne[19],$ligne[20],$ligne[21],$ligne[22],);
