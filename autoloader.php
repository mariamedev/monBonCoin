<?php

class Autoload{
    public static function inclusionAuto($className){
        require_once(__DIR__ .'/' . str_replace('\\', DIRECTORY_SEPARATOR, $className . '.php'));
    }
}

spl_autoload_register(['Autoload', 'inclusionAuto']);