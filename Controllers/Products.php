<?php

namespace Controllers;



class Products extends Controller
{
    public static function accueil()
    {
        // echo "vous êtes dans la méthode accueil";

        //on fait appelle à la méthode findAll du model Products pour récupéerer les produits
        $products = \Models\Products::findAll("date DESC", 2);
        //on utilise la méthode render du controller principak=le pour afficher la bonne vue avec les bonnes infos

        self::render('products/accueil', [
            'title' => 'Les deux derniers produits',
            'products' => $products
        ]);
    }
    //méthode pour récupere un produit par son id et l'envoyerà la vue détailproduct
    public static function detailProduct()
    {
        // je creer une variable pour stocker les erreurs potentielles
        $err = "";
        if (isset($_GET['id'])) {
            $idProduct = $_GET['id'];
            // echo $idProduct;
            $product = \Models\Products::findById($idProduct);
            $err = !$product ? " le produit n'existe pas " : null;
            // echo $err;
            //Apprès avoir réu=cupéré le produit je récupère le user propriétaire du produit 
            //pour pouvoir utiliser son adresse
            $idUser = $product['idUser'];
            $userProduct = \Models\Users::findById($idUser);


            //j'utlise le render
            self::render('products/detailProduct', [
                'title' => "detail du produit",
                'product' => $product,
                'user' => $userProduct,
                'erreur' => $err
            ]);
        }
    }
    //méthode qui gère la récuperation et l'affichage de tous les produits
    public static function AffichageProducts()
    {
        //pour mon formulaire de tri,je récupère toutes les catégories
        $categories = \Models\Categories::findAll();

        //je recupère tous les produits avec ou sans filtre
        if (isset($_GET['idCat']) && $_GET['idCat'] != ""){
            $idCat = $_GET['idCat'];
            $products = \Models\Products::findByCat($idCat);
        } else {
            $products = \Models\Products::findAll();
        }

        //j'utilise render() pour envoyer est produit à la bonne vue
        self::render('products/accueil', [
            'title' => 'Tout les produits de Mon Bon Coin',
            'products' => $products,
            'categories' => $categories
        ]);
    }
    //methode pour ajouter un profil
    public static function ajoutProduct(){
        $errMsg = "";
        // Traitement de du formulaire
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if(empty($_POST['idCategorie'])){
                $errMsg .= "Merci de choisir une catégorie<br>";

            }
            if(empty($_POST['title'])){
                $errMsg .= "Merci de choisir un titre <br>";

            }
            if(empty($_POST['price'])){
                $errMsg .= "Merci de choisir un prix<br>";

            }
            if(empty($_POST['description'])){
                $errMsg .= "Merci de choisir une description<br>";

            }
            if (empty($_FILES ['image']['name'])) {
                $errMsg .= "Merci de choisir l'image de votre produit";
            }
            // Les controles sur l'image
            if ($_FILES['image']['size'] < 3000000 && 
                ($_FILES['image']['type'] == 'image/jpeg' ||
                $_FILES['image']['type'] == 'image/jpg' ||
                $_FILES['image']['type'] == 'image/png' ||
                $_FILES['image']['type'] == 'image/webp')) {
                    // on sécurise les saisies
                    self::security();
                    // on renome l'image pour a voir un nom unique
                    $photoName = uniqid(). $_FILES ['image']['name'] ;
                    // echo  $photoName ;
                    // echo __DIR__;
                    //on copie l'image sur le serveur
                    copy($_FILES['image']['tmp_name'], "../public/image/" . $photoName);
                    // on peut maintenant enregistrer en BDD
                    //je stock les infos dan un tableau
                    $dataProduct = [
                        $_POST['idCategorie'],
                        $_SESSION['user']['id'],
                        $_POST['title'],
                        $_POST['description'],
                        $_POST['price'], 
                        $photoName
                    ];
                    //on utilise la bonne methode
                    \Models\Products::create($dataProduct);
            }else{
                $errMsg = "Votre image n'est pas au format demandé";
            }
            
        }
        //je recupère toutes les catégories
        $categories = \Models\Categories::findAll();
        self::render('products/formProduct',[
            'title' => 'Formulaire de création d\'un produit',
            'categories' => $categories,
            'errMsg' => $errMsg
        ]);
    }
}
