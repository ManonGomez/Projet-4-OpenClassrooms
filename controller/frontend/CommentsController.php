<?php

namespace controller\frontend;

use model\frontend\CommentsManager;

class CommentsController extends MainController
{

    public function addComment($idArticle)
    {
        //ON VERIFIE QUE LES CHAMPS SONT REMPLIS
        if (!empty($_POST['pseudo']) && !empty($_POST['text'])) {
            //ON AJOUT LE COMMENTAIRE SI TOUT EST OK
            $author = $_POST['pseudo'];
            $comment = htmlspecialchars($_POST['text']);
            $commentManager = new CommentsManager();
            $affectedLines = $commentManager->postComment($idArticle, $author, $comment);

            if ($affectedLines === false) {
                $_SESSION['message'] = '<div class="alert alert-danger">Impossible d\'ajouter les commentaire</div>';
            } else {
                //SI TOUT EST OK, O, REDIRIGE VERS LA PAGE DE L'ARTICLE EN QUESTION
                $_SESSION['message'] = '<div class="alert alert-success">Tous les champs ne sont pas remplis</div>';
                header('Location: index.php?action=post&id=' . $idArticle);
            };
        } else {
            //message temporaire qui sera supprimé après la redirection
            $_SESSION['message'] = '<div class="alert alert-danger">Tous les champs ne sont pas remplis</div>';
            header('Location: index.php?action=post&id=' . $idArticle);
        }
        
        require('view/frontend/template_article.php');
    }

    public function signalComment($idComment, $idArticle)
    {
        
        if (isset($_POST['signalCom'])) {
            $commentManager = new CommentsManager();
            $affectedCom = $commentManager->signalCom($idComment);
            //creation d'un message temporaire à supprimer après la redirection
            $_SESSION['message'] = '<div class="alert alert-success">Le commentaire a bien été signalé</div>';
            header('Location: index.php?action=post&id=' . $idArticle);
            
        } else {
            //creation d'un message temporaire à supprimer après la redirection
            $_SESSION['message'] = '<div class="alert alert-danger">Le commentaire n\'a pas pu être signalé</div>';
            header('Location: index.php?action=post&id=' . $idArticle);
        }
    }
}
