<?php
include 'header.php';
include 'bdd.php';
//et supprimer les comm qui vont avec les artcilesen utilisant la jonction

if ($_SESSION['admin'] == 0) {
    header("Location: index.php");
}


$IDdelete = htmlspecialchars($_GET['id']);



require('model/model.php');
$txtcomment = gettextcom($IDdelete);

if(isset($_POST['valid']))
{
     header("Location: gestioncom.php");
}

if(isset($_POST['delete']))
{
    $delete = $bdd->prepare('DELETE FROM comment WHERE IDcomment=?');
    $delete->execute(array($IDdelete));
    $deletejonction = $bdd->prepare('DELETE FROM jonctionCA WHERE IDcommentCA=?');
    $deletejonction->execute(array($IDdelete));
    header("Location: gestioncom.php");
}

require('view/template_deletecom.php');

include 'footer.php'; 
