<?php

namespace model\backend;



class AdminManager extends Manager
{

    public function getNameArticle($IDdelete)
    {

        $bdd = $this->dbConnect();
        $namearticle = $bdd->prepare('SELECT title FROM articles WHERE Id=?');
        $namearticle->execute(array($IDdelete));
        return $namearticle;
    }

    //from deletecom.php
    public function gettextcom($IDdelete)
    {

        $bdd = $this->dbConnect();
        $txtcomment = $bdd->prepare('SELECT text FROM comments WHERE Id=?');
        $txtcomment->execute(array($IDdelete));
        return $txtcomment;
    }

    //from gestion.php
    public function getArticleBYDate()
    {

        $bdd = $this->dbConnect();
        $articles = $bdd->query('SELECT * FROM articles ORDER BY dateArticle ASC');
        return $articles;
    }

    //from gestioncom.php
    public function getCOMBYDate()
    {

        $bdd = $this->dbConnect();
        $comment = $bdd->query('SELECT * FROM comments WHERE rate >0 ORDER BY rate DESC');
        return $comment;
    }

    //from update.php
    public function getArticleUp($IDupdate)
    {

        $bdd = $this->dbConnect();
        $articles = $bdd->prepare('SELECT title, text FROM articles WHERE Id=?');
        $articles->execute(array($IDupdate));
        return $articles;
    }

    //from validcom.php
    public  function getComByID($IDval)
    {

        $bdd = $this->dbConnect();
        $txtcomment = $bdd->prepare('SELECT text FROM comments WHERE Id=?');
        $txtcomment->execute(array($IDval));
        return $txtxomment;
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
    public function signalComment($IDval){
        $bdd = $this->dbConnect();
        $rate0 = $bdd->prepare('UPDATE comments SET rate=0 WHERE Id=?');
            $rate0->execute(array($IDval));
        return $rate0;
    }
      public function deleteCom($IDdelete){
        $bdd = $this->dbConnect();
                    $delete = $bdd->prepare('DELETE FROM comments WHERE Id=?');
            $delete->execute(array($IDdelete));
        return $delete;
    }
}


