<!DOCTYPE html>
<html lang="fr">
	<head>
	    <meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<title>FSCF Erreur 500</title>

	    <!-- Bootstrap -->
	    <link href="css/bootstrap.min.css" rel="stylesheet">
	    <link href="css/style500.css" rel="stylesheet">

	    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
    </head>
    <body>
		<!-- Page d'erreur interne au serveur -->
        <div class="content">
			<canvas class="snow" id="snow"></canvas> <!-- effet de neige qui tombe -->
			<div class="main-text">
				<h1>Ah mince.<br/>Erreur interne du serveur.</h1><a class="home-link" href="index.php">Revenez à l'Acceuil.</a>
			</div>
			<div class="ground"> <!-- le fait que le 500 est enfoncé dans le sol -->
			    <div class="mound"> 
					<div class="mound_text">(500)</div>
					<div class="mound_spade"></div>
			    </div>
			</div>
        </div>

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>
        <script src="js/script500.js"></script>
    </body>
</html>