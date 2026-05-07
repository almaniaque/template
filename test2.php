<?php



$date = readline("entree une date au format jj/mm/aaaa : ");

if (preg_match("/^(0[1-9]|[12][0-9]|3[01])\/(0[1-9]|1[0-2])\/\d{4}$/", $date)) {

    [$jour, $mois, $annee] = explode("/", $date);

    if (checkdate($mois, $jour, $annee)) {
        echo "Date valide";
    }
    else {
        echo "Date impossible";
    }

}
else {
    echo "Format invalide";
}


?>
