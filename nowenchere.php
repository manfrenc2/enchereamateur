<?php

    require('include/header.php');
    require("include/dbconfig.php"); // lien d'un fichier php contenant la classe, require = obligatoire, include = facultatif
    $bdd = new fscf();
	$title="Mes enchères en cours";

        if(isset($_POST["action"]) && $_POST["action"] == "delnowbid") { // On vérifie que le bouton delete est pressé.
           $bdd->delnowbid(); // si le bouton est pressé, la fonction delete de la classe crud est utilisé.
        }
        
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Mes enchères en cours</title>
        <!-- CSS
          ================================================== -->
        <link href="../css/bootstrap.css" rel="stylesheet" type="text/css">
        <link href="../css/bootstrap-theme.css" rel="stylesheet" type="text/css">
        
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.css">
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.3.1/css/buttons.dataTables.min.css">
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.2.2/css/select.dataTables.min.css">
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		<script src="js/scriptnowenchere.js"></script>
		<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script>
		<script src="https://cdn.datatables.net/select/1.2.2/js/dataTables.select.min.js"></script>
	
		


    </head>
    <body>
        <p><b><u> TABLE ENCHERE </u></b></p>
        
        <table id="nowbid" class="display" width="100%" cellspacing="0">
            <thead>
                <tr>
						<th>Id</br></th>
						<th>Date du début</br></th>
						<th>Date de fin prévue</br></th>
						<th>Prix de départ</br></th>
						<th>Article concerné</br></th>
						<th>Prix de clôture</br></th>
						<th></th>
                </tr>
            </thead>
            <tbody class="scrollContent">
                <?php $bdd->nowbid($id); ?>  <!-- Appel fonction Lire2 dans la class php crud -->             
            </tbody>
        </table>
		

<?php require('include/footer.php')  ?>