<?php
	require 'dbconfig.php';
  	$bdd = new Fscf();
  
 	if (isset($_POST["submit"])) { //On vérifie que l'utilisateur a bien cliqué sur le bonton validé.
		$recup = $_POST['mailrecup'];
	 
	 	// echo $recup;die();
		$retour = $bdd->newtoken($recup);
    	header ($retour['return'].'?message='.$retour['message']);
    }
    else {
    	header ($retour['return'].'?message='.$retour['message']);
    }
