
<?php

use App\Db;
use Models\Users;
use Models\Products;
use Models\Categories;





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

<h2>Utilisation de la méthode de create()sur users</h2>
<?php
$pass = password_hash('123456789',PASSWORD_DEFAULT);
$data = [ 'maraimaesouare11@gmail.com', $pass, 'mariame' , 'souare', '21 avenue des syvris',
'94000', 'créteil', 3];
// Users::create($data);
// Users::update($data);
Users::delete($data);
?>

<h2>Test de la méthode findAll sur catégories</h2>
<?php
    $categories = Categories::findAll();
    var_dump($categories);
?>
<h2>Test de la méthode findById sur catégories</h2>
<?php
    $categories = Categories::findById(6);
    var_dump($categories);
?>
<h2>Test de la méthode create sur catégories</h2>
<?php
    // $categories = Categories::create("non classé");   
?>
<h2>Test de la méthode update sur catégories</h2>
<?php
    // $categories = Categories::update("non classée",1);   
?>
<h2>Test de la méthode delete sur catégories</h2>
<?php
    // $categories = Categories::delete(1);   
?>
<h2>Test de la méthode findAll sur products</h2>
<?php
//    $products = Products::findAll(null ,1);
//    var_dump($products);   
// ?>
<h2>Test de la méthode findById sur products</h2>
<?php
$products = Products::findById(2);
var_dump($products);
?>
<h2>Test de la méthode findByUser sur products</h2>
<?php
$products = Products::findByUser(3);
var_dump($products);
?>
<h2>Test de la méthode findByCatégories sur products</h2>
<?php
$products = Products::findByCat(7);
var_dump($products);
?>
<h2>Test de la méthode create sur products</h2>
<?php
   
   $data = [ 8,3, 'iphone' , 'le tout dernier', 1200, 'iphone.jpg'];
//    Products::create($data);
?>
<h2>Test de la méthode update sur products</h2>
<?php
   
   $data = [ 8,3, 'iphone' , 'le tout dernier', 1500, 'iphone.jpg',3];
//    Products::update($data);
?>
<h2>Test de la méthode delete sur products</h2>
<?php
    $id = Products::delete(5);   
?>