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
}
