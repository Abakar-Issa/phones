<?php
/*
 * On indique que les chemins des fichiers qu'on inclut
 * seront relatifs au répertoire src.
 */
set_include_path("./src");

/* Inclusion des classes utilisées dans ce fichier */
require_once("Router.php");
require_once("model/PhoneStorageFile.php");
require_once("lib/ObjectFileDB.php");
require_once("model/PhoneStorageMySQL.php");
require_once("model/AccountStorageMySQL.php");

require_once('/users/21913509/private/mysql_config.php');


/*
 * Cette page est simplement le point d'arrivée de l'internaute
 * sur notre site. On se contente de créer un routeur
 * et de lancer son main.
 */

 //Construction de l'instance de PDO

	try {
		$dsn = 'mysql:host=' . MYSQL_HOST .';port='. MYSQL_PORT. ';dbname=' . MYSQL_DB;			
		$PDO = new PDO($dsn, MYSQL_USER, MYSQL_PASSWORD);		
	}
	catch (Exception $e) {
		die('Erreur : ' . $e->getMessage());
	}
	// Activation de la Gestion des erreurs
	$PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



$base = new PhoneStorageMySQL($PDO);
$base1 = new AccountStorageMySQL($PDO);
$router = new Router();






$router->main($base,$base1);


?>
