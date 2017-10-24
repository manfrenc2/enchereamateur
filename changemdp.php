<?php 
	require('include/header.php'); // on veut le header
	require_once'include/dbconfig.php'; // On appelle dbconfig
	$bdd = new Fscf(); // on fait une nouvelle instance de FSCF

	
	if(isset($_POST["validemdp"])) { // On vérifie que le bouton uptade2 est pressé.
        $bdd->recupInsertMdp($id); // si le bouton est pressé, la fonction update de la classe crud est utilisé.
    }
?>

<h1 class="titre">Changer mot de passe</h1>					
<div class="container">
	<!-- debut section avec le texte -->
	<section class="col-md-6 col-xs-12">
		<form method="post" onsubmit="return comparaison()">
		
			<label>Entrer votre ancien mot de passe</label>
			<input type="password" name="oldmdp" required/></input>
			<label>Entrer votre nouveau mot de passe</label>
			<input type="password" id="newmdp" name="newmdp" required/></input>
			<label>Confirmer le nouveau mot de passe</label>
			<input type="password" id="newmdp2" name="newmdp2" required/></input></br>
			<input type="submit" name="validemdp" class="btn btn-warning"/>
		
		</form>
	</section>

</div>
<script src="js/scriptmdp.js" type="text/javascript"></script>

<?php require('include/footer.php')  ?>