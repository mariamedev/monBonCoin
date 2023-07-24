
<?php

use App\Db;
use Models\Users;

require_once('autoloader.php');





// test de l'autoloader
// $test = new Db;
// $test::getDb();



?>



<h1>Index : fichier de test</h1>
<p>C'est ici que nous allons tester tous nos CRUD</p>
<!-- pour utiliser les méthodes des CRUD il faut faire un require des class dont nous aurons besoin  -->
<!-- comme nous ne somme voulons pas faire des require toutes les deux minutes nous alllons utiliser un autoalder -->


<h2>Utilisation de la méthode de findAll sur users</h2>
<?php

$users = Users::findAll();
var_dump($users);
?>


<h2>Utilisation de la méthode de findById sur users</h2>
<?php
$user = Users::findById(2);
var_dump($user);


?>


<h2>Utilisation de la méthode de findByLogin sur users</h2>
<?php
$login = "user@gmail.com";
$user = Users::findByLogin($login);
var_dump($user);
?>

<h2>Utilisation de la méthode de findByLogin sur users</h2>
<?php
$pass = password_hash('123456789',PASSWORD_DEFAULT);
$data = [ 'maraimaesouare11@gmail.com', $pass, 'mariame' , 'souare', '21 avenue des syvris',
'94000', 'créteil', 3];
// Users::create($data);
// Users::update($data);
Users::delete($data);
?>