<?php

namespace controller\backend;

use model\backend\Manager;
use model\frontend\PostManager;

//require_once('model/model.php');
//require_once('model/PostManager.php');
//class dataArticles
//{
    //ex propriete public $nom = valeur
   function listPosts()
    {
       $postManager = new PostManager();
       //print_r($postManager); 
       $articles = $postManager->getArticles();
        require('view/frontend/template_index.php');
    }
//}



 function Post()
    {
      $postManager = new PostManager();
     
        $IDarticle = $_GET['id'];
        $article = $postManager->getArticle($IDarticle);
        $comment = getComments($IDarticle);

        if ($_SESSION['admin'] == 0) {
            if (isset($_POST['formcomment'])) {
                $pseudocomment = htmlspecialchars($_SESSION['username']);
                $textcomment = htmlspecialchars($_POST['message']);

                if (!empty($pseudocomment) and !empty($textcomment)) {

                    $textcommentlenght = strlen($textcomment);
                    if ($textcommentlenght <= 110 and $textcommentlenght >= 4) {
                        $insertcom = $bdd->prepare("INSERT INTO comment(txtcomment, datecomment, pseudocomment) VALUES(?, NOW(), ?)");
                        $insertcom->execute(array($textcomment, $pseudocomment));
                        $reqIDcomment = getCommentID();
                        while ($reqID = $reqIDcomment->fetch()) {
                            $IDcomment = $reqID['IDcomment'];
                        }
                        $insertjonct = $bdd->prepare("INSERT INTO jonctionCA(IDarticleCA, IDcommentCA) VALUES(?, ?)");
                        $insertjonct->execute(array($IDarticle, $IDcomment));
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



  
function admin()
    {
        if ($_SESSION['admin'] == 0) {
            header("Location: index.php");
        }

        if (isset($_POST['billetvalid'])) {
            if (!empty($_POST['textarea']) and !empty($_POST['titlearea'])) {
                $titlearticle = htmlspecialchars($_POST['titlearea']);
                $textarticle = htmlspecialchars($_POST['textarea']);
                $insertarticle = $bdd->prepare("INSERT INTO articles (titlearticle, textarticle, datearticle) VALUES (?, ?, NOW())");
                $insertarticle->execute(array($titlearticle, $textarticle));
                // -> = pour preparer et executer la bdd
                $message = "L'article à bien été posté";
            } else {
                $error = "Veuillez remplir tous les champs";
            }
        }

        require('view/frontend/template_admin.php');
    }


   function connect()
    {
        if (empty($_SESSION['username']) and empty($_SESSION['mail'])) {
            if (isset($_POST['formconnexion'])) {
                if (!empty($_POST['pseudo']) and !empty($_POST['password'])) {
                    $pseudo = htmlspecialchars($_POST['pseudo']);
                    $password = hash('sha256', $salt . $_POST['password']);
                    $requser = getUser($pseudo, $password);
                    $userexist = $requser->rowCount();
                    if ($userexist == 1) {
                        $userdata = $requser->fetch();

                        $_SESSION['username'] =  $userdata['username'];
                        $_SESSION['firstname'] =  $userdata['firstname'];
                        $_SESSION['lastname'] =  $userdata['lastname'];
                        $_SESSION['mail'] =  $userdata['mail'];
                        $_SESSION['admin'] =  $userdata['admin'];

                        $message = 'Connexion établie.';
                        //faire un délai ou renvoyer vers espace membre
                        if ($userdata['admin'] == 1) {
                            header("Location: admin.php");
                        } else {
                            header("Location: index.php");
                        }
                    } else {
                        $error = 'Veuillez compléter tous les champs.';
                    }
                } else {
                    $error = 'Veuillez compléter tous les champs.';
                }
            }
        } else {
            header("Location: index.php");
        }

        require('view/frontend/template_connect.php');
    }

function disconnect()
    {
        session_start();
        $_SESSION = array();
        session_destroy();
        header("Location: index.php");
    }




     function gestion()
    {
        $articles = getArticleBYDate();
        
        if ($_SESSION['admin'] == 0) {
            header("Location: index.php");
        }
        require('view/frontend/template_gestion.php');
    }

     function updatearticle()
    {
        $IDupdate = htmlspecialchars($_GET['id']);

        $articles = getArticleUp($IDupdate);

        if ($_SESSION['admin'] == 0) {
            header("Location: index.php");
        }

        if (isset($_POST['billetup'])) {
            if (!empty($_POST['titlearea']) and !empty($_POST['textarea'])) {
                $titlearticle = htmlspecialchars($_POST['titlearea']);
                $txt = htmlspecialchars($_POST['textarea']);
                $uparticle = $bdd->prepare('UPDATE articles SET titlearticle=?, textarticle=?, datearticle=NOW()  WHERE IDarticle=?');
                $uparticle->execute(array($titlearticle, $txt, $IDupdate));
                header("Location: gestion.php");
            } else {
                $error = 'Veuillez remplir tous les champs';
            }
        }

        require('view/frontend/template_updatearticle.php');
    }
     function delete()
    {
        $IDdelete = htmlspecialchars($_GET['id']);
        $namearticle = getNameArticle($IDdelete);
        //et supprimer les comm qui vont avec les artcilesen utilisant la jonction
        if ($_SESSION['admin'] == 0) {
            header("Location: index.php");
        }

        if (isset($_POST['valid'])) {
            header("Location: gestion.php");
        }

        if (isset($_POST['delete'])) {
            $delete = $bdd->prepare('DELETE FROM articles WHERE IDarticle=?');
            $delete->execute(array($IDdelete));
            header("Location: gestion.php");
        }

        require('view/frontend/template_delete.php');
    }

    function gestioncom()
    {
        if ($_SESSION['admin'] == 0) {
            header("Location: index.php");
        }
        $comment = getCOMBYDate();
        require('view/frontend/template_gestioncom.php');
    }

    function validcom()
    {

        $IDval = htmlspecialchars($_GET['id']);

        $txtxomment = getComByID($IDval);

        if (isset($_POST['valid'])) {
            header("Location: gestioncom.php");
        }

        if (isset($_POST['delete'])) {
            $rate0 = $bdd->prepare('UPDATE comment SET rate=0 WHERE IDcomment=?');
            $rate0->execute(array($IDval));
            header("Location: gestioncom.php");
        }
        require('view/frontend/template_validcom.php');
    }

  function deletecom()
    {
        if ($_SESSION['admin'] == 0) {
            header("Location: index.php");
        }

        $IDdelete = htmlspecialchars($_GET['id']);

        $txtcomment = gettextcom($IDdelete);

        if (isset($_POST['valid'])) {
            header("Location: gestioncom.php");
        }

        if (isset($_POST['delete'])) {
            $delete = $bdd->prepare('DELETE FROM comment WHERE IDcomment=?');
            $delete->execute(array($IDdelete));
            $deletejonction = $bdd->prepare('DELETE FROM jonctionCA WHERE IDcommentCA=?');
            $deletejonction->execute(array($IDdelete));
            header("Location: gestioncom.php");
        }

        require('view/frontend/template_deletecom.php');
    }



   function contact()
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