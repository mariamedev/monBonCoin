<?php
namespace Models;

use PDO;
use App\Db;

class Products extends Db{
    //////CRUD/////////////////////
    //1// lecture

    // tous les produits
    public static function findAll($order=null, $limit = null){
        //pour récupérer le nom des ctaegories on doit faire une jointure
        $request = "SELECT *, products.title AS productTitle , categories.title AS catTitle  FROM products INNER JOIN categories ON products.idCategory = categories.idCategory";
        //on voudrait pouvoir ordonner les réponse par prix
        // if ($order) {
        //     $request .= " ORDER BY price $order";
        // }
        //meme chose en ternaire
        $order ? $request .= " ORDER BY  $order" : null ;
        $limit ? $request .= " LIMIT $limit" : null;
        $response = self::getDb()->prepare($request);
        $response->execute();

        return $response->fetchAll(PDO::FETCH_ASSOC);
        
    }
    //produit par son id
    public static function findById($id){
        $request = "SELECT *, products.title AS productTitle , categories.title AS catTitle  FROM products INNER JOIN categories ON products.idCategory = categories.idCategory WHERE idProduct = :id";
        $response = self::getDb()->prepare($request);
        $response->bindValue(':id', $id, PDO::PARAM_INT);
        $response->execute();

        return $response->fetch(PDO::FETCH_ASSOC);
    }
    // les produits d'un user
    public static function findByUser($idUser){
        $request = "SELECT *, products.title AS productTitle , categories.title AS catTitle  FROM products INNER JOIN categories ON products.idCategory = categories.idCategory WHERE idUser = :idUser";
        $response = self::getDb()->prepare($request);
        $response->bindValue(':idUser', $idUser, PDO::PARAM_INT);
        $response->execute();

        return $response->fetchAll(PDO::FETCH_ASSOC);
    }
    // les produits d'une catégories
    public static function findByCat($idCategory, $order = null){
        $request = "SELECT *, products.title AS productTitle , categories.title AS catTitle  FROM products INNER JOIN categories ON products.idCategory = categories.idCategory WHERE products.idCategory = :idCategory";
        //attention l champs idcategories est present dans les deux tables donc il faut preciser le nom de la table dans le WHERE
        $order ? $request .= " ORDER BY  $order" : null ;
        $response = self::getDb()->prepare($request);
        $response->bindValue(':idCategory', $idCategory, PDO::PARAM_INT);
        $response->execute();

        return $response->fetchAll(PDO::FETCH_ASSOC);
    }
    //les méthodes d'ecriture 
    //1/ create 
    public static function create(array $data){
        $request = "INSERT INTO products (idCategory , idUser, title, description, price, image)
        VALUES (?,?,?,?,?,?)";
        $reponse = self::getDb()->prepare($request);
        return $reponse->execute($data);
    }
    // 2/ Update
    public static function update(array $data){
        $request = "UPDATE products SET idCategory = ?, idUser = ?, title = ?, description = ?, price = ?, image = ?  WHERE idProduct = ?" ;
        $reponse = self::getDb()->prepare($request);
        return $reponse->execute($data);
    }
     // 3/DELETE
     public static function delete( $id){
        $request = "DELETE FROM products WHERE idProduct = :id";
        $response = self::getDb()->prepare($request);
        $response->bindValue(':id', $id, PDO::PARAM_INT);
        return $response->execute();
    }
}