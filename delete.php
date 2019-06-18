<?php
include 'header.php';
include 'bdd.php';
//et supprimer les comm qui vont avec les artcilesen utilisant la jonction
if ($_SESSION['admin'] == 0) {
    header("Location: index.php");
}

$IDdelete = htmlspecialchars($_GET['id']);

require('model/model.php');
$namearticle = getNameArticle($IDdelete);

if(isset($_POST['valid']))
{
     header("Location: gestion.php");
}

if(isset($_POST['delete']))
{
    $delete = $bdd->prepare('DELETE FROM articles WHERE IDarticle=?');
    $delete->execute(array($IDdelete));
    header("Location: gestion.php");
}

require('view/template_delete.php');

include 'footer.php'; 

