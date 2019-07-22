<?php
namespace controller\backend;

use model\backend\Manager;
use model\frontend\PostManager;
use controller\frontend\MainController;
use model\frontend\CommentManager;
use model\backend\UserManager;

class UserController extends MainController
{
    public function isAdmin(){
        if ( isset($_SESSION['admin']) AND $_SESSION['admin'] == 1 ) {
            return true;
        }
        else {
            return false;
        }
    }

    public function connect($pseudo, $password)
    {
        $userManager = new UserManager();
        $requser = $userManager->getUser($pseudo, $password);


        $userexist = $requser->rowCount();
        if ($userexist == 1) {
            $userdata = $requser->fetch();

            $_SESSION['username'] =  $userdata['username'];
            $_SESSION['firstname'] =  $userdata['firstname'];
            $_SESSION['lastname'] =  $userdata['lastname'];
            $_SESSION['mail'] =  $userdata['mail'];
            $_SESSION['admin'] =  $userdata['admin'];

            $message = 'Connexion établie.';
            //faire un délai ou renvoyer vers espace membre
            if ($userdata['admin'] == 1) {
                header("Location:  index.php?action=admin&page=dashboard");
            } else {
                header("Location: index.php?action=connect");
            }
        } else {
            $error = 'Veuillez compléter tous les champs.';
            header("Location: index.php?action=connect");
        }

     
    }

    public function disconnect()
    {
        session_start();
        $_SESSION = array();
        session_destroy();
        header("Location: index.php");
    }


}