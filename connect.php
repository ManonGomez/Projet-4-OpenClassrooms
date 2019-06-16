<?php
include 'header.php';
include 'bdd.php';

if (empty($_SESSION['username']) and empty($_SESSION['mail'])) {
    if (isset($_POST['formconnexion'])) {
        if (!empty($_POST['pseudo']) and !empty($_POST['password'])) {
            $pseudo = htmlspecialchars($_POST['pseudo']);
            $password = hash('sha256', $salt . $_POST['password']);
            require('model/model.php');
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

include 'footer.php';
