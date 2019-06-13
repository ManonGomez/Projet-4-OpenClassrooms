<?php
 function getArticle($IDarticle){
     
     try
     {
         $bdd= new PDO('mysql:host=sql.chaffy.net;dbname=w1vy57_phpmanon', 'w1vy57_phpmanon', '#MaBase01240#');
     }
     
     catch(Exception $e)
     {
        die('Erreur : '.$e->getMessage());
     }

     $article = $bdd->prepare("SELECT * FROM articles WHERE IDarticle = ?");
     $article->execute(array($IDarticle));
     return $article;
 }