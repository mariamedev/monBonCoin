<?php

namespace App;

use PDO;
use PDOException;

//cette class permet de se connecter à la BDD en utilisant le pattern singleton

class Db{
    private static $db; //pour stocker mon objet PDO

    //Singleton
    static function getDb(){
        if (!self::$db) {
            try {
                $config = file_get_contents('../App/config.json');
                // var_dump($config);
                //pour pouvoir utliliser un fichier json il faut le decoder
                $config = json_decode($config);
                // var_dump($config);
                //on créee l'objet PDO
                self::$db = new PDO("mysql:host=". $config->host . ";dbname=" . $config->dbName, $config->user,$config->password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => ' SET NAMES utf8'));
                

            } catch (PDOException $err) {
               echo "problème de conexion à la BDD";
            }
        }
        return self::$db;
    }
}

$test = new Db;

$test::getDb();