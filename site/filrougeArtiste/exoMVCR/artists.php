<?php
/*
 * On indique que les chemins des fichiers qu'on inclut
 * seront relatifs au répertoire src.
 */
set_include_path("./src");


/* Inclusion des classes utilisées dans ce fichier */
require_once("Router.php");
require_once("src/view/View.php");
require_once("src/control/Controller.php");
require_once("src/model/Artist.php");
require_once("src/model/ArtistStorage.php");
require_once("src/model/ArtistStorageFile.php");
require_once("src/model/ArtistStorageStub.php");
require_once("src/model/ArtistStorageMySQL.php");
require_once("private/mysql_config.php");



/*
 * Cette page est simplement le point d'arrivée de l'internaute
 * sur notre site. On se contente de créer un routeur
 * et de lancer son main.
 */
// $artistStorageStub = new ArtistStorageStub();
// $router = new Router();
// $router->main($artistStorageStub);

// $file = $_SERVER['TMPDIR'].'/artist_db.txt';
// $artistStorageFile = new ArtistStorageFile($file);
// //$artistStorageFile->reinit();
// $router = new Router();
// $router->main($artistStorageFile);

$dsn = "mysql:host=" . MYSQL_HOST . ";port=" . MYSQL_PORT . ";dbname=" . MYSQL_DB . ";charset=" . MYSQL_CHARSET; 
$user = MYSQL_USER; 
$passwd =  MYSQL_PASSWORD;
$pdo = new PDO($dsn, $user, $passwd);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$animalStorageMySQL = new ArtistStorageMySQL($pdo);
$router = new Router();
$router->main($animalStorageMySQL);

