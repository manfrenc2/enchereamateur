<?php
	session_start();
	if(isset($_SESSION["id"])){
		if($_SESSION['ip'] != $_SERVER['REMOTE_ADDR']){
			header("location: include/deconnexion.php");
		}else{
			$id = $_SESSION["mail"];
			$admin= $_SESSION["admin"];
		}
	}

?>

<!doctype HTML>

<html lang="fr">
	<head>
		<meta charset="utf-8">
		<!-- comportement que le navigateur doit adopter concernant l'affiche du site (par rapport à l'écran)-->
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<!-- rendre compatible la mise en forme sur edge et chrome -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
		<meta http-equiv="X-UA-Compatible" content="chrome=1"/>
		<title> Artamateur </title><!-- optimisation pour le SEO -->
		<meta name="description" content="Exposition et enchère d'art"/>
		<!-- Shortcut du logo du site -->
		<!--<link rel="icon" type="image/png" href="img/shortcut_img.png"/> -->
		<link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet"> 
		<!-- import du fichier Bootstrap -->
		<link rel="stylesheet" type="text/css" href="./css/styleheader.css">
		<link href="./css/stylefooter.css" type="text/css" rel="stylesheet"/>

		<!-- import de JQUERY via google -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<!-- import du JS de bootsrap -->
		<script src="js/bootstrap.min.js"></script>

		<?php
		// echo $_SERVER['REQUEST_URI'];
		// die();
		/*if($_SERVER['SERVER_NAME'] == "fscfyonne.odns.fr")
			$url = "/siteweb";
		else
			$url = "/projet";*/
		
		// var_dump($_SERVER);die();
		$url= "/enchereamateur";
		
		switch($_SERVER['REQUEST_URI']):
		
			case $url."/inscription.php":
				echo '<link href="css/styleinscription.css" rel="stylesheet"/>';
				break;
			/*case $url."/profil.php":
				echo '<link href="css/styleprofil.css" rel="stylesheet"/>';
				break;*/
			case $url."/index.php":
				echo '<link href="css/styleindex.css" rel="stylesheet"/>';
				break;

			case $url."/contact.php":
				echo '<link href="css/stylecontact.css" rel="stylesheet"/>';
				break;

			case $url."/addenchere.php":
				echo '<link href="css/styleaddenchere.css" rel="stylesheet"/>';
				break;

			case $url."/profil.php":
				echo '<link href="css/styleprofil.css" rel="stylesheet"/>';
				break;	
				
			case $url."/toutvoir.php":
				echo '<link href="css/styletoutvoir.css" rel="stylesheet"/>';
				break;
				
			case $url."/enchere.php":
				echo '<link href="css/styleenchere.css" rel="stylesheet"/>';
				break;
			/*case $url."/recupmail.php":
				echo '<link href="css/stylerecup.css" rel="stylesheet"/>';
				break;*/
			default:
				echo '<link href="css/styleindex.css" rel="stylesheet"/>';
				
		endswitch;			
		?>


	</head>
	<body>
		<div class="container">
			<header>
				<div class="imgback"><!-- Entête des pages -->
					<div class="col-md-3 col-xs-3"><!-- logo FSCF cliquable -->
<!--						<a href="index.php">
							<img class="logo" src="img/FSCF-YonneRVB.png" alt="FSCF retour à l'accueil">
						</a>-->
					</div>
					<div class="col-md-5 col-xs-9 central"><!-- lien d'inscription -->
<!-- 						<div class="inscription ins">
							<a href="inscription.php"><i class="fa fa-book fa-2x" aria-hidden="true"></i><span>&nbsp Je m'inscris au BAFA/BAFD</span></a>
						</div> -->				
					</div>
					<?php
						if(isset($id) && $admin==0):
							echo '<div class="col-md-4 col-xs-12 whenconnected">
									<div class="form-group"> 
										
											<div class="profilbutton"><a href="include/deconnexion.php" class="connect2" style="color:black"><span style="color:#e5007e">&#10008;</span> Déconnexion</a></div>
											
											<p class="connect2"> Connecté en tant que:<b>'.' '.$id.'</b></p>

									</div>
								</div>';
						elseif(isset($id) && $admin==1):
							echo '<div class="col-md-4 col-xs-12 whenconnected">
									<div class="form-group"> 
										
											<div class="profilbutton"><a href="include/deconnexion.php" class="connect2" style="color:black"><span style="color:#e5007e">&#10008;</span> Déconnexion</a></div>
											
											<div class="profilbutton"><a href="./crud/crud.php" class="connect2" style="color:black">Administration</a></div>
											<p class="connect2"> Connecté en tant que:<b>'.' '.$id.'</b></p>

									</div>	
								</div>';
						else : ?>
					<div class="col-md-4 col-xs-12 connect"><!-- formulaire de connexion -->
						<form class="connect" method="post" action="login.php">
							<div class="form-group"> 
								<div class="form-group">
									<label for="connexion" class="connexion connect">Connexion</label>
									<input class="form-control auto" type="text" name="login" placeholder="Login"/>
									</br>
									<input class="form-control auto" type="password" name="password" placeholder="Mot de passe"/>
									</br>
									<div class="center"><button type="submit" class="buttonlogin">se connecter</button></div> 
									<div class="passforget"><a class="linkmdp" href="recupmail.php">mot de passe oublié ?</a></div>
								</div>
							</div>
						</form>
					</div>
					<?php endif; ?>
				</div>
				<nav class="navbar-light bg-faded adjust"><!-- barre de navigation -->
					<div id="topnav">
						<a href="index.php"><div class="barnav nav-item col-md-2 col-xs-2">Accueil</div></a>
						<a href="toutvoir.php"><div class="barnav nav-item col-md-2 col-xs-2">Tout voir</div></a>
						<?php 
							if (!isset($id)){
								echo '<a href="inscription.php"><div class="barnav col-md-2 col-xs-1">Inscription</div></a>';
							}else{
								echo '<a href="profil.php"><div class="barnav col-md-2 col-xs-1">Mon compte</div></a>';
							}
						?>
						<a href="contact.php"><div class="barnav col-md-2 col-xs-2">Nous contacter</div></a>
						<a href="faq.php"><div class="barnav col-md-2 col-xs-2">FAQ</div></a>
						<a href="qcn.php"><div class="barnav col-md-2 col-xs-2">Qui sommes-nous ?</div></a>
					</div>
				</nav> 
			</header>
