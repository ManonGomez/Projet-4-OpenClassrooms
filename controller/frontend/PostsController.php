<?php

namespace controller\frontend;

use model\frontend\PostManager;
use model\frontend\CommentManager;


class PostsController extends MainController
{

    public function index()
    {
        $postManager = new PostManager();
        $articles = $postManager->getArticles();

        require('view/frontend/template_index.php');
    }

    public function showPost($idPost)
    {
        $postManager = new PostManager();
        $commentManager = new CommentManager();

        $article = $postManager->getArticle($idPost);
        $comments = $commentManager->getComments($idPost);
        //on test si l'article a bien été trouvé en base
        // si non, on revoi une erreur
        if ($article) {
            require('view/frontend/template_article.php');
        } else {
            throw new \Exception('Ce billet n\'existe pas');
        }
    }


    public function listPosts()
    {
        $postManager = new PostManager();
        //print_r($postManager); 
        $articles = $postManager->getArticles();
        require('view/frontend/template_index.php');
    }
    //}



    public function Post()
    {
        $postManager = new PostManager();

        $IDarticle = $_GET['id'];
        $article = $postManager->getArticle($IDarticle);
        $comment = getComments($IDarticle);

        if ($_SESSION['admin'] == 0) {
            if (isset($_POST['formcomment'])) {
                //$pseudocomment = htmlspecialchars($_SESSION['username']);
                $textcomment = htmlspecialchars($_POST['message']);
                //!empty($pseudocomment)and
                if (!empty($textcomment)) {

                    $textcommentlenght = strlen($textcomment);
                    if ($textcommentlenght <= 110 and $textcommentlenght >= 4) {
                        $insertcom = $bdd->prepare("INSERT INTO comments(text, dateComment, pseudo) VALUES(?, NOW(), ?)");
                        $insertcom->execute(array($textcomment, $pseudocomment));
                        $reqIDcomment = getCommentID();
                        while ($reqID = $reqIDcomment->fetch()) {
                            $IDcomment = $reqID['Id'];
                        }
                        $message = 'Votre commentaire à été publié';
                    } else {
                        $error = 'Le commentaire doit comprendre au minimum 4 cractères et au maximum 110';
                    }
                } else {
                    $error = 'Veuillez compléter tous les champs';
                }
            } else {
                $display = "display:none;";
                $error = 'pour laisser un commentaire, connectez-vous ou inscrivez-vous';
            }
        }


        require('view/frontend/template_article.php');
    }
}
