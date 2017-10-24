<?php
	require('include/header.php');
	require('include/dbconfig.php');
	$bdd = new Fscf();
	$title="Tout voir";
	//require_once'include/dbconfig.php';
	//$bdd = new Fscf();
?>

<script src="js/scripttoutvoircountdown.js" type="text/javascript"></script>

			<div class="col-md-12 main">
				<div class="col-md-2">
					<div>
						<form>
							<div> FILTRE </div>
							<fieldset>
								<legend>
									<div class="checkbox">
										<label>
											<input type ="checkbox" id="inputtoutvoir" checked> Tout voir
										</label>
									</div>
								</legend>
							</fieldset>
							<fieldset>
								<div class="checkbox">
									<label>
										<input type ="checkbox" id="inputmeubles"> Meubles
									</label>
								</div>
								<div class="checkbox">
									<label>
										<input type ="checkbox" id="inputtableaux"> Tableaux
									</label>
								</div>
								<div class="checkbox">
									<label>
										<input type ="checkbox" id="inputvases"> Vases
									</label>
								</div>
							</fieldset>
						</form>
					</div>
				</div>
				<div id="bidlist" class="col-md-10">
					<?php //echo '<script>seebid();</script>';
					$bdd->seeall(); ?>
										
				</div>
			</div>
<script src="js/scripttoutvoir.js"></script>


<?php require ('include/footer.php'); ?>