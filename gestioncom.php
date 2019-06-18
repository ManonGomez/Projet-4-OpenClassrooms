<?php
include 'header.php';
include 'bdd.php';

if ($_SESSION['admin'] == 0) {
    header("Location: index.php");
}

require('model/model.php');
$comment = getCOMBYDate();




require('view/template_gestioncom.php');


include 'footer.php';

