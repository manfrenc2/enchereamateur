<!-- barre de header principale avec logo, inscription et connexion -->
<?php 
	require('include/header.php'); // on veut le header
	require_once'include/dbconfig.php'; // On appelle dbconfig
	$bdd = new Fscf(); // on fait une nouvelle instance de FSCF
	$retour = $bdd->profilUser($id); // on va chercher la fonction profiluser dans dbconfig
?>
<div class="col-md-12">
	<div class="row">
	<nav class="navbar-light bg-faded adjust"><!-- barre de navigation -->
		<a href="profil.php"><div class="barnav2 nav-item col-md-1 col-xs-1">Profil</div></a>
		<a href="winenchere.php"><div class="barnav2 nav-item col-md-2 col-xs-2">Enchères gagnées</div></a>
		<a href="addarticle.php"><div class="barnav2 nav-item col-md-2 col-xs-2">Ajouter un article</div></a>
		<a href="addenchere.php"><div class="barnav2 nav-item col-md-2 col-xs-2">Ajouter une enchère</div></a>
		<a href="myarticle.php"><div class="barnav2 nav-item col-md-1 col-xs-1">Mes articles</div></a>
		<a href="nowenchere.php"><div class="barnav2 nav-item col-md-2 col-xs-2">Mes enchères en cours</div></a>
		<a href="pastenchere.php"><div class="barnav2 nav-item col-md-2 col-xs-2">Historique de mes ventes</div></a>
	</nav> 
	
	<h1 class="titre">Profil</h1>					
		
		<!-- debut section avec le texte -->
		<section class="col-md-6 col-xs-12 row">
			<!--<div class="tabs-onglets">
				<a href="profil.php">Profil</a>
				<a href="winenchere.php">Enchères gagnées</a>
				<a href="addarticle.php">Ajouter un article</a>
				<a href="addenchere.php">Ajouter une enchère</a>
				<a href="myarticle.php">Mes articles</a>
				<a href="nowenchere.php">Mes enchères en cours</a>
				<a href="pastenchere.php">Historique de mes ventes</a>
			</div>-->
			<div class="listInfo">
				
					<p>Identifiant :<h4><?php echo $retour["name"]." ".$retour["firstname"]; ?></h4></p> <!-- on va chercher le nom et prénom dans la bdd -->
					<br/>
					
					<p>Adresse : <h4 class="text"><?php echo $retour["adress"]; ?></h4></p>  <!-- on va chercher l'adresse dans la bdd -->
					<br/>
					
					<p>Code postal : <h4 class="text"><?php echo $retour["zipcode"]; ?></h4></p>  <!-- on va chercher l'adresse dans la bdd -->
					<br/>
					
					<p>Ville : <h4 class="text"><?php echo $retour["city"]; ?></h4></p>  <!-- on va chercher l'adresse dans la bdd -->
					<br/>
					
					<p>Email : <h4 name='emailProfil'><?php echo $retour["mail"]; ?></h4></p>  <!-- on va chercher l'email dans la bdd -->
					<br/>
					
					<p>Téléphone : <h4 class="text1"><?php echo $retour["phone"]; ?></h4></p>  <!-- on va chercher le numero de téléphone dans la bdd -->
					
					<br/>
					<a href="changeinfo.php"> Modifier mes informations </a>
					<a href="changemdp.php"> Changer mot de passe </a>
				
			</div>
		</section>

	</div>
</div>

<?php require('include/footer.php')  ?>