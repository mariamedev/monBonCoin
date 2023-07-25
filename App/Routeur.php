<?php
namespace App;

class Routeur{
    private $routes = [
        '/' => ['controller' => 'Accueil'], 
        '/products'=> ['controller' => 'products'],
        '/detailProduct' => ['controller' => 'detailProduct'],
        '/incription' => ['controller' => 'incription'],
        '/connexion' => ['controller' => 'connexion'],
        '/deconnexion' => ['controller' => 'deconnexion'],
        '/ajoutProduct' => ['controller' => 'ajoutProduct'],
        '/modifProduct' => ['controller' => 'modifProduct'],
        '/suppProduct' => ['controller' => 'suppProduct'],
        '/panier' => ['controller' => 'panier']  
     ];
    //je creer un methode app qui est le méthode centrale 
    public function app(){
        //on test le routeur
    // echo "le routeur fonctionne";
    //on doit récupere l'url
    $request = $_SERVER['REQUEST_URI'];
    // echo $request;
    //je ne veux pas récupérer les paramètres dans mes routes
    //donc je casse la chaine de caratère en prenant "?" comme separateur
    $request = explode("?", $request);
    // var_dump($request);
    $request = $request[0];
    // echo ($request);

    // on vérifi si la route ($request) est bien présente dans le tableau de routes
    if (array_key_exists($request, $this->routes)) {
     echo $this->routes[$request]['controller'];
    }else {
        echo "la page que vous demandez n'existe pas ";
    }
    }
    
}