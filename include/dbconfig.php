<?php
	header('Content-Type: text/html; charset=utf-8');
	include_once('dbconnexion.php');

	class Fscf{
	
		/*public $conn;*/
		
		//function __construct(){ // fonction qui s'executera automatiquement en introduction lorsque la méthode de l'objet sera appelée.
			//$host = "localhost"; //var host = "sql site";
			//$user = "root";
			//$password = "";
			//$database = "artamateur";//nom de la base de données
			
			/*$conn_options = array(
				PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8", // On force l&#39;encodage en utf8
				PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // On récupère tous les résultats en
				//tableau associatif
				PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING // On affiche des warnings pour les erreurs,
				//à commenter en prod (valeur par défaut PDO::ERRMODE_SILENT)
				);
			
			
			$conn = new PDO("mysql:host = localhost; dbname = artamateur", "root", "", $conn_options);*/
			
			/*$this->conn = mysqli_connect($host, $user, $password, $database); // var de connexion bdd
			mysqli_set_charset($this->conn,"utf8");*/ // prise en charge des caractères spéciaux
		//}
					
			
		public function connect($login, $password){    //On définie une fonction de connexion.
		
			/********* Retourne par default le message d'erreur **********/
			$retour = "location:index.php";   // Envoie à la page index.php et affecte à la variable "message" un message d'erreur.
			
			
			
			$pseudo = $login; 	// On récupère le pseudo entré dans une variable.
			$mdp = htmlspecialchars($password,ENT_QUOTES);	// On récupère le mot de passe entré dans une variable. Utilisation de la fonction htmlspecialchars, qui convertit tous les guillemets simples en doubles et inversemement (c'est le mode ENT_QUOTES). Ainsi l'utilisateur ne peut pas utiliser de guillements dans le champs mot de passe et ne peut donc pas se connecter frauduleusement.
			$sql = "SELECT * FROM users WHERE mail = '$login' AND active='1'"; // Requête que l'on va envoyer à la base de donnée.
			//$result = mysqli_query($this->conn, $sql); //Envoi de la requête qu'on stock dans la variable result
			//$resultarr = mysqli_fetch_array($result); //On converti le résultat de "result" sous forme de tableau pour faciliter la récolte d'information.
			$contenu = Connexion::getInstance()->prepare($sql); //on stock dans une variable, on appel la class connexion et sa fonction getInstance, query lance l'intérogation de la BDD ($sql) 
			$contenu->execute();
			$com = $contenu->fetchall();

			$contenu->execute();
			$result = $contenu->fetch(); //On stock dans result le contenu sous forme de tableau.
			
			$compte=count($com); //On stock dans compte, le comptage des colonnes généré.
			
			if ($compte > 0) {  // Si le résultat de notre requête nous retourne au moins un élément alors exécuter la suite.
			   if ($result['password'] != $this->crypt_password($mdp)){ // On vérifie que le mot de passe du champs "pass" est différent du mot de passe crypté entré par l'utilisateur.
					$retour = "location:index.php?message=Passeword+%20+error";   // Envoie à la page index.php et affecte à la variable "message" un message d'erreur.
				}else { // Sinon toutes les information entrées sont correct.
					session_start(); //Démarrage de la session.
					$_SESSION['connection']=TRUE; //On affecte à la variable $_SESSION, la valeur TRUE pour lui signaler que l'on est connecté.
					$_SESSION['mail']=$_POST["login"];//On récupère l'adresse mail entré par l'utilisateur.
					$_SESSION['id']=session_id(); //On affecte un id de connexion unique, celui-ci sera différent à la prochaine connexion.
					$_SESSION['ip']=$_SERVER['REMOTE_ADDR']; //On affecte l'adresse IP du client qui demande la page courante.
					$_SESSION['admin']=$result['admin'];
					//$retour = "location:profil.php"; //On envoie l'utilisateur sur sa page de connecxion.
		 //       die;
					
				}
			}
			return $retour;
		}
			
			
			
		public function profilUser($id){    //On définie une fonction ayant pour role de recuperer de la base de données les informations de la table "Stagiaire".
		
			$sql = "SELECT `idusers`,`name`,`firstname`,`mail`,`adress`,`phone`,`zipcode`,`city` FROM `users` WHERE `mail` = '$id'"; // Requête que l'on va envoyer à la base de donnée.
			$contenu = Connexion::getInstance()->prepare($sql); //on stock dans une variable, on appel la class connexion et sa fonction getInstance, query lance l'intérogation de la BDD ($sql) 
			$contenu->execute();
			$result = $contenu->fetch(); //On stock dans result le contenu sous forme de tableau.
			$compte=count($result); //On stock dans compte, le comptage des colonnes généré.
			if ($compte > 0) {
				return $result;
			}
			
			// echo $sql; die();
			/*$result = mysqli_query($this->conn, $sql); //Envoi de la requête qu'on stock dans la variable result
			if(mysqli_num_rows($result) > 0) {  // Si le résultat de notre requête nous retourne au moins un élément alors exécuter la suite.
			   return mysqli_fetch_array($result); //On converti le résultat de "result" sous forme de tableau pour faciliter la récolte d'information.
			}*/
			return null;
		}
		

		public function insertUser($name,$firstname,$adress,$zipcode,$city,$phone,$mail,$mdp){    //On définie une fonction ayant pour role de recuperer de la base de données les informations de la table "Stagiaire".
			
			$retour = array("error" => true);
   			$sql = "SELECT * FROM users WHERE mail = '$mail'"; // Mise en forme de la requête que l'on va envoyer, on récolte la ligne qui associe le contenu du champs email au contenu entré par l'utilisateur.
   			$passrand = $this->chaine_aleatoire(16); // Création mdp aleatoire avec la fonction chaine aleatoire et stocké dans une variable
    		$passfinal = $this->crypt_password($mdp); // Cryptage du mdp aleatoire avec la fonction de cryptage et stocké dans une variable
			
			$contenu = Connexion::getInstance()->prepare($sql); //on stock dans une variable, on appel la class connexion et sa fonction getInstance, query lance l'intérogation de la BDD ($sql) query = prepare + execute
			$contenu->execute();
			$com = $contenu->fetchall();

			$contenu->execute();
			$result = $contenu->fetch(); //On stock dans result le contenu sous forme de tableau.
			
			$compte=count($com); //On stock dans compte, le comptage des colonnes généré.
			
    		//$result2 = mysqli_query($this->conn, $verif); //Envoi de la requête à la base de donnée.
		    //if(mysqli_num_rows($result2) > 0) { // Si la base de donnée nous retourne au moins un élément (ce qui signifie que le pseudo existe déjà), alors exécuter la suite :
			if ($compte > 0) { // Si la base de donnée nous retourne au moins un élément (ce qui signifie que le pseudo existe déjà), alors exécuter la suite :
		        // PS : on n'aura toujours qu'un seul élément puisque le champs email est configuré en unique.
		        
		        
		        //echo ("ce pseudo existe déjà");
				$retour["message"] = "Ce pseudo existe déjà !";
		        $retour["return"] = "location:../inscription.php";
		    }else { // Sinon
		    	$sql = "SELECT MAX(idusers) FROM users"; // Requete qui permet de trouver l'idusers maximum.
		    	$contenu = Connexion::getInstance()->prepare($sql);
				$contenu->execute();
				$result = $contenu->fetch(); //On stock dans result le contenu sous forme de tableau.
				$max=$result["MAX(idusers)"]; // On stock l'id maximum dans une variable
				$idtrouve = NULL; // Correspond aux vide dans les ID, cette variable nous servira à reperer un vide dans le comptage des ID
				for ($i=1; $i < $max; $i++) { // On compte de 1 jusqu'a l'id maximum
					$sql = "SELECT * FROM users WHERE idusers = ".$i.""; // Demande d'affichage de l'user qui correspond à $i
		    		$contenu = Connexion::getInstance()->prepare($sql); 
					$contenu->execute();
					$com = $contenu->fetchall(); // Récuperer le nombre de ligne que mysql nous envoie

					$contenu->execute();
					$result = $contenu->fetch(); //On récupère les données sous forme de tableau pour pouvoir les exploiter
					$compte=count($com);

					if($compte > 0) { // Si on optiens un résultat, cela signifie qu'il n'y pas de vide au niveau de $i
						
					}
					else{ // sinon on signale l'emplacement de l'id vide
						$idtrouve = $i;
						
					}
				}
				if ($idtrouve == NULL) { // Si il n'y a pas de vide dans l'id, la condition est vérifié

					if ($max<1 || $max==NULL){ // Dans l'eventualité de l'id max soit egale à 0 ou null alors...
						$sql2 = "ALTER TABLE users AUTO_INCREMENT = 0"; // on recommence le comptage a partir de 0
						$contenu = Connexion::getInstance()->prepare($sql2); 
						$contenu->execute();
						$sql = "INSERT INTO `users`(`idusers`, `name`, `firstname`, `adress`, `zipcode`, `city`, `phone`, `mail`, `password`,`token`,`timestamp`) VALUES ('','$name','$firstname','$adress','$zipcode','$city','$phone','$mail','$passfinal','','')";
						$contenu = Connexion::getInstance()->query($sql); 
						echo ("ce pseudo existe déjà");
						$this->newtoken2($mail,$name);
						$retour["message"] = "Un lien de confirmation a été envoyé dans votre boîte de réception.";
						$retour["return"] = "location:../index.php";


					}else { // sinon on compte a partir de l'id maximum
						$sql2 = "ALTER TABLE users AUTO_INCREMENT = ".$max.""; 
						$contenu = Connexion::getInstance()->prepare($sql2); 
						$contenu->execute();
						$sql = "INSERT INTO `users`(`idusers`, `name`, `firstname`, `adress`, `zipcode`, `city`, `phone`, `mail`, `password`,`token`,`timestamp`) VALUES ('','$name','$firstname','$adress','$zipcode','$city','$phone','$mail','$passfinal','','')";
						$contenu = Connexion::getInstance()->query($sql); 
						$this->newtoken2($mail,$name);
						$retour["message"] = "Un lien de confirmation a été envoyé dans votre boîte de réception.";
						$retour["return"] = "location:../index.php";

					}
				}
				else { //sinon il y a effectivement un vide, alors on isert dans l'emplacement de l'id vide
						$sql = "INSERT INTO `users`(`idusers`, `name`, `firstname`, `adress`, `zipcode`, `city`, `phone`, `mail`, `password`,`token`,`timestamp`) VALUES (".$idtrouve.",'$name','$firstname','$adress','$zipcode','$city','$phone','$mail','$passfinal','','')";
						$contenu = Connexion::getInstance()->query($sql); 
						$this->newtoken2($mail,$name);
						$retour["message"] = "Un lien de confirmation a été envoyé dans votre boîte de réception.";
						$retour["return"] = "location:../index.php";
						

				}
				 // Insertion dans la bdd
		      

				
				
				
		        /*if($this->sendMailRegister($name, $firstname, $mail, $passrand, $date)){ // Envoi du mail avec le mdp non crypté
		        	$retour["error"] = false;
		        	$retour["return"] = "location:../index.php";
		        	$retour["message"] = "Ok";
		        }
		        else{ // sinon erreur et retour sur la page inscription
		        	$retour["message"] = "Une erreur !";
		        	$retour["return"] = "location:../inscription.php";
		        }*/
		    }
		    return $retour;
		}
		
		public function addarticle($id) { //fonction pour ajouter dans la table article
			$target_dir = "./imgarticle/"; // dossier de destination
			$target_file = $target_dir .date("YmdHis"). basename($_FILES["image"]["name"]); // on définie le nom du fichier : date creation + nom + extension.
			$uploadOk = 1; // témoin qui permet de signaler une erreur.
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION); // on récupère l'extension du fichier.
			//$check = getimagesize($_FILES["image"]["tmp_name"]); // on demande de récupérer la taille de l'image.
			/*if($check !== false) {
				echo "File is an image - " . $check["mime"] . ".";
				$uploadOk = 1;
			} else {
				$message = "Le fichier n'est pas une image valide.";
				echo $message;
				$uploadOk = 0;
			}*/
			if (file_exists($target_file)) { // si le fichier existe déjà dans le dossier de destination alors erreur.
				$message = "Erreur! le fichier image existe déjà.";
				echo $message;
				$uploadOk = 0;
			}
			if ($_FILES["image"]["size"] > 500000) { // si le poid est supérieur à 500 000 octé alors erreur.
				$message = "Le fichier selectionné est trop volumineux.";
				echo $message;
				$uploadOk = 0;
			}
			if (iconv_strlen($_FILES["image"]["name"]) > 70) {
                    $message = "Le nom ne doit pas dépasser 10 caractères !";
                    echo $message;
                    $uploadOk = 0;
            }
			if($imageFileType != "jpg" &&$imageFileType != "JPG"&& $imageFileType != "png" && $imageFileType != "PNG" && $imageFileType != "jpeg" && $imageFileType != "JPEG") { // si l'extention est different d'un format autorisé alors erreur.
				$message = "Les images doivent etre au format: JPG, JPEG, PNG.";
				echo $message;
				$uploadOk = 0;
			}
			if ($uploadOk == 0) { // on récupère le temoin d'erreur et si il est = 0, on signal une erreur à l'utilisateur.
				$message = "Erreur! impossible d'ajouter l'image.";
				echo $message;
				 

			} else {
				if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) { // sinon il enregistre l'image dans le dossier et sont chemin dans la bdd.
					 
						 
						$message = "Image ajoutée avec succès.";
							 
						echo $message;
						 
				} else {
					$message = "Erreur inconnue! Merci de retenter l'ajout plus tard ou de contacter l'administrateur.";
					echo $message;
				}
			} 
					
			$recupid = $this->recupid($id);
			$titre=$_POST["title"];
			$titre=addslashes($titre);
			$texte=$_POST["description"];
			$texte=addslashes($texte);
            $sql = "INSERT INTO article (`idarticle`, `title`, `description`, `stock`, `category`, `visible`, `users_idusers`, `sold`, `picture`) VALUES ('', '".$titre."', '".$texte."', '".$_POST["stock"]."', '".$_POST["category"]."','1', '$recupid','', '$target_file')"; // Requête que l'on souhaite envoyer à la base de donnée.
            $contenu = Connexion::getInstance()->prepare($sql); //on stock dans une variable, on appel la class connexion et sa fonction getInstance, query lance l'intérogation de la BDD ($sql) 
			$contenu->execute();
            
        }
		
		public function seearticle($id){    //On définie une fonction ayant pour role de recuperer de la base de données les informations de la table "article".
		
			$sql = "SELECT * FROM `users`,`article` WHERE `mail` = '$id' AND `users_idusers` = `idusers` AND `visible` = 1"; // Requête que l'on va envoyer à la base de donnée.
			$contenu = Connexion::getInstance()->prepare($sql); //on stock dans une variable, on appel la class connexion et sa fonction getInstance, query lance l'intérogation de la BDD ($sql) 
			$contenu->execute();
		
				while ($result = $contenu->fetch()) {
					
					$idarticle = $result["idarticle"];
					$choice = $result["title"];
					$picture = $result["picture"];
					
					echo '<option>'.$idarticle.' '.$choice.'</option>';
				}
				
			
			
			// echo $sql; die();
			/*$result = mysqli_query($this->conn, $sql); //Envoi de la requête qu'on stock dans la variable result
			if(mysqli_num_rows($result) > 0) {  // Si le résultat de notre requête nous retourne au moins un élément alors exécuter la suite.
			   return mysqli_fetch_array($result); //On converti le résultat de "result" sous forme de tableau pour faciliter la récolte d'information.
			}*/
			
		}
		
		public function seepicture($id){    //On définie une fonction ayant pour role de recuperer de la base de données les informations de la table "article".
			$sql = "SELECT picture FROM `article` WHERE `idarticle` = '$id'"; // Requête que l'on va envoyer à la base de donnée.
			$contenu = Connexion::getInstance()->prepare($sql); //on stock dans une variable, on appel la class connexion et sa fonction getInstance, query lance l'intérogation de la BDD ($sql) 
			$contenu->execute();
			$result = $contenu->fetch();
			
			
		
					
			echo '<img src="'.$result["picture"].'" width="100%">';
			
				
		
			
		}
		
		
		
		
		public function addbid() { // On définie une fonction pour ajouter une enchère.
			$choix = $_POST["choice"]; // On récupère l'option selectionné
			$choix2= explode (" ", $choix); // On dissocie les valeurs séparer par un espace et on les sotcks dans le tableau $choix2
			$today =  date("Y-m-d H:i:s");
			$sql = "INSERT INTO bid (`idbid`,`article_idarticle`, `startdate`, `enddateexpected`, `pricing`, `pricefinal`, `enddateeffective`, `winner`, `creationdate`, `users_idwinner`, `pricesold`) VALUES ('', '$choix2[0]', '".$_POST["datedemarrageprevue"]."', '".$_POST["datefinprevue"]."', '".$_POST["prixdepart"]."', '".$_POST["prixcloture"]."','0','0','".$today."','2','0')"; // Requête que l'on souhaite envoyer à la base de donnée.
            $contenu = Connexion::getInstance()->prepare($sql); //on stock dans une variable, on appel la class connexion et sa fonction getInstance, query lance l'intérogation de la BDD ($sql) 
			$contenu->execute();
			
			$sql2= "UPDATE article, bid SET visible=0 WHERE idarticle = article_idarticle";
			$contenu = Connexion::getInstance()->prepare($sql2); //on stock dans une variable, on appel la class connexion et sa fonction getInstance, query lance l'intérogation de la BDD ($sql) 
			$contenu->execute();
			
		}

		public function myarticle($id) { //fonction pour afficher la table stagiaire

			$sql="SELECT * from article, users WHERE  `mail` = '$id' AND `users_idusers` = `idusers`";
			$contenu = Connexion::getInstance()->prepare($sql); //on stock dans une variable, on appel la class connexion et sa fonction getInstance, query lance l'intérogation de la BDD ($sql) 
			$contenu->execute();
			//$resultset = mysqli_query($this->conn, $sql);
			while( $rows = $contenu->fetch() ) { // récuperation tableau bdd
				$ida=$rows["idarticle"];
				$category=$rows["category"];
				$description=$rows["description"];
				$title=$rows["title"];
				$stock=$rows["stock"];
				$visible=$rows["visible"];
				
				echo '
				
						<tr>
							<td><input hidden type="text" size="1" name="idarticle" value="'.$ida.'"/>'.$ida.'</td>
							<td><input hidden type="text" name="titre" value="'.$title.'"/>'.$title.'</td>
							<td><input hidden type="text" name="description" value="'.$description.'"/>'.$description.'</td>
							<td><input hidden type="text" name="stock" value="'.$stock.'"/>'.$stock.'</td>
							<td><input hidden type="text" name="categorie" value="'.$category.'"/>'.$category.'</td>
							<td><input hidden type="text" name="valide" value="'.$visible.'"/>'.$visible.'</td>

							<td style="display: flex;">
								<input type="submit" name="delmyarticle" value="Delete" class="btn btn-danger crud-delmyarticle">
							</td>
						</tr>

				';	
			}	
		}
			
		public function delmyarticle(){ //fonction de suppression table stage
            
            $pls = "DELETE FROM article WHERE idarticle = '".$_POST["idarticle"]."'"; // Requête que l'on souhaite envoyer à la base de donnée.
            $contenu = Connexion::getInstance()->prepare($pls); //on stock dans une variable, on appel la class connexion et sa fonction getInstance, query lance l'intérogation de la BDD ($sql) 
			$contenu->execute();
			
			$pls = "OPTIMIZE TABLE article";
			$contenu = Connexion::getInstance()->prepare($pls);
			$contenu->execute();
			
			//mysqli_query($this->conn, $pls); // on envoie la requête pour qu'elle soit exécutée.
            
        }	
		
		public function winbid($id){
			$sql="SELECT * from bid,users,article WHERE  `mail` = '$id' AND article_idarticle = idarticle AND `users_idwinner` = `idusers` AND `sold` = 1";
			$contenu = Connexion::getInstance()->prepare($sql); //on stock dans une variable, on appel la class connexion et sa fonction getInstance, query lance l'intérogation de la BDD ($sql) 
			$contenu->execute();
			//$resultset = mysqli_query($this->conn, $sql);
			while( $rows = $contenu->fetch() ) { // récuperation tableau bdd
				$ide=$rows["idbid"];
				$startdate=$rows["startdate"];
				$enddateexpected=$rows["enddateexpected"];
				$pricing=$rows["pricing"];
				$article=$rows["title"];
				$pricefinal=$rows["pricefinal"];
				
				echo '
				
					<tr>
						<td><input hidden type="text" size="1" name="idbid" value="'.$ide.'"/>'.$ide.'</td>
						<td><input hidden type="text" name="startdate" value="'.$startdate.'"/>'.$startdate.'</td>
						<td><input hidden type="text" name="enddateexpected" value="'.$enddateexpected.'"/>'.$enddateexpected.'</td>
						<td><input hidden type="text" name="pricing" value="'.$pricing.'"/>'.$pricing.'</td>
						<td><input hidden type="text" name="article" value="'.$article.'"/>'.$article.'</td>
						<td><input hidden type="text" name="pricefinal" value="'.$pricefinal.'"/>'.$pricefinal.'</td>
					</tr>

				';
			}	
		}
		
		public function nowbid($id){
			$sql="SELECT * from bid,users,article WHERE  `mail` = '$id' AND article_idarticle = idarticle AND `users_idusers` = `idusers` AND `sold` = 0";
			$contenu = Connexion::getInstance()->prepare($sql); //on stock dans une variable, on appel la class connexion et sa fonction getInstance, query lance l'intérogation de la BDD ($sql) 
			$contenu->execute();
			//$resultset = mysqli_query($this->conn, $sql);
			while( $rows = $contenu->fetch() ) { // récuperation tableau bdd
				$ide=$rows["idbid"];
				$startdate=$rows["startdate"];
				$enddateexpected=$rows["enddateexpected"];
				$pricing=$rows["pricing"];
				$article=$rows["title"];
				$pricefinal=$rows["pricefinal"];
				
				echo '
				
					<tr>
						<td><input hidden type="text" size="1" name="idbid" value="'.$ide.'"/>'.$ide.'</td>
						<td><input hidden type="text" name="startdate" value="'.$startdate.'"/>'.$startdate.'</td>
						<td><input hidden type="text" name="enddateexpected" value="'.$enddateexpected.'"/>'.$enddateexpected.'</td>
						<td><input hidden type="text" name="pricing" value="'.$pricing.'"/>'.$pricing.'</td>
						<td><input hidden type="text" name="article" value="'.$article.'"/>'.$article.'</td>
						<td><input hidden type="text" name="pricefinal" value="'.$pricefinal.'"/>'.$pricefinal.'</td>

						<td style="display: flex;">
							<input type="submit" name="delnowbid" value="Delete" class="btn btn-danger crud-delnowbid">
						</td>
					</tr>

				';
			}	
		}
		
		public function delnowbid(){ //fonction de suppression table stage
            
			
			$pls2= "UPDATE article, bid SET visible=1 WHERE idbid = '".$_POST["idbid"]."' AND article_idarticle = idarticle";
			$contenu2 = Connexion::getInstance()->prepare($pls2); //on stock dans une variable, on appel la class connexion et sa fonction getInstance, query lance l'intérogation de la BDD ($sql) 
			$contenu2->execute();
			
			
            $pls = "DELETE FROM bid WHERE idbid = '".$_POST["idbid"]."'"; // Requête que l'on souhaite envoyer à la base de donnée.
            $contenu = Connexion::getInstance()->prepare($pls); //on stock dans une variable, on appel la class connexion et sa fonction getInstance, query lance l'intérogation de la BDD ($sql) 
			$contenu->execute();
			
			$pls = "OPTIMIZE TABLE bid";
			$contenu = Connexion::getInstance()->prepare($pls);
			$contenu->execute();


        }	
		
		public function pastbid($id){
			$sql="SELECT * from bid,users,article WHERE  `mail` = '$id' AND article_idarticle = idarticle AND `users_idusers` = `idusers` AND `sold` = 1";
			$contenu = Connexion::getInstance()->prepare($sql); //on stock dans une variable, on appel la class connexion et sa fonction getInstance, query lance l'intérogation de la BDD ($sql) 
			$contenu->execute();
			//$resultset = mysqli_query($this->conn, $sql);
			while( $rows = $contenu->fetch() ) { // récuperation tableau bdd
				$ide=$rows["idbid"];
				$startdate=$rows["startdate"];
				$enddateexpected=$rows["enddateexpected"];
				$enddateeffective=$rows["enddateeffective"];
				$pricing=$rows["pricing"];
				$article=$rows["title"];
				$pricefinal=$rows["pricefinal"];
				$pricesold=$rows["pricesold"];
				$winner=$rows["firstname"];
				
				echo '
				
					<tr>
						<td><input hidden type="text" size="1" name="idbid2" value="'.$ide.'"/>'.$ide.'</td>
						<td><input hidden type="text" name="startdate2" value="'.$startdate.'"/>'.$startdate.'</td>
						<td><input hidden type="text" name="enddateexpected2" value="'.$enddateexpected.'"/>'.$enddateexpected.'</td>
						<td><input hidden type="text" name="enddateeffective2" value="'.$enddateeffective.'"/>'.$enddateeffective.'</td>
						<td><input hidden type="text" name="pricing2" value="'.$pricing.'"/>'.$pricing.'</td>
						<td><input hidden type="text" name="article2" value="'.$article.'"/>'.$article.'</td>
						<td><input hidden type="text" name="pricefinal2" value="'.$pricefinal.'"/>'.$pricefinal.'</td>
						<td><input hidden type="text" name="pricesold2" value="'.$pricesold.'"/>'.$pricesold.'</td>
						<td><input hidden type="text" name="winner2" value="'.$winner.'"/>'.$winner.'</td>

					</tr>

				';
			}	
		}
		
		public function seecarou(){
            $sql="SELECT * from bid, article WHERE article_idarticle=idarticle AND sold=0 ORDER BY pricesold desc LIMIT 5";
            $contenu = Connexion::getInstance()->prepare($sql); //on stock dans une variable, on appel la class connexion et sa fonction getInstance, query lance l'intérogation de la BDD ($sql) 
            $contenu->execute();

            $picture = NULL; // on definie une variable picture qui contiendra les URL des images.
			$bidid = NULL;
            while( $rows = $contenu->fetch() ) { // récuperation tableau bdd
                $picture=$picture."|".$rows["picture"]; // concaténation des url visité par la boucle, séparer par le trait
				$bidid=$bidid."|".$rows["idbid"];
            }


            $imageAll=explode("|", $picture); // on divise la concaténation grace au trait pour en faire un tableau
			$bididAll=explode("|", $bidid);
            $imageA=$imageAll[1]; // on associe $imageA à la 1ere url du tableau
            $imageB=$imageAll[2]; // on associe $imageB à la 1ere url du tableau
            $imageC=$imageAll[3]; // on associe $imageC à la 1ere url du tableau
			$imageD=$imageAll[4];
			$imageE=$imageAll[5];
			$bididA=$bididAll[1];
			$bididB=$bididAll[2];
			$bididC=$bididAll[3];
			$bididD=$bididAll[4];
			$bididE=$bididAll[5];

			
            /*echo '  <div class="a">
						<a href="enchere.php?id='.$bididA.'">
							<img class="item" src="'.$imageA.'">
						</a>
                    </div>
                    <div class="b">
						<a href="enchere.php?id='.$bididB.'">
							<img class="item" src="'.$imageB.'">
						</a>
                    </div>
                    <div class="c">
						<a href="enchere.php?id='.$bididC.'">
							<img class="item" src="'.$imageC.'">
						</a>
                    </div>';*/
					
			echo' 
				<div id="imgs">
					<a href="enchere.php?id='.$bididA.'">
						<img class="imgca" src="'.$imageA.'">
					</a>
					<a href="enchere.php?id='.$bididB.'">
						<img class="imgca" src="'.$imageB.'">
					</a>
					<a href="enchere.php?id='.$bididC.'">
						<img class="imgca" src="'.$imageC.'">
					</a>
					<a href="enchere.php?id='.$bididD.'">
						<img class="imgca" src="'.$imageD.'">
					</a>
					<a href="enchere.php?id='.$bididE.'">
						<img class="imgca" src="'.$imageE.'">
					</a>
				</div>';
        }
		
		
		
		public function seeexpo(){
			$sql="SELECT * from bid, article WHERE article_idarticle=idarticle AND sold=0 ORDER BY pricesold desc LIMIT 3";
			$contenu = Connexion::getInstance()->prepare($sql); //on stock dans une variable, on appel la class connexion et sa fonction getInstance, query lance l'intérogation de la BDD ($sql) 
			$contenu->execute();
			
			
			while( $rows = $contenu->fetch() ) { // récuperation tableau bdd
				$bidid=$rows["idbid"];
				$title=$rows["title"];
				$picture=$rows["picture"];
				$category=$rows["category"];
				$pricestart = $rows["pricing"];
				$priceadd = $rows["pricesold"];
				
				if ($priceadd == 0) {
					$afficheprix='Prix : '.$pricestart.' €';
				}else{
					$afficheprix='Prix : '.$priceadd.' €';
				}
				
				$diff=$this->prepcountdown($bidid);
				
				echo '
				
					<div class="col-md-4 toutvoir '.$category.'">
						<a href="enchere.php?id='.$bidid.'">
							<div class="tuiles">
								<div class="imgt">
									<img class="img" src="'.$picture.'"></img>
								</div>
								<div class="container descript">
									<p>'.$title.'</p>
								</div>
								<div class="container descript">
									<span class="cabour" data-timeleft="'.$diff.'"></span>
								</div>
							</div>
						</a>
					</div>

				';
			}
		}
		
		
		
		public function seeall(){
			$sql="SELECT * from bid, article WHERE article_idarticle=idarticle AND sold=0 ORDER BY enddateexpected asc";
			$contenu = Connexion::getInstance()->prepare($sql); //on stock dans une variable, on appel la class connexion et sa fonction getInstance, query lance l'intérogation de la BDD ($sql) 
			$contenu->execute();
			
			
			while( $rows = $contenu->fetch() ) { // récuperation tableau bdd
				$bidid=$rows["idbid"];
				$title=$rows["title"];
				$picture=$rows["picture"];
				$category=$rows["category"];
				$pricestart = $rows["pricing"];
				$priceadd = $rows["pricesold"];

				if ($priceadd == 0) {
					$afficheprix='Prix : '.$pricestart.' €';
				}else{
					$afficheprix='Prix : '.$priceadd.' €';
				}
				
				$diff=$this->prepcountdown($bidid);
				
				echo '
				
					<div class="col-md-5 toutvoir '.$category.'">
						<a href="enchere.php?id='.$bidid.'">
							<div class="tuiles">
								<div class="imgt">
									<img class="img" src="'.$picture.'"></img>
								</div>
								<div class="container descript">
									<p>'.$title.'</p>
								</div>
								<div class="container descript">
									<p>'.$afficheprix.'</p>
								</div>
								<div class="container descript">
									<span class="cabour" data-timeleft="'.$diff.'"></span>
								</div>
							</div>
						</a>
					</div>

				';
			}
		}
		
		public function bidtitle($bidid){
			$sql="SELECT * from bid, article WHERE idbid='$bidid' AND article_idarticle=idarticle";
			$contenu = Connexion::getInstance()->prepare($sql); //on stock dans une variable, on appel la class connexion et sa fonction getInstance, query lance l'intérogation de la BDD ($sql) 
			$contenu->execute();
			$rows = $contenu->fetch();
			
			
			echo' <h2>Enchère n°'.$rows["idbid"].':'.$rows["title"].'</h2> ';
		}
		
		public function bidcountdown($bidid){
			
			$diff=$this->prepcountdown($bidid);
			if($diff > 0){
				echo '	<div>	
							<script  type="text/javascript">rebour('.$diff.','.$bidid.');</script>
						</div>
					';	
			}else{
				//$addwinner = $this->addwinner($bidid);
				
				echo'
					<div>
						<p>Enchère terminée</p>
					</div>
				';
			}
				
		}
		
		public function bidseeproposal($bidid) {
            $sql="SELECT * FROM users, proposal WHERE bid_idbid='$bidid' AND users_idusers=idusers ORDER BY price desc LIMIT 10";
            $contenu = Connexion::getInstance()->prepare($sql); //on stock dans une variable, on appel la class connexion et sa fonction getInstance, query lance l'intérogation de la BDD ($sql) 
            $contenu->execute();


            while( $rows = $contenu->fetch() ) { // récuperation tableau bdd
                $user=$rows["firstname"];
                $price=$rows["price"];
                $date=$rows["date"];
                echo '<div>'.$user.', '.$price.', '.$date.' </div>';
            }

        }

		public function bidcountchange($bidid) {
			$diff=$this->prepcountdown($bidid);
			if($diff > 0){
				echo '
					<div data-timeleft="'.$diff.'">
						<form method="post" id="register-form" name="register-form" class="well">	
							<div class="form-group">
								<label> Enchérir <span class="asterisque">*</span></label>
								<input class="form-control required" type="text" name="proprice" id="proprice" required/>
							</div>
							<div class="form-group">	
								<input type="submit" id="submit" name="submit"  class="btn btn-warning"/>
							</div>
						</form>
					</div>
				';
			}else{
				$sql="SELECT * from bid WHERE idbid='$bidid'";
				$contenu = Connexion::getInstance()->prepare($sql); //on stock dans une variable, on appel la class connexion et sa fonction getInstance, query lance l'intérogation de la BDD ($sql) 
				$contenu->execute();
				$rows = $contenu->fetch();
				$winner = $rows["winner"];
				
				echo'
					<div class="col-md-4">
						<h2>'.$winner.'</h2>
					</div>
				';
				
				$sql2 = "UPDATE article, bid SET sold=1 WHERE idarticle=article_idarticle AND idbid = '$bidid'";
				$contenu4 = Connexion::getInstance()->prepare($sql2); 
				$contenu4->execute();
				
			}
		}
	
		public function bidprice($bidid){
			$sql="SELECT * from bid, article WHERE idbid='$bidid' AND article_idarticle=idarticle";
			$contenu = Connexion::getInstance()->prepare($sql); //on stock dans une variable, on appel la class connexion et sa fonction getInstance, query lance l'intérogation de la BDD ($sql) 
			$contenu->execute();
			$rows = $contenu->fetch();
			$datelimit = $rows["enddateexpected"];
			$pricestart = $rows["pricing"];
			$priceadd = $rows["pricesold"];
			
			if ($priceadd == 0) {
				echo '<h4>Prix : '.$pricestart.' €</h4> ';
			}else{
				echo '<h4>Prix : '.$priceadd.' €</h4> ';
			}	
			echo'<h4>Date limite : '.$datelimit.'</h4>';
		}
		

		public function bidpicture($bidid){
			$sql="SELECT * from bid, article WHERE idbid='$bidid' AND article_idarticle=idarticle";
			$contenu = Connexion::getInstance()->prepare($sql); //on stock dans une variable, on appel la class connexion et sa fonction getInstance, query lance l'intérogation de la BDD ($sql) 
			$contenu->execute();
			$rows = $contenu->fetch();
			
			
			echo' <img src="'.$rows["picture"].'" width="300vw"></img> ';
		}

		public function biddescription($bidid){
			$sql="SELECT * from bid, article WHERE idbid='$bidid' AND article_idarticle=idarticle";
			$contenu = Connexion::getInstance()->prepare($sql); //on stock dans une variable, on appel la class connexion et sa fonction getInstance, query lance l'intérogation de la BDD ($sql) 
			$contenu->execute();
			$rows = $contenu->fetch();
			
			
			echo' <p>'.$rows["description"].'</p> ';
		}
		
		
		
		public function addproposal($bidid, $id) {

            $recupid = $this->recupid($id);
            
            if ($recupid != NULL){
                $controle = "SELECT pricesold from bid WHERE idbid='$bidid' AND pricesold >= '".$_POST["proprice"]."'";
                $contenu = Connexion::getInstance()->prepare($controle); //on stock dans une variable, on appel la class connexion et sa fonction getInstance, query lance l'intérogation de la BDD ($sql) 
                $contenu->execute();
                $com = $contenu->fetchall();
                $compte=count($com);


                if ($compte > 0) {
                    echo'<script>alert("Le montant que vous avez entré a déjà été proposé. Veuillez entrer un montant suppérieur à '.$_POST["proprice"].'");</script>';
                }else{

                    $today =  date("Y-m-d H:i:s");
                    $sql = "INSERT INTO proposal (idproposal, price, date, bid_idbid, users_idusers) VALUES ('', '".$_POST["proprice"]."', '".$today."', '".$bidid."', '".$recupid."')";
                    $contenu = Connexion::getInstance()->prepare($sql); //on stock dans une variable, on appel la class connexion et sa fonction getInstance, query lance l'intérogation de la BDD ($sql) 
                    $contenu->execute();
                    $recuprice = $this->recuprice($bidid);
                    $closeprice = $this ->closeprice($bidid);
                }
            }else {
                echo'Veuillez vous connecter';
            }
        }
		
		
		public function recupInsertMdp($id){    //On définie une fonction ayant pour role de renvoyer un mdp si oublié.
			
			$retour = array("error" => true); // on verifie dans le tableau si la valeur est vraie
			$oldmdp = $_POST["oldmdp"];
			$newmdp = $_POST["newmdp"];
			$newmdp2 = $_POST["newmdp2"];
			
			
			$sql = "SELECT * FROM users WHERE mail = '$id'"; // Requête que l'on va envoyer à la base de donnée.
			//$result = mysqli_query($this->conn, $sql); //Envoi de la requête qu'on stock dans la variable result
			//$resultarr = mysqli_fetch_array($result); //On converti le résultat de "result" sous forme de tableau pour faciliter la récolte d'information.
			$contenu = Connexion::getInstance()->prepare($sql); //on stock dans une variable, on appel la class connexion et sa fonction getInstance, query lance l'intérogation de la BDD ($sql) 
			$contenu->execute();
			$com = $contenu->fetchall();

			$contenu->execute();
			$result = $contenu->fetch(); //On stock dans result le contenu sous forme de tableau.
			
			$compte=count($com); //On stock dans compte, le comptage des colonnes généré.
			
			if ($compte > 0) {  // Si le résultat de notre requête nous retourne au moins un élément alors exécuter la suite.
				if ($result['password'] != $this->crypt_password($oldmdp)){ // On vérifie que le mot de passe du champs "pass" est différent du mot de passe crypté entré par l'utilisateur.
					echo "mot de passe incorrect";
				}else{
					$passfinal = $this->crypt_password($newmdp);
					$sql2 = "UPDATE users SET password='$passfinal', password2='$newmdp' WHERE mail = '$id'";
					$contenu2 = Connexion::getInstance()->prepare($sql2); //on stock dans une variable, on appel la class connexion et sa fonction getInstance, query lance l'intérogation de la BDD ($sql) 
					$contenu2->execute();
				}
				
			}

		}
		
		public function newtoken2($mail, $name){

			
			$token=$this->chaine_aleatoire(10);
			$token=$this->cryptstamp($token);//on réutilise le cryptage du timestamp puisqu'il ne contient
			//pas de caractère spéciaux et que sa longueur est sécurisante.
			//$token = $token.'$'.date("Y-m-d");
			$timestamp = date_create(); //On créer une date (d'aujourd'hui) que l'on stock dans la variable timestamp.
			$timestamp = date_timestamp_get($timestamp); 
			/*
				Envoyer le timestamp dans la colonne sans cryptage
			*/
			$cryptstamp = $this->cryptstamp($timestamp);
			//echo ($timestamp).'<br>';
			//echo ($cryptstamp);
			//die();
			$sql = "UPDATE users SET token='$token', timestamp='$timestamp' WHERE mail = '$mail'";
			$contenu = Connexion::getInstance()->prepare($sql); //on stock dans une variable, on appel la class connexion et sa fonction getInstance, query lance l'intérogation de la BDD ($sql) 
			$contenu->execute();
			$lien = 'http://jean-patrick-enchere.alwaysdata.net/enchereamateur/confirm.php?m='.$token.'&j='.$cryptstamp.'';
			$mailto = $this->sendMailRegister($name,$mail,$lien);
				

		}
		
		public function veriftoken2($token,$timestamp){
			$verif = "SELECT * FROM users WHERE token = '$token' AND active='0'";
			$contenu = Connexion::getInstance()->prepare($verif);
			$contenu->execute();
			$com = $contenu->fetchall();
			$compte=count($com);
			
			if ($compte > 0) {
				$contenu->execute();
				$rows = $contenu->fetch();
				$verifstamp = $rows['timestamp'];
				$verifcryptstamp = $this->cryptstamp($verifstamp);
				if($verifcryptstamp == $timestamp){
					$nowstamp = date_create();
					$nowstamp = date_timestamp_get($nowstamp);
					$diff = $nowstamp - $verifstamp;
					if($diff > 604800) {
						$sql = "DELETE FROM users WHERE token = '$token' AND timestamp = '$timestamp' AND active='0'"; 
						$contenu = Connexion::getInstance()->prepare($sql);
						$contenu->execute();
						
						$pls = "OPTIMIZE TABLE users";
						$contenu = Connexion::getInstance()->prepare($pls);
						$contenu->execute();
						
						header ('location:./index.php?message=Délai expiré');
					}else{
						$sql = "UPDATE users SET active='1', token='', timestamp='' WHERE token = '$token'";
						$contenu = Connexion::getInstance()->prepare($sql);
						$contenu->execute();
						header ('location:./index.php?message=Compte activé');
					}
				}else{
					header ('location:./index.php?message=Délai expiré');
				}	
			}else{
				header ('location:./index.php?message=Lien non valide');
			}
			return $retour;
		}
		
		

		public function newtoken($recup){
			$verif = "SELECT 'mail' FROM users WHERE mail = '$recup'";
			$contenu = Connexion::getInstance()->prepare($verif);
			$contenu->execute();
			$com = $contenu->fetchall();
			$compte=count($com);
			
			
			if ($compte > 0) {  // Si le résultat de notre requête nous retourne au moins un élément alors exécuter la suite.
			
				$token=$this->chaine_aleatoire(10);
				$token=$this->cryptstamp($token);//on réutilise le cryptage du timestamp puisqu'il ne contient
				//pas de caractère spéciaux et que sa longueur est sécurisante.
				//$token = $token.'$'.date("Y-m-d");
				$timestamp = date_create(); //On créer une date (d'aujourd'hui) que l'on stock dans la variable timestamp.
				$timestamp = date_timestamp_get($timestamp); 
				/*
					Envoyer le timestamp dans la colonne sans cryptage
				*/
				$cryptstamp = $this->cryptstamp($timestamp);
				//echo ($timestamp).'<br>';
				//echo ($cryptstamp);
				//die();
				$sql = "UPDATE users SET token='$token', timestamp='$timestamp' WHERE mail = '$recup'";
				$contenu = Connexion::getInstance()->prepare($sql); //on stock dans une variable, on appel la class connexion et sa fonction getInstance, query lance l'intérogation de la BDD ($sql) 
				$contenu->execute();
				$lien = 'http://jean-patrick-enchere.alwaysdata.net/enchereamateur/lostmdp.php?m='.$token.'&j='.$cryptstamp.'';
				$mailto = $this->sendMailRecup($recup,$lien);
				$retour["message"] = "Un lien de réinitialisation a été envoyé dans votre boîte de réception.";
		        $retour["return"] = "location:../recupmail.php";
				
				
			}else {
				$retour["message"] = "Cet email n'existe pas";
		        $retour["return"] = "location:../recupmail.php";
			}

			return $retour;
		}
		
		public function veriftoken($token,$timestamp){
			$verif = "SELECT * FROM users WHERE token = '$token'";
			$contenu = Connexion::getInstance()->prepare($verif);
			$contenu->execute();
			$com = $contenu->fetchall();
			$compte=count($com);
			
			if ($compte > 0) {
				$contenu->execute();
				$rows = $contenu->fetch();
				$verifstamp = $rows['timestamp'];
				$verifcryptstamp = $this->cryptstamp($verifstamp);
				if($verifcryptstamp == $timestamp){
					$nowstamp = date_create();
					$nowstamp = date_timestamp_get($nowstamp);
					$diff = $nowstamp - $verifstamp;
					if($diff > 86400) {
						$sql = "UPDATE users SET token='', timestamp='' WHERE token = '$token'"; 
						$contenu = Connexion::getInstance()->prepare($sql);
						$contenu->execute();
						header ('location:./index.php?message=Délai expiré');
					}
				}else{
					header ('location:./index.php?message=Délai expiré');
				}	
			}else{
				header ('location:./index.php?message=Lien non valide');
			}
			return $retour;
		}

		public function recupmdplost($token){
			$newmdp=$_POST['newmdp'];
			$newmdp2=$_POST['newmdp2'];
			if ($newmdp == $newmdp2) {
				$passfinal=$this->crypt_password($newmdp);
				$sql = "UPDATE users SET password='$passfinal' WHERE token = '$token'"; // Mise a jour du mdp crypté dans la bdd
				$contenu = Connexion::getInstance()->prepare($sql);
				$contenu->execute();
				
				$sql2= "UPDATE users SET token='', timestamp='' WHERE token = '$token'"; 
				$contenu = Connexion::getInstance()->prepare($sql2);
				$contenu->execute();
				header ('location:./index.php?message=Votre mot de passe a été modifié');
				
			} else {
				echo ('<script>alert("Les mots de passes ne correspondent pas.");</script>');
			}
		}
		
		
		
		
		public function changeinfo($id){    //On définie une fonction ayant pour role de renvoyer un mdp si oublié.
			
			$retour = array("error" => true); // on verifie dans le tableau si la valeur est vraie
			$name = $_POST["name"];
			$firstname = $_POST["firstname"];
			$adress = $_POST["adress"];
			$zipcode = $_POST["zipcode"];
			$city = $_POST["city"];
			$phone = $_POST["phone"];
			
		
			$sql = "UPDATE users SET name='$name', firstname='$firstname', adress='$adress', zipcode='$zipcode', city='$city', phone='$phone' WHERE mail = '$id'";
			$contenu = Connexion::getInstance()->prepare($sql); //on stock dans une variable, on appel la class connexion et sa fonction getInstance, query lance l'intérogation de la BDD ($sql) 
			$contenu->execute();
				

		}
		
		public function contactmail($name,$firstname,$mail,$phone,$msg){
			
			$destinataire = 'manfrenc2@gmail.com,chahbouni@hotmail.com'; // mais qui va recevoir le mail de "contact"
			// Pour les champs $expediteur / $copie / $destinataire, séparer par une virgule s'il y a plusieurs adresses
			$expediteur = 'jean-patrick-enchere@alwaysdata.net'; // adresse mail du site
			//$copie = 'adresse@fai.com'; //Si besoin d'une deuxiemme adresse
			//$copie_cachee = 'adresse@fai.com';
			$objet = 'Commentaire de '.'   ' . ' ' .$name. ' ' .$firstname; // Objet du message
			$headers  = 'MIME-Version: 1.0' . "\n"; // Version MIME
			$headers .= 'Reply-To: '.$mail."\n"; // Mail de reponse
			$headers .= 'From: "'.$name.' '.$firstname.'"<'.$mail.'>'."\n"; // Expediteur
			$headers .= 'Delivered-to: '.$destinataire."\n"; // Destinataire     
			$message = 'Bonjour'."\n\n"; //Debut du message. Les "\n\n" servent à revenir à la ligne.
			$message .= 'Vous avez reçu ce message de la part de :'.' '.$name.' '.$firstname."\n\n";
			$message .= 'Message recu:'."\n\n".$msg."\n\n";
			$message .= 'Le joindre par téléphone:'.' '.$phone;
			
			if (mail($destinataire, $objet, $message, $headers)) // si il y a envoi du message
			{
				header ('location:./index.php?message=Votre message a été envoyé');
			}
		}
		



		/************************************ Function private ************************************************/

		
		private function sendMailRegister($name, $mail, $lien){    // On définie une fonction ayant pour rôle de faire un mail suite à l'inscription. 
				//$destinataire = 'manfrenc2@gmail.com'; // pour test, a enlever en prod.
				// Pour les champs $expediteur / $copie / $destinataire, séparer par une virgule s'il y a plusieurs adresses
				$destinataire = $mail;
				$expediteur = 'jean-patrick-enchere@alwaysdata.net';
				//$copie = 'adresse@fai.com';
				//$copie_cachee = 'adresse@fai.com';
				$objet = 'Confirmation de votre inscription'; // Objet du message
				$headers  = 'MIME-Version: 1.0' . "\n"; // Version MIME
				$headers .= 'Reply-To: '.$expediteur."\n"; // Mail de reponse
				$headers .= 'From: <'.$expediteur.'>'."\n"; // Expediteur
				$headers .= 'Delivered-to: '.$destinataire."\n"; // Destinataire
				// $headers .= 'Cc: '.$copie."\n"; // Copie Cc
				// $headers .= 'Bcc: '.$copie_cachee."\n\n"; // Copie cachée Bcc        
			    $message = 'Bonjour M.'.$name ."\n\n";
			    $message .= 'Merci de votre inscription sur notre site.' ."\n\n";
				$message .= "Afin d'activer votre compte, merci de cliquer sur le lien suivant :"."\n\n";
				$message .= $lien."\n\n";
				$message .= 'Ce message est une notification automatique. Merci de ne pas y répondre (votre message ne sera pas traité).'."\n\n";
				$message .= 'Cordialement, l\'équipe enchereamateur';
		  
		    if (mail($destinataire, $objet, $message, $headers)){
		    	return true;
		    } else {
		      	return false;
		    }
		}


		private function sendMailRecup($recup,$lien){ // On définie une fonction ayant pour rôle de faire un mail mdp perdu.
				$destinataire = $recup;
				$expediteur = 'jean-patrick-enchere@alwaysdata.net';

				$objet = 'Mot de passe enchereamateur perdu :' ;
				$headers  = 'MIME-Version: 1.0' . "\n";
				$headers .= 'Reply-To: '.$expediteur."\n";
				$headers .= 'From: <'.$expediteur.'>'."\n";
				$headers .= 'Delivered-to: '.$destinataire."\n";

			    $message = 'Cher client'."\n\n";
			    $message .= 'Veuillez cliquer sur le lien ci-dessous pour finaliser la modification du mot de passe.' ."\n\n";
				$message .= $lien."\n\n";
				$message .= 'Si 24 heures se sont écoulées depuis la réception de cet Email, vous ne pouvez plus modifier votre mot de passe via ce lien.'."\n\n";				
				$message .= 'Ce message est une notification automatique. Merci de ne pas y répondre (votre message ne sera pas traité).'."\n\n";				
				$message .= 'Cordialement, l\'équipe enchereamateur';
		  
		    if (mail($destinataire, $objet, $message, $headers)){
		    	return true;
		    } else {
		      	return false;
		    }
		}

		private function crypt_password($mdp){    //On définie une fonction ayant pour rôle de crypter le mdp.
			$arr = str_split($mdp);  //On définie une variable $arr qui récupère le mot de passe aléatoire et le découpe en caractères pour l'affecter à un tableau.
			$passwordFinal = "1";
			foreach($arr as $row){ //Recopier chaque case du tableau

				$passwordFinal .= (ord($row))*2;
				$passwordFinal .= hash('gost', $passwordFinal);
				$passwordFinal = hash('whirlpool', $passwordFinal);
				$passwordFinal .= hash('sha512', $passwordFinal);
				$passwordFinal .= "*/*$".$passwordFinal."+-+".$passwordFinal."%!?";
				$passwordFinal = hash('md4', $passwordFinal);
			}
			return $passwordFinal;
		}

		private function cryptstamp($timestamp){    //On définie une fonction ayant pour rôle de crypter le mdp.
			$arr = str_split($timestamp);  //On définie une variable $arr qui récupère le mot de passe aléatoire et le découpe en caractères pour l'affecter à un tableau.
			$cryptstamp = "1";
			foreach($arr as $row){ //Recopier chaque case du tableau

				$cryptstamp .= (ord($row))*2;
				$cryptstamp .= hash('gost', $cryptstamp);
				$cryptstamp = hash('whirlpool', $cryptstamp);
				$cryptstamp .= hash('sha512', $cryptstamp);
				$cryptstamp = hash('md4', $cryptstamp);
			}
			return $cryptstamp;
		}



	    private function chaine_aleatoire($nb_car = 10, $chaine = 'azertyuiopqsdfghjklmwxcvbn123456789'){ //On définie une fonction ayant pour rôle de créé un mdp aléatoire.
	      $nb_lettres = strlen($chaine) - 1;
	      $generation = '';
	      for($i=0; $i < $nb_car; $i++)
	      {
	          $pos = mt_rand(0, $nb_lettres);
	          $car = $chaine[$pos];
	          $generation .= $car;
	      }
	      return $generation;
	    }
		
		private function recupid($id) { // Recuperation ID utilisateur dans la BDD
			$sql2 = "SELECT * from users WHERE  `mail` = '$id'"; // Recherche de l'id utilisateur correspondant au mail.
			$contenu = Connexion::getInstance()->prepare($sql2); //on stock dans une variable, on appel la class connexion et sa fonction getInstance, query lance l'intérogation de la BDD ($sql2) 
			$contenu->execute();
			$rows = $contenu->fetch(); // sert à récupérer la réponse de la requete
			$iduser = $rows["idusers"]; // on stock l'id dans une variable.
			return $iduser;	// retourne la variable.
		}
		
		private function recuprice($bidid) {
            $sql = "SELECT * FROM proposal WHERE bid_idbid = '$bidid' ORDER BY price desc, date asc LIMIT 1";
            $contenu = Connexion::getInstance()->prepare($sql); //on stock dans une variable, on appel la class connexion et sa fonction getInstance, query lance l'intérogation de la BDD ($sql2) 
            $contenu->execute();
            $rows = $contenu->fetch();
            $iduser = $rows['users_idusers'];
			$newprice = $rows['price'];
			
			$sql2 = "SELECT * FROM users WHERE idusers = '$iduser'";
			$contenu = Connexion::getInstance()->prepare($sql2); //on stock dans une variable, on appel la class connexion et sa fonction getInstance, query lance l'intérogation de la BDD ($sql2) 
            $contenu->execute();
			$rows = $contenu->fetch();
			$firstname = $rows['firstname'];

            $sql3 = "UPDATE bid SET pricesold='$newprice', users_idwinner='$iduser', winner='$firstname' WHERE idbid = '$bidid'";
            $contenu2 = Connexion::getInstance()->prepare($sql3); //on stock dans une variable, on appel la class connexion et sa fonction getInstance, query lance l'intérogation de la BDD ($sql2) 
            $contenu2->execute();

		}
		
		private function closeprice($bidid) {
			$sql ="SELECT * from bid WHERE idbid='$bidid'";
			$contenu = Connexion::getInstance()->prepare($sql); //on stock dans une variable, on appel la class connexion et sa fonction getInstance, query lance l'intérogation de la BDD ($sql2) 
            $contenu->execute();
			$rows = $contenu->fetch();
			$pricefinal = $rows["pricefinal"];
			$pricesold = $rows["pricesold"];

			
			if ($pricesold >= $pricefinal) {
				$today =  date("Y-m-d H:i:s");
				$sql = "UPDATE bid SET enddateeffective='$today' WHERE idbid='$bidid'";
                $contenu = Connexion::getInstance()->prepare($sql); 
                $contenu->execute();

			}
		
				
			
		}
		
		private function prepcountdown($bidid) {
			
			
			$sql="SELECT * from bid WHERE idbid='$bidid'";
			$contenu = Connexion::getInstance()->prepare($sql); //on stock dans une variable, on appel la class connexion et sa fonction getInstance, query lance l'intérogation de la BDD ($sql) 
			$contenu->execute();
			$rows = $contenu->fetch();
			if ($rows["enddateeffective"] > 0) {
				$diff= 0;
				return $diff;
			}else{
			
				$datefin = new DateTime ($rows["enddateexpected"]);
				$date = new DateTime();
				
				$diff = $datefin->getTimestamp() - $date->getTimestamp();
				$diff = ($diff<0)?0:$diff; // Si $diff est negatif alors remplacer par 0
				return $diff;
			}
		}
		
		/*private function addwinner($bidid) {
			$sql = "SELECT firstname FROM users,bid WHERE 'idbid'='$bidid' AND 'user_idwinner'='idusers'";
            $contenu = Connexion::getInstance()->prepare($sql); //on stock dans une variable, on appel la class connexion et sa fonction getInstance, query lance l'intérogation de la BDD ($sql2) 
            $contenu->execute();
			$rows = $contenu->fetch();
			
			$sql2 = "UPDATE bid SET winner='$rows' WHERE idbid = '$bidid'";
			$contenu = Connexion::getInstance()->prepare($sql2); //on stock dans une variable, on appel la class connexion et sa fonction getInstance, query lance l'intérogation de la BDD ($sql2) 
            $contenu->execute();
		}*/
		
		
		public function debug($data){    //On définie une fonction ayant pour rôle afficher les erreurs php dans la console.
			if ( is_array( $data ) )
				$output = "<script>console.log( 'Debug Objects: " . implode( ',', $data) . "' );</script>";
			else
				$output = "<script>console.log( 'Debug Objects: " . $data . "' );</script>";

			echo $output;
		}
		
		/*function __destruct() { //fonction qui s'executera automatiquement en conclusion lorsque la méthode de l'objet est appelée.
			//mysqli_close($this->conn);
			$conn = null;
		}*/
	}