<?php
	require_once'include/header.php';
	$title="inscription";
	if (isset($_GET["message"])) {
    echo '<script> alert("'.$_GET["message"].'");</script>';
      }
?>
	<div class="col-md-12">	
		<!-- Début du contenue principale -->					
		<section class="row">
			<h1 class="title text-center">Inscription</h1></br></br>
			<!-- Début du formulaire d'inscription action="include/dbinscription.php"-->						
			<form method="post" action="include/dbinscription.php" onsubmit="return comparaison()" id="register-form" name="register-form" class="well" enctype="multipart/form-data">		<!-- enctype="multipart/form-data" -> nécessaire lors d'un upload de fichier -->		
				<div class="row form">		
					<div class="col-md-6 colonne">

						<div class="form-group">
							<label> Nom <span class="asterisque">*</span></label>
							<input class="form-control required" type="text" name="lastname" id="lastname" required/>
						</div>
						<div class="form-group">
							<label> Prénom <span class="asterisque">*</span></label>
							<input class="form-control required" type="text" name="firstname" id="firstname" required/>
						</div>
						<div class="form-group">
							<label> Adresse E-mail <span class="asterisque">*</span></label>
							<input class="form-control required" type="email" name="email" id="email" required/>
						</div>
						<div class="form-group">
							<label> Adresse <span class="asterisque">*</span></label>
							<input class="form-control required" type="text" name="adress" id="adress" required/>
						</div>
					</div>
					<div class="col-md-6 colonne">						
						<div class="form-group">
							<label> Code Postal <span class="asterisque">*</span></label>
							<input class="form-control required" type="text" name="zipCode" id="zipCode" maxlength="5" required/>
						</div>
						<div class="form-group">
							<label> Ville <span class="asterisque">*</span></label>
							<input class="form-control required" type="text" name="ville" id="ville" required/>
						</div>
						<div class="form-group">
							<label> Votre n° de téléphone <span class="asterisque">*</span></label>
							<input class="form-control required" type="tel" name="phone" maxlength="10" placeholder="0000000000" id="tel" required/>
						</div>
						<div class="form-group">
							<label> Mot de passe <span class="asterisque">*</span></label>
							<input class="form-control required" type="password" name="mdp" maxlength="20" id="mdp" required/>
						</div>
						<div class="form-group">
							<label> Retapez votre mot de passe <span class="asterisque">*</span></label>
							<input class="form-control required" type="password" maxlength="20" id="mdp2" required/>
						</div>
					</div>
					<div>
						<input type="checkbox" id="termUse" name="termUse" required /> En cochant cette case, j'atteste d'avoir pris connaissance des <a class="modiflink" href="cgu.php">conditions générales de vente </a><span class="asterisque">*</span>
						<center>
							<input type="submit" id="submit" name="submit" onclick="verif()" class="btn btn-warning" href="#success_message"/>
						</center>
					</div>
					
				</div>
				
			</form>		
		</section>
	</div>


		

<script src="js/scriptinscription.js" type="text/javascript"></script>
<?php require ('include/footer.php'); ?>