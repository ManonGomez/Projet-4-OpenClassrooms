<?php

namespace controller\frontend;

use model\frontend\CommentManager;

class CommentController extends MainController
{

    public function addComment($idArticle, $author, $comment)
    {
        $commentManager = new CommentManager();
        $affectedLines = $commentManager->postComment($idArticle, $author, $comment);

        if ($affectedLines === false) {
            throw new Exception('Impossible d\'ajpouter le commentaire');
        } else {
            //SI TOUT EST OK, O, REDIRIGE VERS LA PAGE DE L'ARTICLE EN QUESTION
            header('Location: index.php?action=post&id=' . $idArticle);
        };
        require('view/frontend/template_article.php');
    }

    public function rateCom($rateAdd)
    {
        if (isset($_POST['signalCom'])) {
            $message = 'Le commentaire à bien été signalé';
            //get l'id com
            //apres update dans manger rediriger vers en questio navec l'id action=post
        }
    }
}
