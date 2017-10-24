<?php
    session_start();
    /*if(isset($_SESSION["id"])){
		if($_SESSION['ip'] != $_SERVER['REMOTE_ADDR']){
			header("location: include/deconnexion.php");
		}else{
			$id = $_SESSION["mail"];
			$admin= $_SESSION["admin"];
		}
	}*/
	
    require("dbcrud.php"); // lien d'un fichier php contenant la classe, require = obligatoire, include = facultatif
    $crudite = new crud();
		$crudite->verifadmin($_SESSION["mail"]);
	
		$crudite->clearnoactif();

        if(isset($_POST["action"]) && $_POST["action"] == "update") { // On vérifie que le bouton uptade est pressé.
           $crudite->update(); // si le bouton est pressé, la fonction update de la classe crud est utilisé.
        }

        if(isset($_POST["action"]) && $_POST["action"] == "delete") { // On vérifie que le bouton delete est pressé.
           $crudite->delete(); // si le bouton est pressé, la fonction delete de la classe crud est utilisé.
        }
        
        if(isset($_POST["action"]) && $_POST["action"] == "update2") { // On vérifie que le bouton uptade est pressé.
           $crudite->update2(); // si le bouton est pressé, la fonction update de la classe crud est utilisé.
        }

        if(isset($_POST["action"]) && $_POST["action"] == "delete2") { // On vérifie que le bouton delete est pressé.
           $crudite->delete2(); // si le bouton est pressé, la fonction delete de la classe crud est utilisé.
        }
		
		if(isset($_POST["action"]) && $_POST["action"] == "delete3") { // On vérifie que le bouton delete est pressé.
           $crudite->delete3(); // si le bouton est pressé, la fonction delete de la classe crud est utilisé.
        }


        /*if(isset($_POST["update2"])) { // On vérifie que le bouton uptade2 est pressé.
           $crudite->update2(); // si le bouton est pressé, la fonction update de la classe crud est utilisé.
        }

        if(isset($_POST["delete2"])) { // On vérifie que le bouton delete2 est pressé.
           $crudite->delete2(); // si le bouton est pressé, la fonction delete de la classe crud est utilisé.
        }*/

        /*if(isset($_POST["action"]) && $_POST["action"] == "ajout2") { // On vérifie que le bouton ajout2 est pressé.
           $crudite->ajout2(); // si le bouton est pressé, la fonction ajout de la classe crud est utilisé.
        }*/
        
		// Tri table utilisateurs
		/*if(isset($_POST["triref"])) {
			$crudite->trie("idusers");
		}else if(isset($_POST["trinom"])) {
			$crudite->trie("name");
		}else if(isset($_POST["triprenom"])) {
			$crudite->trie("firstname");
		}else if(isset($_POST["triadresse"])) {
			$crudite->trie("adress");
		}else if(isset($_POST["tricp"])) {
			$crudite->trie("zipcode");
		}else if(isset($_POST["triville"])) {
			$crudite->trie("city");
		}else if(isset($_POST["tritelephone"])) {
			$crudite->trie("phone");
		}else if(isset($_POST["trimail"])) {
			$crudite->trie("mail");
		}else if(isset($_POST["triadmin"])) {
			$crudite->trie("admin");
		}
		
		// Tri table article
		if(isset($_POST["triid"])) { 
			$crudite->lire2("idarticle");
		}else if(isset($_POST["trititre"])) {
			$crudite->lire2("title");
		}else if(isset($_POST["triprix"])) {
			$crudite->lire2("price");
		}else if(isset($_POST["tristock"])) {
			$crudite->lire2("stock");
		}else if(isset($_POST["tricategorie"])) {
			$crudite->lire2("category");
		}else if(isset($_POST["trivalide"])) {
			$crudite->lire2("visible");
		}*/
		
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>crud</title>
        <!-- CSS
          ================================================== -->
        <link href="../css/bootstrap.css" rel="stylesheet" type="text/css">
        <link href="../css/bootstrap-theme.css" rel="stylesheet" type="text/css">
        
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.css">
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.3.1/css/buttons.dataTables.min.css">
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.2.2/css/select.dataTables.min.css">
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		<script src="js/scriptcrud.js"></script>
		<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script>
		<script src="https://cdn.datatables.net/select/1.2.2/js/dataTables.select.min.js"></script>
	
		


    </head>
    <body>
        <p><b><u> TABLE UTILISATEURS </u></b></p>
		<div>
			
				<table id="membres" class="display" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>Ref</br></th>
							<th>Nom</br></th>
							<th>Prenom</br></th>
							<th>Adresse</br></th>
							<th>Code postal</br></th>
							<th>Ville</br></th>
							<th>Telephone</br></th>
							<th>Mail</br></th>
							<th>Admin</br></th>
							<th></th>
						   
						</tr>
						
					</thead>
					<tbody>
						<?php $crudite->lire(); ?>  <!-- Appel fonction Lire dans la class php crud --> 
					</tbody>
				</table>
			
			
		</div>
        <p><b><u> TABLE ARTICLE </u></b></p>
        
        <table id="articles" class="display" width="100%" cellspacing="0">
            <thead>
                <tr>
						<th>Id</br></th>
						<th>Titre</br></th>
						<th>Description</br></th>
						<th>Stock</br></th>
						<th>Categorie</br></th>
						<th>Valide</br></th>
						<th></th>
                </tr>
            </thead>
            <tbody class="scrollContent">
                <?php $crudite->lire2(); ?>  <!-- Appel fonction Lire2 dans la class php crud -->             
            </tbody>
        </table>
		<p><b><u> TABLE ENCHERE </u></b></p>
        
        <table id="encheres" class="display" width="100%" cellspacing="0">
            <thead>
                <tr>
						<th>Idenchere</br></th>
						<th>Datedebut</br></th>
						<th>Datefinprevue</br></th>
						<th>Miseaprix</br></th>
						<th>Prixfinal</br></th>
						<th>Datefineffective</br></th>
						<th>Gagnant</br></th>
						<th>Datecreation</br></th>
						<th>idarticle</th>
						<th>idgagnant</th>
						<th></th>
						
                </tr>
            </thead>
            <tbody class="scrollContent">
                <?php $crudite->lire3(); ?>  <!-- Appel fonction Lire2 dans la class php crud -->             
            </tbody>
        </table>
		
		
		
        <!--<table class="display" width="100%" cellspacing="0">
                <form method="POST">
				<thead>
					<tr>
						<th>Id</br></th>
						<th>Titre</br></th>
						<th>Description</br></th>
						<th>Prix</br></th>
						<th>Stock</br></th>
						<th>Categorie</br></th>
						<th>Valide</br></th>
						<th></th>
					</tr>
				</thead>
				<tbody>
                    <tr>
						<td><input type="text" size="1" name="idarticle2" class="lol" readonly></td>
                        <td><input type="text" name="titre2" class="lol"  /></td>
                        <td><input type="text" name="description2" class="lol" /></td>
                        <td><input type="text" name="prix2" class="lol" /></td>
                        <td><input type="text" name="stock2" class="lol" /></td>
                        <td><select id="liste" name="categorie2" class="lol">
                            <option> Meubles </option>
                            <option> Tableaux </option>
							<option> Vases </option>
                        </select></td>
                        <td><input type="text" name="valide2" class="lol" /></td>
                        <td><input type="submit" name="ajout2" value="Ajouter" class="btn btn-success crud-add2"></td>
                    </tr>
				</tbody>
                </form>
         </table>-->
         
        







    </body>
    
</html>