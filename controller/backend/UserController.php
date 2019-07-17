<?php
namespace controller\backend;

use model\backend\Manager;
use model\frontend\PostManager;
use controller\frontend\MainController;
use model\frontend\CommentManager;

class UserController extends MainController
{



    public function connect()
    {
        
            if (isset($_POST['formconnexion'])) {
                if (!empty($_POST['pseudo']) and !empty($_POST['password'])) {
                    $bdd->dbConnect();
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
                            header("Location: index.php");
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