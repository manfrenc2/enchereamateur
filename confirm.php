<?php 
	require('include/header.php'); // on veut le header
	require_once'include/dbconfig.php'; // On appelle dbconfig
	$bdd = new Fscf(); // on fait une nouvelle instance de FSCF
	
	if (isset($_GET["m"]) && isset($_GET["j"])) {
		$token = $_GET["m"];
		$timestamp = $_GET["j"];
		$bdd->veriftoken2($token,$timestamp);	
    }
	

    if (isset($_GET["message"])) {
        echo '<script> alert("'.$_GET["message"].'");</script>';
    }
?>
