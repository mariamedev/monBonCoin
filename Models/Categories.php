<?php
namespace Models;

use PDO;
use App\Db;

class Categories extends Db{
    // ////////// CRUD ///////////////

    // Méthodes de lecture
    // 1/ toutes les catégories
    public static function findAll(){
        $request = "SELECT * FROM categories";
        $response = self::getDb()->prepare($request);
        $response->execute();

        return $response->fetchAll(PDO::FETCH_ASSOC);
    }

    // 2/ category par son id
    public static function findById($id){
        $request = "SELECT * FROM categories WHERE idCategory = :id";
        $response = self::getDb()->prepare($request);
        $response->bindValue(':id', $id, PDO::PARAM_INT);
        $response->execute();

        return $response->fetch(PDO::FETCH_ASSOC);
    }

    // Méthodes d'écriture
    // 1/Créer une categorie
    public static function create(string $data){
        $request = "INSERT INTO categories (title) VALUES (:data)";
        $response = self::getDb()->prepare($request);
        $response->bindValue(':data', $data, PDO::PARAM_STR);
        
        return $response->execute();
    }
    // 2/Mise à jour d'une categorie
    public static function update(string $data, int $id){
        $request = "UPDATE categories SET title = :title WHERE idCategory = :id";
        $response = self::getDb()->prepare($request);
        $response->bindValue(':title', $data, PDO::PARAM_STR);
        $response->bindValue(':id', $id, PDO::PARAM_STR);
        return $response->execute();
    }

    // 3/DELETE
    public static function delete(int $id){
        $request = "DELETE FROM categories WHERE idCategory = :id";
        $response = self::getDb()->prepare($request);
        $response->bindValue(':id', $id, PDO::PARAM_INT);
        return $response->execute();
    }
} 

// <!-- liste des categories à créer :
// maison
// jardin
// véhicule
// tech
// instruments de musique
// non classé -->