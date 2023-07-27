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
    public static function inscription(){
        $errMsg = "";
        // Regex du mot de passe (minimun 8 caratères)
        $pattern = '/^.{8,}$/';
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if (empty($_POST['login']) || !filter_var($_POST['login'], FILTER_VALIDATE_EMAIL)) {
                $errMsg .= "Merci de saisir votre email<br>";
            }
            if (empty($_POST['firstName'])) {
                $errMsg .= "Merci de saisir votre prénom<br>";
            }
            if (empty($_POST['lastName'])) {
                $errMsg .= "Merci de saisir votre Nom<br>";
            }
            if (empty($_POST['address'])) {
                $errMsg .= "Merci de saisir votre address<br>";
            }
            if (empty($_POST['cp'])) {
                $errMsg .= "Merci de saisir votre code postale<br>";
            }
            if (empty($_POST['city'])) {
                $errMsg .= "Merci de saisir votre ville<br>";
            }
            if (empty($_POST['password'])) {
                $errMsg .= "Merci de saisir votre passe<br>";
            }
            if (empty($_POST['confirm'])) {
                $errMsg .= "Merci de saisir votre passe<br>";
            }
            //on vérifie que les deux password correspondent et min 8caractères
            if ($_POST['password'] == $_POST['confirm'] && preg_match($pattern, $_POST['password'])){
                // je securise les saisies
                self::security();
                $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
                // var_dump($_POST);
                //je crée un tableau qui contient les infos du user 
                $dataUser = [];
                foreach ($_POST as $key => $value) {
                    if ($key != 'confirm')  {
                        $dataUser[] = $value;
                    }
                }
              //on enregistre en BDD
              \Models\Users::create($dataUser);
              $_SESSION['message'] = "Votre compte à été bien crée, vous pouvez vous connecter";
              header('Location: /connexion');
            }else {
                $errMsg = "Les deux mots de passe sont différents ou ne contennent pas 8 caractère";
            }
            

        }

        self::render('users/inscription', [
            'title' => 'Merci de remplir le formualire pour vous inscrire',
            'erreurMessage' => $errMsg
        ]);
    }
}
