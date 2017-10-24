<?php
	require('include/header.php');
	require('include/dbconfig.php');
	$bdd = new Fscf();
	$title="Enchère";
	//require_once'include/dbconfig.php';
	//$bdd = new Fscf();
	
	$bidid = $_GET["id"];

    if($bidid == null) {
        header('location: ./index.php');
    }
	
	if(isset($_POST["submit"])) { // On vérifie que le bouton uptade2 est pressé.
        ini_set("display_errors",0);error_reporting(0);
        $bdd->addproposal($bidid, $id); // si le bouton est pressé, la fonction update de la classe crud est utilisé.
    }
    
?>
<script src="js/scriptenchere.js" type="text/javascript"></script>
		<div class="col-md-12 row">
            <div>
                <?php $bdd->bidtitle($bidid); ?>
                <div id="cabour">
                    <?php $bdd->bidcountdown($bidid); ?>
                </div>
                 <div class="col-md-4 row">
                    <div id="propform" class="col-md-12 row">
                        <?php $bdd->bidcountchange($bidid); 
						echo '<script>seecountchange('.$bidid.');</script>';?>
                    </div>
					<div id="proposition" class="col-md-12 row">
                        <?php echo '<script>seeproposal('.$bidid.');</script>';
						$bdd->bidseeproposal($bidid)?>
						
                    </div>
                </div>
				<div class="col-md-8 row divpicture" style="text-align: center;">
					
					<?php $bdd->bidpicture($bidid); ?>
					
				</div>
            </div>
        </div>
        <div class="col-md-12 row">
            <div>
                <div id="price" class="col-md-4 row">
                    <?php echo '<script>seeprice('.$bidid.');</script>';
					$bdd->bidprice($bidid); ?>

                </div>
                <div class="col-md-8 row">
                    <?php $bdd->biddescription($bidid); ?>
                </div>
            </div>

        </div>


<?php require ('include/footer.php'); ?>