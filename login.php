<?php
require_once'include/dbconfig.php';


if (isset($_POST["login"])&& !empty($_POST["login"])) { //Si le champs login a été renseigné par l'utilisateur, exécuter la suite :
	$bdd = new Fscf();
	$retour = $bdd->connect($_POST["login"], $_POST["password"]);
	header($retour);
}
else{
	require "erreur_401.php";
}