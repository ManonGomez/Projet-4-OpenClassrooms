<?php
namespace controller\backend;

use model\backend\Manager;
use model\frontend\PostManager;
use controller\frontend\MainController;
use model\frontend\CommentManager;

class UserController extends MainController
{


public function admin()
    {
      //  if ($_SESSION['admin'] == 0) {
           // header("Location: index.php");
      //  }
//faire page pour ecrire
        if (isset($_POST['billetvalid'])) {
            if (!empty($_POST['textarea']) and !empty($_POST['titlearea'])) {
                $titlearticle = htmlspecialchars($_POST['titlearea']);
                $textarticle = htmlspecialchars($_POST['textarea']);
                $insertarticle = insertArticle($titlearticle, $textarticle);
                // -> = pour preparer et executer la bdd
                $message = "L'article à bien été posté";
            } else {
                $error = "Veuillez remplir tous les champs";
            }
        }

        require('view/frontend/template_admin.php');
    }


    public function connect()
    {
        
            if (isset($_POST['formconnexion'])) {
                if (!empty($_POST['pseudo']) and !empty($_POST['password'])) {
                    $pseudo = htmlspecialchars($_POST['pseudo']);
                    $password = hash('sha256', $salt . $_POST['password']);
                    $requser = getUser($pseudo, $password);
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
                            header("Location: template_admin.php");
                        } else {
                           // header("Location: index.php");
                        }
                    } else {
                        $error = 'Veuillez compléter tous les champs.';
                    }
                } else {
                    $error = 'Veuillez compléter tous les champs.';
                }
            }
    
            require'view/frontend/template_connect.php';
     
    }

    public function disconnect()
    {
        session_start();
        $_SESSION = array();
        session_destroy();
        header("Location: index.php");
    }


}