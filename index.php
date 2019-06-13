<?php 
    include 'header.php';
    include'bdd.php';

    //query utilisé car pas besoin de sécuriser la requette sql car pas de parametre de l'utilisateur 
    require('model/model.php');
    $articles = getArticles();
    //desc pour descendant = + grand au + petit  
         require('view/template_index.php');  
?>

<?php include 'footer.php'; ?>