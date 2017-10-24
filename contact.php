<?php 
	require('include/header.php');
?>	
	<div class="col-md-12">					
		<section class="row"> <!-- Début du contenu principal -->       
			<h1 class="title"> Nous<br>Contacter </h1>
			<p class="horaire"> Nos horaires d'ouvertures sont du Lundi au Vendredi : de 9h00 à 17h00.</p>
			<div class="row"> <!-- Formulaire de contact -->
				<form class="col-md-6" action="mail.php" method="post" onsubmit="return comparaison2()">
					<div class="form-group">
						<label for="nomcont">Nom <span>*</span>:</label>
						<input type="text" class="form-control form-control2" id="nomcont" name="nom" />
					</div>
					<div class="form-group">
						<label for="prenomcont">Prénom <span>*</span>:</label>
						<input type="text" class="form-control form-control2" id="prenomcont" name="prenom" />
					</div>
					<div class="form-group">
						<label for="mailcont">Email <span>*</span>:</label>
						<input type="email" class="form-control form-control2" id="mailcont" name="mail" />
					</div>
					<div class="form-group">
						<label for="telcont">Téléphone <span>*</span>:</label>
						<input type="tel" class="form-control form-control2" id="telcont" name="tel" />
					</div>
					<div class="form-group">
						<label for="comment">Votre message <span>*</span>:</label>
						<textarea class="form-control form-control2" rows="3" id="comment" name="msg" ></textarea>
					</div>
					<input type="submit" value="Valider" class="btn btn-danger" name="valider"/> <!-- bouton d'envoie -->
				</form>           
				
			</div>                          
		</section>
	</div>	


<script src="js/scriptcontact.js" type="text/javascript"></script>
<?php require ('include/footer.php'); ?>