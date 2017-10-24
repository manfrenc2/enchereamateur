
<?php
	require('include/header.php');
	require('include/dbconfig.php');
	$bdd = new Fscf();
	$title="Acceuil";
	//require_once'include/dbconfig.php';
	//$bdd = new Fscf();
	if (isset($_GET["message"])) {
		echo '<script> alert("'.$_GET["message"].'");</script>';
    }
?>
<script src="js/scriptindex.js" type="text/javascript"></script>
<script src="js/scripttoutvoircountdown.js" type="text/javascript"></script>

<div class="col-md-12 col-xs-12">
	<div class="container2">
	  <div class="carousel">

		<?php 
		ini_set("display_errors",0);error_reporting(0);
		$bdd->seecarou(); ?>
	  </div>
	</div>
</div>
<div class="col-md-12 col-xs-12 ">
	<?php $bdd->seeexpo(); ?>
</div>
	
				
			

		
<?php require ('include/footer.php'); ?>