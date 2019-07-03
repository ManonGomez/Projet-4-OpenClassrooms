<?php
namespace controller\frontend\PostController;

use model\frontend\PostManager;
use model\frontend\CommentManager;

class PostsController extends MainController
{

    public function index()
    {
        $postManager = new PostManager();
        $articles = $postManager->getArticles();
       
        require('view/frontend/template_article.php');
    }

    public function showPost($idPost)
    {
        $postManager = new PostManager();
        $commentManager = new CommentManager();

        $article = $postManager->getArticle($idPost);
        $comments = $commentManager->getComments($idPost);
        //on test si l'article a bien été trouvé en base
        // si non, on revoi une erreur
        if ( $article ) {
            require('view/frontend/template_article.php');
        } else {
            throw new \Exception('Ce billet n\'existe pas');
        }
        
    }
}