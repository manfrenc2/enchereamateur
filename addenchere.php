<?php 
	require('include/header.php'); // on veut le header
	require('include/dbconfig.php');
	$bdd = new Fscf();
	$title="Ajout enchère";
	
	if(isset($_POST["submit"])) { // On vérifie que le bouton uptade2 est pressé.
        $bdd->addbid(); // si le bouton est pressé, la fonction update de la classe crud est utilisé.
    }
?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.3/jquery-ui-timepicker-addon.css" />
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/i18n/jquery-ui-i18n.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.3/i18n/jquery-ui-timepicker-addon-i18n.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.3/jquery-ui-timepicker-addon.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.3/jquery-ui-sliderAccess.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.3/i18n/jquery-ui-timepicker-fr.js"></script>
<script type='text/javascript' src='js/scriptaddenchere.js'></script>
<script>
  $( function() {
    $( ".calendrier" ).datetimepicker();
		$.datepicker.setDefaults( $.datepicker.regional[ "fr" ] );
		$( ".calendrier" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
  } );
</script>

	<div>	
		<!-- Début du contenue principale -->					
		<section>
			<h1 class="title text-center">Ajouter une enchère</h1></br></br>
			<!-- Début du formulaire d'inscription action="include/dbinscription.php"-->						
			<form method="post" onsubmit="return comparaison()" id="register-form" name="register-form" class="well" enctype="multipart/form-data">		<!-- enctype="multipart/form-data" -> nécessaire lors d'un upload de fichier -->		
				<div class="row form">		
					
					<div class="col-md-6 colonne">
						<div class="form-group">
							<label> Selectionner un article <span class="asterisque">*</span></label>
							<select class="form-control required" name="choice" id="choice" required/>
								<option value="" selected></option>
								<?php $bdd->seearticle($id); ?>
							</select>
						</div>
						<div class="form-group">
							<label> Date de démarrage prévue <span class="asterisque">*</span></label>
							<input class="form-control required calendrier" type="text" name="datedemarrageprevue" id="datedemarrageprevue" required/>
						</div>
						<div class="form-group">
							<label> Date de fin prévue <span class="asterisque">*</span></label>
							<input class="form-control required calendrier" type="text" name="datefinprevue" id="datefinprevue" required/>
						</div>
						<div class="form-group">
							<label> Prix de départ en € <span class="asterisque">*</span></label>
							<input class="form-control required" type="number" step="0.01" name="prixdepart" id="prixdepart" required/>
						</div>
						<div class="form-group">
							<label> Prix de clôture en € <span class="asterisque">*</span></label>
							<input class="form-control required" type="number" step="0.01" name="prixcloture" id="prixcloture" required/>
						</div>
						<div>
							<center>

								<input type="submit" id="submit" name="submit" onclick="verif()" class="btn btn-warning" href="#success_message"/>
							</center>						
						</div>
					</div>
					<div class="col-md-6 colonne">
						<div id="picture">
							<?php echo '<script>seeidarticle();</script>'; ?>
						</div>
					</div>
				</div>
				
			</form>		
		</section>
	</div>


		


<?php require ('include/footer.php'); ?>