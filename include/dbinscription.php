<?php

	require 'dbconfig.php'; // appel du fichier de connexion à la db
	$bdd = new Fscf();

// var_dump($_POST);
if (isset($_POST["submit"]) && $_POST["termUse"] == true) { //On vérifie que l'utilisateur a bien cliqué sur le bonton validé.
    //$pseudoi = $_POST["email"]; // On stock le mail entré par l'utilisateur dans la variable pseudoi.
    //$mdpi = $_POST["mdpi"]; //  On stock le mot de passe entré par l'utilisateur dans la variable mdpi.
  	$name = strip_tags($_POST["lastname"]); //je récupère la valeur de l'input nom
  	$firstname = strip_tags($_POST["firstname"]); //je récupère la valeur de l'input prenom
  	$mail = strip_tags($_POST["email"]); //je récupère la valeur de l'input mail
  	$adress = strip_tags($_POST["adress"]); //je récupère la valeur de l'input adresse
  	$zipcode = strip_tags($_POST["zipCode"]); //je récupère la valeur de l'input code postal
  	$city = strip_tags($_POST["ville"]); //je récupère la valeur de l'input ville
  	$phone = strip_tags($_POST["phone"]); //je récupère la valeur de l'input telephone
    $mdp = strip_tags($_POST["mdp"]); 
	  $retour = $bdd->insertUser($name,$firstname,$adress,$zipcode,$city,$phone,$mail, $mdp);
    header ($retour['return'].'?message='.$retour['message']); //Résultat de la fonction insertuser : si tout ok -> index.php, sinon on reste sur inscription.php (voir fonction insertuser dans dbconfig.php)
        
}
?>