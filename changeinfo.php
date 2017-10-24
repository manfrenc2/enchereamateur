<?php 
	require('include/header.php'); // on veut le header
	require_once'include/dbconfig.php'; // On appelle dbconfig
	$bdd = new Fscf(); // on fait une nouvelle instance de FSCF
	$retour = $bdd->profilUser($id);

	
	if(isset($_POST["valideinfo"])) { // On vérifie que le bouton uptade2 est pressé.
        $bdd->changeinfo($id); // si le bouton est pressé, la fonction update de la classe crud est utilisé.
    }
?>

<h1 class="titre">Modifier mes informations</h1>					
<div class="container">
	<!-- debut section avec le texte -->
	<section class="col-md-6 col-xs-12">
		<form method="post">
		
			<label>Nom</label>
			<input type="text" id="name" name="name" value="<?php echo $retour["name"]; ?>"></input></br>
			<label>Prénom</label>
			<input type="text" id="firstname" name="firstname" value="<?php echo $retour["firstname"]; ?>"></input></br>
			<label>Adresse</label>
			<input type="text" id="adress" name="adress" value="<?php echo $retour["adress"]; ?>"></input></br>
			<label>Code postal</label>
			<input type="text" id="zipcode" name="zipcode" value="<?php echo $retour["zipcode"]; ?>"></input></br>
			<label>Ville</label>
			<input type="text" id="city" name="city" value="<?php echo $retour["city"]; ?>"></input></br>
			<label>Téléphone</label>
			<input type="tel" id="phone" name="phone" value="<?php echo $retour["phone"]; ?>"></input></br>
			
			
			
			<input type="submit" name="valideinfo" class="btn btn-warning"/>
		
		</form>
	</section>

</div>


<?php require('include/footer.php')  ?>