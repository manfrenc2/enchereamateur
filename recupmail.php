<!-- barre de header principale avec logo, inscription et connexion -->
<?php 
	require('include/header.php');
	$title="recupmail";
	if (isset($_GET["message"])) {
		echo '<script> alert("'.$_GET["message"].'");</script>';
    }
	
?>

	<!-- debut section de récupération du mot de passe avec l'email -->
	<section>
		<h1 class="titrerecup">Mot <br>de<br> passe<br> oublié ?</h1>
		<form method="post" action="include/dbrecupmail.php">					
			<div>
				<h3 class="titreemail">Pour récupérer votre mot de passe, merci de nous indiquer votre adresse email</h3>
			</div>
			<div>
				<input class="inputmail form-control" type="email" name="mailrecup" required>
			</div>
			<div> 	
				<a href="#"><button name="submit" class="btn btn-danger">Envoyer</button></a>
			</div>
		</form>
	</section>
	<!-- fin section avec les dates et boutons -->

</div>	

<?php require ('include/footer.php'); ?>