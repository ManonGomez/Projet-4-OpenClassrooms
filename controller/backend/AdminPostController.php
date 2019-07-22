<?php
//ajouter création des billets et espace admin deux boutons qui redirigent vers ou articles ou comm
namespace controller\backend;

use model\backend\Manager;
use controller\frontend\MainController;
use model\frontend\CommentManager;
use model\backend\PostManager;

class AdminPostController extends MainController
{
    public  function adminPosts()
    {

        $postManager = new PostManager();
        $articles = $postManager->getArticleBYDate();

        require('view/backend/template_gestion.php');
    }

    
    
    public function createPost()
    {
        $postManager = new PostManager();

        //faire page pour ecrire
        if (isset($_POST['billetvalid'])) {
            if (!empty($_POST['textarea']) and !empty($_POST['titlearea'])) {
                $titlearticle = htmlspecialchars($_POST['titlearea']);
                $textarticle = htmlspecialchars($_POST['textarea']);

                $insertarticle = $postManager->createArticle($titlearticle, $textarticle);
                // -> = pour preparer et executer la bdd
                $message = "L'article à bien été posté";
                header("Location:  index.php?action=admin&page=listposts&page=editpost&id=".$insertarticle);
            } else {
                $error = "Veuillez remplir tous les champs";
            }
        }

        require('view/backend/template_create.php');
    }

    
    public function updatePost($idPost)
    {
        $postManager = new PostManager();
        $articles = $postManager->getArticleById($idPost);

        if (isset($_POST['billetup'])) {
            if (!empty($_POST['titlearea']) and !empty($_POST['textarea'])) {
                $titlearticle = htmlspecialchars($_POST['titlearea']);
                $txt = htmlspecialchars($_POST['textarea']);

                $uparticle = $postManager->upadteArticle($titlearticle, $txt, $idPost);
                header("Location:  index.php?action=admin&page=listposts&page=editpost&id=".$idPost);
            } else {
                $error = 'Veuillez remplir tous les champs';
                header("Location:  index.php?action=admin&page=editpost&page=editpost&id=".$idPost);
            }
        }

        require('view/backend/template_updatearticle.php');
    }

    public function delete($idPost)
    {
        $postManager = new PostManager();
        $IDdelete = htmlspecialchars($_GET['id']);
        //et supprimer les comm qui vont avec les artcilesen utilisant la jonction
        if ($_SESSION['admin'] == 0) {
            header("Location: index.php");
        }

        if (isset($_POST['valid'])) {
            header("Location:  index.php?action=admin&page=listposts");
        }

        if (isset($_POST['delete'])) {
            $delete = $postManager->deleteArticle($idPost);
            header("Location:  index.php?action=admin&page=listposts");
        }

        require('view/backend/template_delete.php');
    }
}
