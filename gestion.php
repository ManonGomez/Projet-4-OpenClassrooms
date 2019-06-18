<?php
include 'header.php';
include 'bdd.php';

if ($_SESSION['admin'] == 0) {
    header("Location: index.php");
}


require('model/model.php');
$articles = getArticleBYDate();




require('view/template_gestion.php');



include 'footer.php';

