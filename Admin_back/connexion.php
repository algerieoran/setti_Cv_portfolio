<?php

// connexion à la BDD

$host='localhost';  // le chemin vers le serveur 
$database='setti_portfolio';  // le nom de la BDD
$user='root';  // le nom d'utilisateur pour se connecter
$psw='';  // mot de passe de l'utilisateur local (sur pc)

$pdoCV = new PDO('mysql:host='.$host.';dbname='.$database,$user,$psw);  // $pdoCV est le nom de la variable pour la connexion à la BDD qui nous sert partout où l'on doit se servir de cette connexion
$pdoCV->exec("SET NAMES utf8");

?>