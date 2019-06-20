<?php

        require_once('model/model.php');

         public function listPosts()
        {
            $articles = getArticles();
            require('view/template_index.php');
        }

         public function Post()
        {
            $IDarticle = $_GET['id'];
            $article = getArticle($IDarticle);
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


            require('view/template_article.php');
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
            require('view/template_contact.php');
        }

        public function connect()
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
                    header("Location: member.php");
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

require('view/template_connect.php');
        }

 public function admin(){
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

require('view/template_admin.php');
}

 public function delete()
{
    //et supprimer les comm qui vont avec les artcilesen utilisant la jonction
if ($_SESSION['admin'] == 0) {
    header("Location: index.php");
}

$IDdelete = htmlspecialchars($_GET['id']);

$namearticle = getNameArticle($IDdelete);

if (isset($_POST['valid'])) {
    header("Location: gestion.php");
}

if (isset($_POST['delete'])) {
    $delete = $bdd->prepare('DELETE FROM articles WHERE IDarticle=?');
    $delete->execute(array($IDdelete));
    header("Location: gestion.php");
}

require('view/template_delete.php');
}

 public function deletecom(){
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

require('view/template_deletecom.php');
    
}

 public function gestion(){
    if ($_SESSION['admin'] == 0) {
    header("Location: index.php");
}
    
$articles = getArticleBYDate();

require('view/template_gestion.php');
}

 public function gestioncom(){
    if ($_SESSION['admin'] == 0) {
    header("Location: index.php");
}
$comment = getCOMBYDate();
require('view/template_gestioncom.php');
}

 public function disconnect(){
    session_start();
$_SESSION = array();
session_destroy();
header("Location: index.php");
}

 public function inscription(){
    if (isset($_POST['forminscription'])) {
    if (!empty($_POST['pseudo']) and !empty($_POST['firstname']) and !empty($_POST['lastname']) and !empty($_POST['mail']) and !empty($_POST['password']) and !empty($_POST['passwordconfirm'])) {
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $firstname = htmlspecialchars($_POST['firstname']);
        $lastname = htmlspecialchars($_POST['lastname']);
        $mail = htmlspecialchars($_POST['mail']);
        //hash pour encrypter et 'sha..' le format de lencyptage
        $password = hash('sha256', $salt . $_POST['password']);
        $confirmpassword = hash('sha256', $salt . $_POST['passwordconfirm']);

        if ($password == $confirmpassword) {
            $pseudolenght = strlen($pseudo);
            if ($pseudolenght <= 20 and $pseudolenght >= 5) {
                $firstnamelenght = strlen($firstname);
                if ($firstnamelenght <= 20 and $firstnamelenght >= 2) {
                    $lastnamelenght = strlen($lastname);
                    if ($lastnamelenght <= 30 and $lastnamelenght >= 2) {
                        if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                            $passwordlenght = strlen($_POST['password']);
                            if ($passwordlenght >= 5) {
                                $reqmail = getMail($mail);
                                $mailexist = $reqmail->rowCount();
                                if ($mailexist == 0) {
                                    $reqpseudo = getPseudo($pseudo);
                                    $pseudoexist = $reqpseudo->rowCount();
                                    if ($pseudoexist == 0) {
                                        $insertuser = $bdd->prepare("INSERT INTO users(username, mail, password, firstname, lastname) VALUES(?, ?, ?, ?, ?)");
                                        $insertuser->execute(array($pseudo, $mail, $password, $firstname, $lastname));
                                        $message = 'Vous avez bien été inscrit';
                                    } else {
                                        $error = 'Ce pseudo est déjà pris, veuillez en choisir un autre';
                                    }
                                } else {
                                    $error = 'Cette adresse mail est déjà enregistrée';
                                }
                            } else {
                                $error = 'Le mot de passe est trop court';
                            }
                        } else {
                            $error = 'Ce n\'est pas une adresse mail';
                        }
                    } else {
                        $error = 'Votre nom doit avoir entre 2 et 30 caractères';
                    }
                } else {
                    $error = 'Votre prénom doit avoir entre 2 et 20 caractères';
                }
            } else {
                $error = 'Le pseudo doit avoir entre 5 et 20 caractères';
            }
        } else {
            $error = 'Les mots de passe ne sont pas identiques';
        }
    } else {
        $error = 'Pas tous les champs sont remplis';
    }
}

require('view/template_inscription.php');

}

 public function member(){
    require('view/template_member.php');
}

 public function updatearticle(){
    if ($_SESSION['admin'] == 0) {
    header("Location: index.php");
}

$IDupdate = htmlspecialchars($_GET['id']);

$articles = getArticleUp($IDupdate);

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

require('view/template_updatearticle.php');
}

 public function validcom(){
    
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
require('view/template_validcom.php');
}