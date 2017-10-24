<?php

	include_once('../include/dbconnexion.php');
	
    class crud {

        /*private $host = "localhost"; // var host = "localhost";
        private $user = "root"; // var user = "root";
        private $password = ""; // var password = "";
        private $database = "artamateur"; // var database = "mydb";
        private $conn = null;

        function __construct() { // fonction qui s'executera automatiquement en introduction lorsque la méthode de l'objet sera appelée.
            $this->conn = mysqli_connect($this->host, $this->user, $this->password, $this->database); // variable de connexion à la db
            mysqli_set_charset($this->conn,"utf8"); // prise en charge des caractères spéciaux
			if (! $this->conn) 
                die("Error 502 - ".mysqli_connect_errno());
            return $this->conn; // on retourne la variable $conn une fois que la fonction est executée.
        }*/

		public function verifadmin($id) {

			$sql = "SELECT * from users WHERE mail='$id'";
			$contenu = Connexion::getInstance()->prepare($sql);
		 	$contenu->execute();
		 	$result = $contenu->fetch();
		 	$admin = $result['admin'];
		 	if ($admin == 0){
		 		header('location: ../index.php');
		 	}

		}


		public function clearnoactif() {
		 	$verif = "SELECT * FROM users WHERE active='0'";
		 	$contenu = Connexion::getInstance()->prepare($verif);
		 	$contenu->execute();
			$result = $contenu->fetchall();
			foreach($result as $rows) {
				
				$idusers = $rows['idusers'];
				$verifstamp = $rows['timestamp'];
				$nowstamp = date_create();
				$nowstamp = date_timestamp_get($nowstamp);
				$diff = $nowstamp - $verifstamp;
				
				if($diff > 604800) {
					$sql = "DELETE FROM users WHERE idusers='$idusers' AND active='0'"; 
					$contenu = Connexion::getInstance()->prepare($sql);
					$contenu->execute();
				}
			}
		}
	
        public function update(){ // fonction de mise à jour table stagiaire
            $sql = "UPDATE users 
			SET name= '".$_POST["nom"]."',firstname='".$_POST["prenom"]."',adress='".$_POST["adress"]."',zipcode='".$_POST["zipcode"]."',city='".$_POST["city"]."',phone='".$_POST["phone"]."',mail='".$_POST["mail"]."',admin='".$_POST["admin"]."'
			WHERE idusers = '".$_POST["idu"]."'"; // Requête que l'on souhaite envoyer à la base de donnée.
            $contenu = Connexion::getInstance()->prepare($sql); //on stock dans une variable, on appel la class connexion et sa fonction getInstance, query lance l'intérogation de la BDD ($sql) 
			$contenu->execute();
			
			//var_dump($sql);
			//mysqli_query($this->conn, $sql); // on envoie la requête pour qu'elle soit exécutée.
            // var_dump(mysqli_query($this->conn, $sql));
        }
        public function delete(){ //fonction de suppression table stagiaire
            
            $pls = "DELETE FROM users WHERE idusers = '".$_POST["idu"]."'"; // Requête que l'on souhaite envoyer à la base de donnée.
            $contenu = Connexion::getInstance()->prepare($pls); //on stock dans une variable, on appel la class connexion et sa fonction getInstance, query lance l'intérogation de la BDD ($sql) 
			$contenu->execute();
			
			//mysqli_query($this->conn, $pls); // on envoie la requête pour qu'elle soit exécutée.
            
        }


        public function lire() { //fonction pour afficher la table stagiaire

			$sql="SELECT * from users";
			$contenu = Connexion::getInstance()->prepare($sql); //on stock dans une variable, on appel la class connexion et sa fonction getInstance, query lance l'intérogation de la BDD ($sql) 
			$contenu->execute();
			//$resultset = $contenu->fetch();
			
			//$resultset = mysqli_query($this->conn, $sql);
			while( $rows = $contenu->fetch() ) { // récuperation tableau bdd
				$idu=$rows["idusers"];
				$name=$rows["name"];
				$firstname=$rows["firstname"];
				$adress=$rows["adress"];
				$zipcode=$rows["zipcode"];
				$city=$rows["city"];
				$phone=$rows["phone"];
				$mail=$rows["mail"];
				$admin=$rows["admin"];
				
				echo '
				
						<tr>
							<td><input type="text" size="1" id="idu['.$idu.']" name="idu" value="'.$idu.'"/></td>
							<td><input type="text" id="nom['.$idu.']" name="nom" value="'.$name.'"/></td>
							<td><input type="text" id="prenom['.$idu.']" name="prenom" value="'.$firstname.'"/></td>
							<td><input type="text" id="adress['.$idu.']" name="adress" value="'.$adress.'"/></td>
							<td><input type="text" id="zipcode['.$idu.']" name="zipcode" value="'.$zipcode.'"/></td>
							<td><input type="text" id="city['.$idu.']" name="city" value="'.$city.'"/></td>
							<td><input type="text" id="phone['.$idu.']" size="10" name="phone" value="'.$phone.'"/></td>
							<td><input type="text" id="mail['.$idu.']" name="mail" value="'.$mail.'"/></td>
							<td><input type="text" id="admin['.$idu.']" size="1" name="admin" value="'.$admin.'"/></td>
							<td>
								<input type="submit" id="update" name="update" value="Update" class="btn btn-success crud-update"> 
								<input type="submit" name="delete" value="Delete" class="btn btn-danger crud-delete"> 
							</td>
						</tr>

					';	
					
			}}
			
		
		public function lire2() { //fonction pour afficher la table stagiaire

			$sql="SELECT * from article";
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
							<td><input type="text" size="1" name="idarticle" value="'.$ida.'"/></td>
							<td><input type="text" name="titre" value="'.$title.'"/></td>
							<td><input type="text" name="description" value="'.$description.'"/></td>
							<td><input type="text" name="stock" value="'.$stock.'"/></td>
							<td><input type="text" name="categorie" value="'.$category.'"/></td>
							<td><input type="text" name="valide" value="'.$visible.'"/></td>

							<td style="display: flex;">
							    <input type="submit" name="update2" value="Update" class="btn btn-success crud-update2"> &nbsp
    							<input type="submit" name="delete2" value="Delete" class="btn btn-danger crud-delete2">
							</td>
						</tr>

					';	
					
			}}
			
			public function lire3() { //fonction pour afficher la table stagiaire

			$sql="SELECT * from bid";
			$contenu = Connexion::getInstance()->prepare($sql); //on stock dans une variable, on appel la class connexion et sa fonction getInstance, query lance l'intérogation de la BDD ($sql) 
			$contenu->execute();
			//$resultset = mysqli_query($this->conn, $sql);
			while( $rows = $contenu->fetch() ) { // récuperation tableau bdd
				$idb=$rows["idbid"];
				$startdate=$rows["startdate"];
				$enddateexpected=$rows["enddateexpected"];
				$pricing=$rows["pricing"];
				$pricefinal=$rows["pricefinal"];
				$enddateeffective=$rows["enddateeffective"];
				$winner=$rows["winner"];
				$creationdate=$rows["creationdate"];
				$idarticle=$rows["article_idarticle"];
				$idwinner=$rows["users_idwinner"];
				
				echo '
				
						<tr>
							<td><input hidden type="text" size="1" name="idbid" value="'.$idb.'"/>'.$idb.'</td>
							<td>'.$startdate.'</td>
							<td>'.$enddateexpected.'</td>
							<td>'.$pricing.'</td>
							<td>'.$pricefinal.'</td>
							<td>'.$enddateeffective.'</td>
							<td>'.$winner.'</td>
							<td>'.$creationdate.'</td>
							<td>'.$idarticle.'</td>
							<td>'.$idwinner.'</td>

							<td style="display: flex;">
    							<input type="submit" name="delete3" value="Delete" class="btn btn-danger crud-delete3">
							</td>
						</tr>

					';	
					
			}}
			


			/*echo'
								<form action="" method="POST">
									<tr>
										<td><input class="none" type="text" name="idarticle" value="'.$row["idarticle"].'"  /></td>
										<td><input class="none" type="text" name="titre" value="'.$row["title"].'" /></td>
										<td><input class="none" type="text" name="description" value="'.$row["description"].'" /></td>
										<td><input class="none" type="text" name="prix" value="'.$row["price"].'" /></td>
										<td><input class="none" type="text" name="stock" value="'.$row["stock"].'" /></td>
										<td><input class="none" type="text" name="categorie" value="'.$row["category"].'" /></td>
										<td><input class="none" type="text" name="valide" value="'.$row["visible"].'" /></td>
										<td style="display: flex;">
											<input type="submit" name="update2" value="Update" class="btn btn-success" href=""> &nbsp
											<input type="submit" name="delete2" value="Delete" class="btn btn-danger" href="">  
										</td>      
									</tr>
								</form>';*/

		
			/*$sql="SELECT * from users";
			$resultset = mysqli_query($this->conn, $sql);
			while( $rows = mysqli_fetch_assoc($resultset) ) {
				$idu=$rows["idusers"];
				$name=$rows["name"];
				$firstname=$rows["firstname"];
				$adress=$rows["adress"];
				$zipcode=$rows["zipcode"];
				$city=$rows["city"];
				$phone=$rows["phone"];
				$mail=$rows["mail"];
				$admin=$rows["admin"];
				
				echo "
					<tr>
						<td>$idu</td>
						<td>$name</td>
						<td>$firstname</td>
						<td>$adress</td>
						<td>$zipcode</td>
						<td>$city</td>
						<td>$phone</td>
						<td>$mail</td>
						<td>$admin</td>
						
						
					</tr>";
					
					
					
			}*/
			
			/*$sql = "SELECT idusers as Ref,name as Nom,firstname as Prenom,adress as Adresse,zipcode as Code_postal,city as Ville,phone as Telephone,mail as Mail,admin as Admin FROM users";
			$resultset = mysqli_query($this->conn, $sql);
			$data = array();
			while( $rows = mysqli_fetch_assoc($resultset) ) {
				$data[] = $rows;
			}

			$results = array(
				'sEcho' => 1,
			'iTotalRecords' => count($data),
			'iTotalDisplayRecords' => count($data),
			  'aaData'=>$data);

			echo json_encode($results);
			exit;*/
			
		
		
		
			/*if(isset($test)){
				$sql = "SELECT * FROM users ORDER BY ".$test."";
			}else{
				$sql =  "SELECT * FROM users"; //La variable $sql stocke toutes les colonnes de la table client.
			}
				$result = mysqli_query($this->conn, $sql);  // On récupère le résultat de la commande entrée.
				if(mysqli_num_rows($result) > 0) { // On vérifie que dans le résultat il y a des éléments présents.                                
					while($row = mysqli_fetch_assoc($result)) { 
						echo'

							<form action="" method="POST">
								<tr>
									<td><input class="none" type="text" name="id" value="'.$row["idusers"].'" readonly/></td>
									<td><input class="none" type="text" name="nom" value="'.$row["name"].'" /></td>
									<td><input class="none" type="text" name="prenom" value="'.$row["firstname"].'" /></td>
									<td><input class="none" type="text" name="adress" value="'.$row["adress"].'" /></td>
									<td><input class="none" type="text" name="zipcode" value="'.$row["zipcode"].'" /></td>
									<td><input class="none" type="text" name="city" value="'.$row["city"].'" /></td>
									<td><input class="none" type="text" name="phone" value="'.$row["phone"].'" /></td>
									<td><input class="none" type="text" name="mail" value="'.$row["mail"].'" /></td>
									<td><input class="none" type="text" name="admin" value="'.$row["admin"].'" /></td>
									<td style="display: flex;">
										<input type="submit" name="update" value="Update" class="btn btn-success" href=""> &nbsp
										<input type="submit" name="delete" value="Delete" class="btn btn-danger" href="">  
									</td>
									
								</tr>
							</form>';
					}
				}*/
        
		

		
		public function update2(){ // fonction de mise à jour table stage
            
            $sql = "UPDATE article 
			SET title= '".$_POST["titre"]."',description='".$_POST["description"]."',category='".$_POST["categorie"]."',stock='".$_POST["stock"]."',visible='".$_POST["valide"]."'
			WHERE idarticle = ".$_POST["idarticle"]; // Requête que l'on souhaite envoyer à la base de donnée.
            $contenu = Connexion::getInstance()->prepare($sql); //on stock dans une variable, on appel la class connexion et sa fonction getInstance, query lance l'intérogation de la BDD ($sql) 
			$contenu->execute();
			
			//var_dump($sql);
			// die($sql);
			//mysqli_query($this->conn, $sql); // on envoie la requête pour qu'elle soit exécutée.
            // var_dump(mysqli_query($this->conn, $sql));
        }
        public function delete2(){ //fonction de suppression table stage
            
            $pls = "DELETE FROM article WHERE idarticle = '".$_POST["idarticle"]."'"; // Requête que l'on souhaite envoyer à la base de donnée.
            $contenu = Connexion::getInstance()->prepare($pls); //on stock dans une variable, on appel la class connexion et sa fonction getInstance, query lance l'intérogation de la BDD ($sql) 
			$contenu->execute();
			
			//mysqli_query($this->conn, $pls); // on envoie la requête pour qu'elle soit exécutée.
            
        }
		public function delete3(){ //fonction de suppression table stage
            
            $pls = "DELETE FROM bid WHERE idbid = '".$_POST["idbid"]."'"; // Requête que l'on souhaite envoyer à la base de donnée.
			$contenu = Connexion::getInstance()->prepare($pls); //on stock dans une variable, on appel la class connexion et sa fonction getInstance, query lance l'intérogation de la BDD ($sql) 
			$contenu->execute();
			
			//mysqli_query($this->conn, $pls); // on envoie la requête pour qu'elle soit exécutée.
            
        }
		
        /*public function ajout2() { //fonction pour ajouter dans la table stage
           
            $sql = "INSERT INTO article (`idarticle`, `title`, `description`, `price`, `stock`, `category`, `visible`) VALUES ('', '".$_POST["titre2"]."', '".$_POST["description2"]."', '".$_POST["prix2"]."', '".$_POST["stock2"]."', '".$_POST["categorie2"]."', '".$_POST["valide2"]."')"; // Requête que l'on souhaite envoyer à la base de donnée.
            $contenu = Connexion::getInstance()->prepare($sql); //on stock dans une variable, on appel la class connexion et sa fonction getInstance, query lance l'intérogation de la BDD ($sql) 
			$contenu->execute();
			
			//mysqli_query($this->conn, $pls); // on envoie la requête pour qu'elle soit exécutée.
            
        }*/
		
		/*public function lire2($test) { //fonction pour afficher la table stage

			if(isset($test)){
					$sql = "SELECT * FROM article ORDER BY ".$test."";
				
					$result = mysqli_query($this->conn, $sql);  // On récupère le résultat de la commande entrée.
					if(mysqli_num_rows($result) > 0) { // On vérifie que dans le résultat il y a des éléments présents.                                
						while($row = mysqli_fetch_assoc($result)) { 
							echo'
								<form action="" method="POST">
									<tr>
										<td><input class="none" type="text" name="idarticle" value="'.$row["idarticle"].'"  /></td>
										<td><input class="none" type="text" name="titre" value="'.$row["title"].'" /></td>
										<td><input class="none" type="text" name="description" value="'.$row["description"].'" /></td>
										<td><input class="none" type="text" name="prix" value="'.$row["price"].'" /></td>
										<td><input class="none" type="text" name="stock" value="'.$row["stock"].'" /></td>
										<td><input class="none" type="text" name="categorie" value="'.$row["category"].'" /></td>
										<td><input class="none" type="text" name="valide" value="'.$row["visible"].'" /></td>
										<td style="display: flex;">
											<input type="submit" name="update2" value="Update" class="btn btn-success" href=""> &nbsp
											<input type="submit" name="delete2" value="Delete" class="btn btn-danger" href="">  
										</td>      
									</tr>
								</form>';
						}
					}
			}
		}*/
		
        //function __destruct() { //fonction qui s'executera automatiquement en conclusion lorsque la méthode de l'objet est appelée.

        //}

    }