<?php
namespace controller\frontend\CommentController;

use model\frontend\CommentManager;

class CommentsController extends MainController
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
        }
    }
}
