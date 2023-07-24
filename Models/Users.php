<?php
namespace Models;

use PDO;
use App\Db;

class Users extends Db{
    //////////// CRUD ///////////////
    ////////////////Méthode de lecture 

    //1/ Méthode pour trouver tous les users 
    public static function findAll(){
        $request = 'SELECT * FROM users';
        $reponse = self::getDb()->prepare($request);
        $reponse->execute();

        return $reponse->fetchAll(PDO::FETCH_ASSOC);
    }

    //2/ Méthode pour trouver un user par son id
    public static function findById($id){
        $request = 'SELECT * FROM users WHERE idUser = :id';
        $response = self::getDb()->prepare($request);
        $response->bindValue(':id', $id, PDO::PARAM_INT);
        $response->execute();

        return $response->fetch(PDO::FETCH_ASSOC);
    }
    //2/ Méthode pour touver un user par son login
    public static function findByLogin($login){
        $request = 'SELECT * FROM users WHERE login = :login';
        $response = self::getDb()->prepare($request);
        $response->bindValue(':login', $login, PDO::PARAM_STR);
        $response->execute();

        return $response->fetch(PDO::FETCH_ASSOC);
    }

    ///////////Métodes d'ecriture
    //1//////// Méthode pour créer un useer
    public static function create($data){
        //syntaxe sans les binValue utilisation du "?"
        //avec cette $data doit etre un tableau qui contient toutes les valeurs à enregister en BDD
        
        $request = "INSERT INTO users (login, password, firstName, lastName, adress, cp, city)
        VALUES (?,?,?,?,?,?,?)";
        $reponse = self::getDb()->prepare($request);
        return   $reponse->execute($data);
    }
    //2/Méthode pour modifier un user
    public static function update(array $data){
        $request = "UPDATE users SET login = ?, password = ?, firstName = ?, lastName = ?, adress = ?, cp = ?, city = ? WHERE idUser = ?" ;
        $reponse = self::getDb()->prepare($request);
        return $reponse->execute($data);
    }

    //3/ méthodde de suppression
    public static function delete($id){
        $request = "DELETE FROM users WHERE idUser = :id";
        $response = self::getDb()->prepare($request);
        $response->bindValue(':id', $id, PDO::PARAM_INT);
        return $response->execute();

    }
}