<?php
//Connexion à la BDD
try{
    $db= new PDO('mysql:host=localhost;port=3308;dbname=site','root','');
    $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
    echo "Erreur de connexion".$e->getMessage();
}
//Session
session_start();

//Chemin
define("RACINE_SITE","/site/");

//Variables
$contenu="";
$option = "";

//autre inclusion
require_once('fonction.inc.php');


?>