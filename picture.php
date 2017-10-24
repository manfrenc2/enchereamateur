<?php 
    require('include/dbconfig.php');
	$id = $_GET["id"];
	$bdd = new Fscf();
	$bdd->seepicture($id); 
?>