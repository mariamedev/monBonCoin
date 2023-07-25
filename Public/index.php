<?php

use App\Routeur;
//ce fichier est le point d'entrée de notre site

// echo " point d'entrée";
//pour reter sur le fichier index.php quoi qu'il arrive je dois faire une réecriture d'url
// une des possibilités est d'utiliser un cfuchier de config du serveur apache qui d'appelle 
// .htaccess
//nous allos créer ce fichier dans le repertoire "public"
//*nous allons aussi créer le virtualHost

//on importe l'autoader
require_once('../autoloader.php');

//on crée un routeur pour gérer les routes 
//on appelle la méthode app()

$routeur = new Routeur;
$routeur->app();