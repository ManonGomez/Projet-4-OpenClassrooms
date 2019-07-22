<?php
session_start();


use model\backend\Manager;
use controller\frontend\PostsController;
use controller\frontend\CommentController;
use controller\frontend\ContactController;
use controller\frontend\AboutController;
use controller\backend\UserController;
use controller\backend\CommentGestionController;
use controller\backend\AdminPostController;
use controller\backend\AdminController;

require_once('SplClassLoader.php');
$autoLoader = new SplClassLoader();
$autoLoader->register();

try {
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'listPosts') {
            //appel du bon controller qui permet de gérer la homepage et la liste des posts
            $controller = new PostsController();
            $controller->index();
        } elseif ($_GET['action'] == 'post') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $controller = new PostsController();
                $controller->showPost($_GET['id']);
            } else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        } //AJOUT DES COMMENTAIRES 
        elseif ($_GET['action'] == 'addComment') {

            //ON VERIFIE LA PRÉSENCE DE L'ID DANS L'URL
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                //ON VERIFIE QUE LES CHAMPS SONT REMPLIS
                if (!empty($_POST['pseudo']) && !empty($_POST['text'])) {
                    //ON AJOUT LE COMMENTAIRE SI TOUT EST OK
                    $controller = new CommentController();
                    $controller->addComment($_GET['id'], $_POST['pseudo'], $_POST['text']);
                } else {
                    throw new Exception('Tous les champs ne sont pas remplis');
                }
            } else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        } elseif ($_GET['action'] == 'connect') {

            if (isset($_POST['formconnexion'])) {
                if (!empty($_POST['pseudo']) and !empty($_POST['password'])) {

                    $pseudo = htmlspecialchars($_POST['pseudo']);
                    $password = $_POST['password'];

                    $controller = new UserController();
                    $controller->connect($pseudo, $password);
                } else { }
            } else {
                require 'view/frontend/template_connect.php';
            }
        }
        //Deconnexion
        elseif ($_GET['action'] == 'disconnect') {
            $userController = new UserController();
            $userController->disconnect();
        }
        //on regroupe ce qui concerne l'admin dans un seul if
        elseif ($_GET['action'] == 'admin') {

            $userController = new UserController();
            $isAdmin = $userController->isAdmin();
            //on teste si l'utilisateur est bien connecté
            if ($isAdmin) {

                $controller = new AdminController();
                $adminPostController = new AdminPostController();
                //page d'accueil de l'admin
                if ($_GET['page'] == 'dashboard') {
                    $controller->dashboard();
                }
                //liste des articles dans l'admin
                elseif ($_GET['page'] == 'listposts') {
                    $adminPostController->adminPosts();
                }
                //page de creation d'un billet
                elseif ($_GET['page'] == 'createpost') {
                    $adminPostController->createPost();
                }
                //page d'édition d'un post
                elseif ($_GET['page'] == 'editpost') {

                    if (isset($_GET['id']) && $_GET['id'] > 0) {
                        $adminPostController->updatePost($_GET['id']);
                    } else {
                        throw new Exception('Aucun identifiant de billet envoyé');
                    }
                } elseif ($_GET['page'] == 'deletepost') {
                    $adminPostController->delete();
                }
                //il faut ajouter ici les autres action liées à l'admin

            }
            //sinon accès interdit
            else {
                throw new Exception('Accès non autorisé');
            }
        } elseif ($_GET['action'] == 'contact') {
            $controller = new ContactController();
            $controller->contact();
        } elseif ($_GET['action'] == 'about') {
            $controller = new AboutControlller();
            $controller->about();
        } elseif ($_GET['action'] == 'deletecom') {
            $controller = new CommentGestionController();
            $controller->deletecom();
        } elseif ($_GET['action'] == 'gestioncom') {
            $controller = new CommentGestionController();
            $controller->gestioncom();
        }
    } else {
        $controller = new PostsController();
        $controller->index();
    }
} catch (Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}
