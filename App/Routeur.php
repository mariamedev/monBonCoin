<?php
namespace App;

class Routeur{
        private $routes = [
            '/' => ['controller' => 'Products', 'action' => 'accueil'],
            '/products' => ['controller' => 'Products', 'action' => 'AffichageProducts'],
            '/detailProduct' => ['controller' => 'Products', 'action' => 'detailProduct'],
            '/inscription' => ['controller' => 'Users', 'action' => 'inscription'],
            '/connexion' => ['controller' => 'Users', 'action' => 'connexion'],
            '/deconnexion' => ['controller' => 'Users', 'action' => 'deconnexion'],
            '/ajoutProduct' => ['controller' => 'Products', 'action' => 'ajoutProduct'],
            '/modifProduct' => ['controller' => 'Products', 'action' => 'modifProduct'],
            '/suppProduct' => ['controller' => 'Products', 'action' => 'suppProduct'],
            '/panier' => ['controller' => 'panier', 'action' => 'gestionPanier']
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
        $controller = "Controllers\\" . $this->routes[$request]['controller'];
        // echo $controller;
        $action = $this->routes[$request]['action'];
        $controller::$action();
    }else {
        echo "la page que vous demandez n'existe pas ";
    }
    }
    
}