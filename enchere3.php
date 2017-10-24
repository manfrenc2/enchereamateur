<?php 
    require('include/dbconfig.php');
	$bidid = $_GET["id"];
	$bdd = new Fscf();
	$bdd->bidcountdown($bidid);
?>