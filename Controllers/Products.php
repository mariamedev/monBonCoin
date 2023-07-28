<?php

namespace Controllers;


class Products extends Controller
{
    public static function accueil()
    {
        // echo "vous êtes dans la méthode accueil";

        // On fait appelle à la méthode findAll du model Products pour récupérer les produits
        $products = \Models\Products::findAll("date DESC", 2);
        // On utlise la méthode render du controller principale pour afficher la bonne vue avec les bonnes infos
        self::render('products/accueil', [
            'title' => 'Les deux derniers produits',
            'products' => $products
        ]);
    }

    // Méthode pour récupérer un produit par son id et l'envoyer à la vue détailproduct
    public static function detailProduct()
    {
        // Je crée une variable pour stocker les erreurs potentielles
        $err = "";
        if (isset($_GET['id'])) {
            $idProduct = $_GET['id'];
            // echo $idProduct;
            $product = \Models\Products::findById($idProduct);
            $err = !$product ? "le produit n'existe pas" : null;
            // echo $err;
            // Après avoir récupéré le produit je récupère le user propriétaire du produit
            // pour pouvoir utiliser son adresse
            $idUser = $product['idUser'];
            $userProduct = \Models\Users::findById($idUser);

            // j'utilise le render
            self::render('products/detailProduct', [
                'title' => "détail du produit",
                'product' => $product,
                'user' => $userProduct,
                'erreur' => $err
            ]);
        }
    }

    // Méthode qui gère la récupération et l'affichage de tous les produits
    public static function AffichageProducts()
    {
        // Pour mon formulaire de tri, je récupère toutes les catégories
        $categories = \Models\Categories::findAll();

        // Je recupère tous les produits avec ou sans filtre
        if (isset($_GET['idCat']) && $_GET['idCat'] != "") {
            $idCat = $_GET['idCat'];
            $products = \Models\Products::findByCat($idCat);
        } else {
            $products = \Models\Products::findAll();
        }


        // J'utilise render() pour envoyer ces produist à la bonne vue
        self::render('products/accueil', [
            'title' => 'Tous les produits de Mon Bon Coin',
            'products' => $products,
            'categories' => $categories
        ]);
    }

    // Méthode pour ajouter un produit
    public static function ajoutProduct()
    {
        $errMsg = "";
        // Traitement du formulaire
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (empty($_POST['idCategorie'])) {
                $errMsg .= "Merci de choisir une catégorie<br>";
            }
            if (empty($_POST['title'])) {
                $errMsg .= "Merci de saisir un titre<br>";
            }
            if (empty($_POST['price'])) {
                $errMsg .= "Merci de saisir un prix<br>";
            }
            if (empty($_POST['description'])) {
                $errMsg .= "Merci de saisir une description<br>";
            }
            if (empty($_FILES['image']['name'])) {
                $errMsg .= "Merci de choisir l'image de votre produit";
            }
            // Les controles sur l'image
            if (
                $_FILES['image']['size'] < 3000000 &&
                ($_FILES['image']['type'] == 'image/jpeg' ||
                    $_FILES['image']['type'] == 'image/jpg' ||
                    $_FILES['image']['type'] == 'image/png' ||
                    $_FILES['image']['type'] == 'image/webp')
            ) {
                // On sécurise les saisies
                self::security();
                // On renommer l'image pour avoir un nom unique
                $photoName = uniqid() . $_FILES['image']['name'];
                // echo $photoName;
                // echo __DIR__;
                // on copie l'image sur le serveur
                copy($_FILES['image']['tmp_name'], "../public/image/" . $photoName);
                // On peut maintenant enregistrer en BDD
                // je stocke les infos dans un tableau
                $dataProduct = [
                    $_POST['idCategorie'],
                    $_SESSION['user']['id'],
                    $_POST['title'],
                    $_POST['description'],
                    $_POST['price'],
                    $photoName
                ];
                // On utilise la bonne méthode
                \Models\Products::create($dataProduct);
            } else {
                $errMsg = "Votre image n'est pas au format demandé";
            }
        }
        // Je récupère toutes les catégories
        $categories = \Models\Categories::findAll();
        // j'appelle la bonne vue
        self::render('products/formProduct', [
            'title' => 'Formulaire de création d\'un produit',
            'categories' => $categories,
            'errMsg' => $errMsg
        ]);
    }

    // Méthode pour modifier un produit
    public static function modifProduct()
    {
        $errMsg = "";
        // Je fais appelle au models Products pour récupérer le produit à modifier
        $idProduct = $_GET['id'];
        $product = \Models\Products::findById($idProduct);
        // je traite le formulaire
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (empty($_POST['idCategorie'])) {
                $errMsg .= "Merci de choisir une catégorie<br>";
            }
            if (empty($_POST['title'])) {
                $errMsg .= "Merci de saisir un titre<br>";
            }
            if (empty($_POST['price'])) {
                $errMsg .= "Merci de saisir un prix<br>";
            }
            if (empty($_POST['description'])) {
                $errMsg .= "Merci de saisir une description<br>";
            }
            if ($_FILES['image']['name'] == "") {
                self::security();
                $dataProductUpdate = [
                    $_POST['idCategorie'],
                    $_SESSION['user']['id'],
                    $_POST['title'],
                    $_POST['description'],
                    $_POST['price'],
                    $product['image'],
                    $product['idProduct']
                ];
                \Models\Products::update($dataProductUpdate);
                header('Location: /profil');
            } else {
                //je rentre dans ce if l'utilisateur change d'image
                if (
                    $_FILES['image']['size'] < 3000000 &&
                    ($_FILES['image']['type'] == 'image/jpeg' ||
                        $_FILES['image']['type'] == 'image/jpg' ||
                        $_FILES['image']['type'] == 'image/png' ||
                        $_FILES['image']['type'] == 'image/webp')
                ) {
                    // On sécurise les saisies
                    self::security();
                    // On renommer l'image pour avoir un nom unique
                    $photoName = uniqid() . $_FILES['image']['name'];
                    // echo $photoName;
                    // echo __DIR__;
                    // on copie l'image sur le serveur
                    copy($_FILES['image']['tmp_name'], "../public/image/" . $photoName);
                    //on supprime l'ancienne
                    $fileToDelete = "../public/image/image/" .$product['image'];
                    unlink($fileToDelete);
                    // On peut maintenant enregistrer en BDD
                    // je stocke les infos dans un tableau
                    $dataProductUpdate = [
                        $_POST['idCategorie'],
                        $_SESSION['user']['id'],
                        $_POST['title'],
                        $_POST['description'],
                        $_POST['price'],
                        $photoName,
                        $product['idProduct']
                    ];
                    // On utilise la bonne méthode
                    \Models\Products::update($dataProductUpdate);
                    header('Location: /profil');
                } else {
                    $errMsg = "Votre image n'est pas au format demandé";
                }
            }
        }


        // Je récupère toutes les catégories
        $categories = \Models\Categories::findAll();


        // j'appelle la bonne vue si je suis connecté
        if (
            isset($_SESSION['user']) &&
            ($_SESSION['user']['role'] == 1 ||
                $_SESSION['user']['id'] == $product['idUser'])
        ) {
            self::render('products/formProduct', [
                'title' => 'Formulaire de modification d\'un produit',
                'categories' => $categories,
                'errMsg' => $errMsg,
                'product' => $product
            ]);
        } else {
            self::render('users/connexion', [
                'title' => 'Merci de vous connecter pour modifier un produit',
                'messageErreur' => $errMsg
            ]);
        }
    }
    //méthode pour supprimer une image 
    
    
}
