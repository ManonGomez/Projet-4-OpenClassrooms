<?php

namespace controller\backend;

use model\backend\Manager;
use model\frontend\PostManager;
use controller\frontend\MainController;

//require_once('model/model.php');
//require_once('model/PostManager.php');
//class dataArticles
//{
//ex propriete public $nom = valeur
class controller extends MainController
{

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
                if (  !empty($textcomment)) {

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




    

    public  function contact()
    {
        if (isset($_POST['formcontact'])) {
            $origin = "Contact Billet simple pour l'Alaska";
            $sujet = htmlspecialchars($_POST['subject']);
            $pseudo = htmlspecialchars($_POST['pseudo']);
            $mail = htmlspecialchars($_POST['mail']);
            $text = htmlspecialchars($_POST['message']);

            if (!empty($pseudo) and !empty($mail) and !empty($sujet) and !empty($text)) {
                if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                    $headers = 'MIME-Version: 1.0' . "\r\n";
                    $headers .= 'Content-type: text/html; charset=utf8' . "\r\n";
                    $headers .= 'From: "' . $pseudo . '"<' . $mail . '>' . "\n";
                    $headers .= 'Reply-To: ' . $mail . '' . "\n";

                    $for = 'manon.gomez@chaffy.net';

                    $contenu = '<html>';
                    $contenu .= '<head><title>' . $origin . '</title></head>';
                    $contenu .= '<body><h4>' . $pseudo . '</h4>';
                    $contenu .= '<h5>' . $mail . '</h5>';
                    $contenu .= '<h5>' . $sujet . '</h5>';
                    $contenu .= '<p>' . $text . '</p></body>';
                    $contenu .= '</html>';
                    // erreur à ce niveau
                    mail($for, $contenu, $headers);

                    $message = 'Votre message à bien été envoyé.';
                } else {
                    $error = 'Erreur dans l\'adresse mail';
                }
            } else {
                $error = 'Veuillez remplir tous les champs';
            }
        }
        require('view/frontend/template_contact.php');
    }
}
