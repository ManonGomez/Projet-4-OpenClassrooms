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
        if ($_SESSION['admin'] == 0) {
            header("Location: index.php");
        }

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
        if (empty($_SESSION['username']) and empty($_SESSION['mail'])) {
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
                            header("Location: index.php");
                        }
                    } else {
                        $error = 'Veuillez compléter tous les champs.';
                    }
                } else {
                    $error = 'Veuillez compléter tous les champs.';
                }
            }
        } else {
            header("Location: index.php");
        }

        require('view/frontend/template_connect.php');
    }

    public function disconnect()
    {
        session_start();
        $_SESSION = array();
        session_destroy();
        header("Location: index.php");
    }




    public  function gestion()
    {
        $articles = getArticleBYDate();

        if ($_SESSION['admin'] == 0) {
            header("Location: index.php");
        }
        require('view/frontend/template_gestion.php');
    }

    public    function updatearticle()
    {
        $IDupdate = htmlspecialchars($_GET['id']);

        $articles = getArticleUp($IDupdate);

        if ($_SESSION['admin'] == 0) {
            header("Location: index.php");
        }

        if (isset($_POST['billetup'])) {
            if (!empty($_POST['titlearea']) and !empty($_POST['textarea'])) {
                $titlearticle = htmlspecialchars($_POST['titlearea']);
                $txt = htmlspecialchars($_POST['textarea']);
               $uparticle = upadteArticle($titlearticle, $txt, $IDupdate);
                header("Location: template_gestion.php");
            } else {
                $error = 'Veuillez remplir tous les champs';
            }
        }

        require('view/frontend/template_updatearticle.php');
    }
    public  function delete()
    {
        $IDdelete = htmlspecialchars($_GET['id']);
        $namearticle = getNameArticle($IDdelete);
        //et supprimer les comm qui vont avec les artcilesen utilisant la jonction
        if ($_SESSION['admin'] == 0) {
            header("Location: index.php");
        }

        if (isset($_POST['valid'])) {
            header("Location: template_gestion.php");
        }

        if (isset($_POST['delete'])) {
            $delete = deleteArticle($IDdelete);
            header("Location: template_gestion.php");
        }

        require('view/frontend/template_delete.php');
    }

    public  function gestioncom()
    {
        if ($_SESSION['admin'] == 0) {
            header("Location: index.php");
        }
        $comment = getCOMBYDate();
        require('view/frontend/template_gestioncom.php');
    }

    public function validcom()
    {

        $IDval = htmlspecialchars($_GET['id']);

        $txtxomment = getComByID($IDval);

        if (isset($_POST['valid'])) {
            header("Location: template_gestioncom.php");
        }

        if (isset($_POST['delete'])) {
            $rate0 = signalComment($IDval);
            header("Location: template_gestioncom.php");
        }
        require('view/frontend/template_validcom.php');
    }

    public function deletecom()
    {
        if ($_SESSION['admin'] == 0) {
            header("Location: index.php");
        }

        $IDdelete = htmlspecialchars($_GET['id']);

        $txtcomment = gettextcom($IDdelete);

        if (isset($_POST['valid'])) {
            header("Location: template_gestioncom.php");
        }

        if (isset($_POST['delete'])) {
            $delete = deleteCom($IDdelete);
            header("Location: template_gestioncom.php");
        }

        require('view/frontend/template_deletecom.php');
    }

}