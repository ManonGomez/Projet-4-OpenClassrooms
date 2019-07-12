<?php

namespace model\backend;



class PostManager extends Manager
{
    
    public function getNameArticle($IDdelete)
    {

        $bdd = $this->dbConnect();
        $namearticle = $bdd->prepare('SELECT title FROM articles WHERE Id=?');
        $namearticle->execute(array($IDdelete));
        return $namearticle;
    }
    
    public function getArticleBYDate()
    {

        $bdd = $this->dbConnect();
        $articles = $bdd->query('SELECT * FROM articles ORDER BY dateArticle ASC');
        return $articles;
    }

     public function getArticleUp($IDupdate)
    {

        $bdd = $this->dbConnect();
        $articles = $bdd->prepare('SELECT title, text FROM articles WHERE Id=?');
        $articles->execute(array($IDupdate));
        return $articles;
    }
    
      public  function insertArticle($titlearticle, $textarticle)
    {

        $bdd = $this->dbConnect();
         $insertarticle = $bdd->prepare("INSERT INTO articles (titlearticle, textarticle, datearticle) VALUES (?, ?, NOW())");
        $insertarticle->execute(array($titlearticle, $textarticle));
        return $insertarticle;
    }
    
    public function upadteArticle($titlearticle, $txt, $IDupdate){
        $bdd = $this->dbConnect();
        $uparticle = $bdd->prepare('UPDATE articles SET title=?, text=?, dateArticle=NOW()  WHERE Id=?');
                $uparticle->execute(array($titlearticle, $txt, $IDupdate));
        return $uparticle
    }
    
     public  function deleteArticle($IDdelete)
    {

        $bdd = $this->dbConnect();
         $delete = $bdd->prepare('DELETE FROM articles WHERE Id=?');
            $delete->execute(array($IDdelete));
        return $delete;
    }
    
    
    
}