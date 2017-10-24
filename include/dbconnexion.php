<?php

class Connexion
{
    
    protected static $instance = null; 
 
    private function __construct() 
	{
			try{

				$db_options = array(
				    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8", // On force l'encodage en utf8
    				PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC , // On récupère tous les résultats en tableau associatif
    				PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING // On affiche des warnings pour les erreurs, à commenter en prod (valeur par défaut PDO::ERRMODE_SILENT)
				);


				  self::$instance = new PDO('mysql:host=mysql-jean-patrick-enchere.alwaysdata.net; dbname=jean-patrick-enchere_data', '144512_ea', 'salut2', $db_options); // On créer une variable pour intancier les propriétés est méthode du modèle PDO.
    		      //$_POST['db']=$db;//attention, pas d'espace autour du signe égal. On stock la variable dans une super global pour l'utiliser dans d'autres pages.
    		      //self::$instance->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
				  //self::$instance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
				  
			}
			  
			catch (PDOException $e)
			{
				  echo 'Erreur ! : ' .$e->getMessage() . '<br />';
				  exit;
			} 
		   
	
    }
     
public static function getInstance()
  {
      if(is_null(self::$instance))
      {
        new Connexion();

      }
  
      return self::$instance;
  }
   

 
}
?>