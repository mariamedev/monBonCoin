
<?php

use App\Db;
require_once('autoloader.php');






$test = new Db;

$test::getDb();
?>



<h1>Index : fichier de test</h1>
<p>C'est ici que nous allons tester tous nos CRUD</p>
<!-- pour utiliser les méthodes des CRUD il faut faire un require des class dont nous aurons besoin  -->
<!-- comme nous ne somme voulons pas faire des require toutes les deux minutes nous alllons utiliser un autoalder -->
