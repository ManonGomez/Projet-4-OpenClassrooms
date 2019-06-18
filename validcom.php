<?php
include 'header.php';
include 'bdd.php';
//et supprimer les comm qui vont avec les artcilesen utilisant la jonction

$IDval= htmlspecialchars($_GET['id']);



require('model/model.php');
$txtxomment =getComByID($IDval);

if(isset($_POST['valid']))
{
     header("Location: gestioncom.php");
}

if(isset($_POST['delete']))
{
    $rate0 = $bdd->prepare('UPDATE comment SET rate=0 WHERE IDcomment=?');
    $rate0->execute(array($IDval));
    header("Location: gestioncom.php");
}



require('view/template_validcom.php');

include 'footer.php'; 
