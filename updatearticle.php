<?php
include 'header.php';
include 'bdd.php';
//et supprimer les comm qui vont avec les artcilesen utilisant la jonction
if ($_SESSION['admin'] == 0) {
    header("Location: index.php");
}

$IDupdate = htmlspecialchars($_GET['id']);



require('model/model.php');
$articles = getArticleUp($IDupdate);


        if(isset($_POST['billetup']))
        {
            if(!empty($_POST['titlearea']) AND !empty($_POST['textarea']))
            {
            $titlearticle = htmlspecialchars($_POST['titlearea']);
            $txt = htmlspecialchars($_POST['textarea']); 
            $uparticle = $bdd->prepare('UPDATE articles SET titlearticle=?, textarticle=?, datearticle=NOW()  WHERE IDarticle=?');
            $uparticle->execute(array($titlearticle, $txt, $IDupdate));
            header("Location: gestion.php");
            }
            else
            {
                $error = 'Veuillez remplir tous les champs';
            }

        }



require('view/template_updatearticle.php');

include 'footer.php'; 
