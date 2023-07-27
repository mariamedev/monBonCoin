<?php

namespace Controllers;

class Users extends Controller
{
    public static function connexion()
    {
        $errMsg = "";
        //pour bérifier si le formaulaire a été soumis nous pouvon utiliser la super globale $_SERVER (cette méthode ne fonctionne qu'qvec un formaulaire en POST)
        // var_dump($_SERVER);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //ECHOO 'le formulaire est soumis';
            //il faut tjrs sécuriser les saisies utilisateurs
            //https://www.php.net/manual/fr/function.htmlspecialchars.php
            $login = htmlspecialchars(trim($_POST['login']));
            //on vérifi si le login est présent en BDD
            $user = \Models\Users::findByLogin($login);
            var_dump($user);
            if (!$user) {
                $errMsg = "Le login et / ou le mot de passe est incorrect";
            } else {
                $pass = htmlspecialchars(trim($_POST['password']));
                if (password_verify($pass, $user['password'])) {
                    //l'utilisateur est correcte
                    $_SESSION['message'] = "Salut, content de vous revoir";
                    $_SESSION['user'] = [
                        'role' => $user['role'],
                        'id' => $user['isUser'],
                        'firstName' => $user['firstName']
                    ];
                    //Quand l'utilisateur est connecté on le redirige vers la route de notre choix
                    header('Location: /');
                } else {
                    $errMsg = "le login et / ou le mot de passe est incorrect";
                }
            }
        }
        self::render('users/connexion', [
            'title' => 'Vous pouvez vous connecter',
            'messageErreur' => $errMsg
        ]);
    }

    public static function deconnexion()
    {
        unset($_SESSION['user']);
        $_SESSION['message'] = "A bientôt";
        header('Location: /');
    }
    public static function inscription()
    {
        $errMsg = "";
        self::render('users/inscription', [
            'title' => 'Merci de remplir le formualire pour vous incrire',
            'erreurMessage' => $errMsg
        ]);
    }
}
