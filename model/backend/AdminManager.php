<?php

namespace model\backend\AdminManager;

use model\backend\Manager;

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
}
