<?php
session_start();


use model\backend\Manager;
use controller\frontend\PostsController;
use controller\frontend\CommentController;
use controller\frontend\ContactController;
use controller\frontend\AboutController;
use controller\backend\UserController;
use controller\backend\CommentGestionController;
use controller\backend\PostController;


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
            $controller = new UserController();
            $controller->connect();
        } elseif ($_GET['action'] == 'contact') {
            $controller = new ContactController();
            $controller->contact();
        } elseif ($_GET['action'] == 'admin') {
            $controller = new UserController();
            $controller->admin();
        } elseif ($_GET['action'] == 'about') {
            $controller = new AboutControlller();
            $controller->admin();
        } elseif ($_GET['action'] == 'delete') {
            $controller = new PostController();
            $controller->delete();
        } elseif ($_GET['action'] == 'deletecom') {
            $controller = new CommentGestionController();
            $controller->deletecom();
        } elseif ($_GET['action'] == 'gestion') {
            $controller = new PostController();
            $controller->gestion();
        } elseif ($_GET['action'] == 'gestioncom') {
            $controller = new CommentGestionController();
            $controller->gestioncom();
        } elseif ($_GET['action'] == 'disconnect') {
            $controller = new UserController();
            $controller->disconnect();
        } elseif ($_GET['action'] == 'updatearticle') {
            $controller = new PostController();
            $controller->updatearticle();
        }
    } else {
        $controller = new PostsController();
        $controller->index();
    }
} catch (Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}
