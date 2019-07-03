<?php
session_start();

include 'view/frontend/header.php';

//require('controller/controller.php');
use model\backend\Manager;
//frontend 
use controller\frontend\PostsController;
use controller\frontend\CommentsController;

require_once('SplClassLoader.php');
$autoLoader = new SplClassLoader('OCFram', '/lib');
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
                if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                    //ON AJOUT LE COMMENTAIRE SI TOUT EST OK
                    $controller = new CommentsController();
                    $controller->addComment($_GET['id'], $_POST['author'], $_POST['comment']);
                } else {
                    throw new Exception('Tous les champs ne sont pas remplis');
                }
            } else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
    } elseif ($_GET['action'] == 'contact') {
        contact();
    }
    elseif($_GET['action'] == 'connect')
    {
        connect();
    }
    elseif($_GET['action'] == 'admin')
    {
        admin();
    }
    elseif($_GET['action'] == 'delete')
    {
        delete();
    }
    elseif($_GET['action'] == 'deletecom'){
        deletecom();
    }
    elseif($_GET['action'] == 'gestion'){
        gestion();
    }
    elseif($_GET['action'] == 'gestioncom'){
        gestioncom();
    }
     elseif($_GET['action'] == 'disconnect'){
        disconnect();
    }
   
    elseif($_GET['action'] == 'updatearticle'){
        updatearticle();
    }
} else {
    $controller = new PostsController();
        $controller->index();
}
}
catch(Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}



include 'view/front-end/footer.php';
