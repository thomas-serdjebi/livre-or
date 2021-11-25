<?php

//Déclaration des variables de connexion
 
$BDD = array();
$BDD ['host'] = "localhost" ;
$BDD ['user'] = "root" ;
$BDD ['pass'] = "" ;
$BDD ['db'] = "thomas-serdjebi_livreor" ;
$table = "utilisateurs";

$mysqli = mysqli_connect ( $BDD ['host'], $BDD ['user'], $BDD ['pass'], $BDD ['db'] ) ;

if (!$mysqli) {
    echo "La connexion à la base de données a échouée";
    $err_connexion = "La connexion à la base de données '".$BDD['db']."' a échoué ";
}


elseif ($mysqli) {

    echo "La connexion a réussi";
}

?>