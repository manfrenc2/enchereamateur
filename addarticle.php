<?php 
	require('include/header.php'); // on veut le header
	require('include/dbconfig.php');
	$title="Ajout article";	
	$bdd = new fscf;
	
	if(isset($_POST["submit"])) { // On vérifie que le bouton uptade2 est pressé.
        $bdd->addarticle($id); // si le bouton est pressé, la fonction update de la classe crud est utilisé.
    }
?>
<script type='text/javascript' src='http://code.jquery.com/jquery-1.9.1.js'></script>


<div>	
		<!-- Début du contenue principale -->					
		<section>
			<h1 class="title text-center">Ajouter un article</h1></br></br>
			<!-- Début du formulaire d'inscription action="include/dbinscription.php"-->						
			<form method="post" id="register-form" name="register-form" class="well" enctype="multipart/form-data">		<!-- enctype="multipart/form-data" -> nécessaire lors d'un upload de fichier -->		
				<div class="row form">		
					<div class="col-md-6 colonne">

						<div class="form-group">
							<label> Titre article <span class="asterisque">*</span></label>
							<input class="form-control required" type="text" name="title" id="title" required/>
						</div>
						<div class="form-group">
							<label> Description de l'article <span class="asterisque">*</span></label>
							<textarea class="form-control required" name="description" id="description" required/></textarea>
						</div>
						<div class="form-group">
							<label> Stock<span class="asterisque">*</span></label>
							<input class="form-control required" type="text" name="stock" id="stock" required/>
						</div>
						<div class="form-group">
							<label> Catégorie <span class="asterisque">*</span></label>
							<select class="form-control required" name="category" id="category" required/>
								<option>Tableaux</option> 
								<option>Meubles</option>
								<option>Vases</option>
							</select>
						</div>
						<div class="form-group">
							<label> Image de l'article <span class="asterisque">*</span></label>
							<input class="form-control required" type="file" name="image" id="image" required/>
						</div>	
						<div>
							<center>
								<input type="submit" id="submit" name="submit" onclick="verif()" class="btn btn-warning" href="#success_message"/>
							</center>						
						</div>
					</div>
					<div class="col-md-6 colonne">
						<div>
							<img id="blah" src="#" alt="Votre image" width="100%"/>
						</div>
					</div>
					
				</div>
				
			</form>		
		</section>
	</div>

<script type='text/javascript'>//<![CDATA[
	$(window).load(function(){
		function readURL(input) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();
				 
				reader.onload = function (e) {
					$('#blah').attr('src', e.target.result);
				}
				 
				reader.readAsDataURL(input.files[0]);
			}
		}
		 
		$("#image").change(function(){
			readURL(this);
		});
	});//]]> 
</script>
		


<?php require ('include/footer.php'); ?>