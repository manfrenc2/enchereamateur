<?php

	require ('include/dbconfig.php'); // appel du fichier de connexion à la db
	$bdd = new Fscf();
	
	if (isset($_POST["valider"])) { //On vérifie que l'utilisateur a bien cliqué sur le bonton validé.
    //$pseudoi = $_POST["email"]; // On stock le mail entré par l'utilisateur dans la variable pseudoi.
    //$mdpi = $_POST["mdpi"]; //  On stock le mot de passe entré par l'utilisateur dans la variable mdpi.
		$name = strip_tags($_POST["nom"]); //je récupère la valeur de l'input nom
		$firstname = strip_tags($_POST["prenom"]); //je récupère la valeur de l'input prenom
		$mail = strip_tags($_POST["mail"]); //je récupère la valeur de l'input mail
		$phone = strip_tags($_POST["tel"]); //je récupère la valeur de l'input telephone
		$msg = strip_tags($_POST["msg"]); 
		$mailto = $bdd->contactmail($name,$firstname,$mail,$phone,$msg);
	}
?>
