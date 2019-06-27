<?php

require_once('model/Manager.php') ;

class AdminManager extends Manager{
    
      public function getNameArticle($IDdelete)
        {

            $bdd = $this->dbConnect();
            $namearticle = $bdd->prepare('SELECT titlearticle FROM articles WHERE IDarticle=?');
            $namearticle->execute(array($IDdelete));
            return $namearticle;
        }

        //from deletecom.php
        public function gettextcom($IDdelete)
        {

            $bdd = $this->dbConnect();
            $txtcomment = $bdd->prepare('SELECT txtcomment FROM comment WHERE IDcomment=?');
            $txtcomment->execute(array($IDdelete));
            return $txtcomment;
        }

        //from gestion.php
        public function getArticleBYDate()
        {

            $bdd = $this->dbConnect();
            $articles = $bdd->query('SELECT * FROM articles ORDER BY datearticle ASC');
            return $articles;
        }

        //from gestioncom.php
       public function getCOMBYDate()
        {

            $bdd = $this->dbConnect();
            $comment = $bdd->query('SELECT * FROM comment WHERE rate >0 ORDER BY rate DESC');
            return $comment;
        }

        //from update.php
         public function getArticleUp($IDupdate)
        {

             $bdd = $this->dbConnect();
            $articles = $bdd->prepare('SELECT titlearticle, textarticle FROM articles WHERE IDarticle=?');
            $articles->execute(array($IDupdate));
            return $articles;
        }

        //from validcom.php
      public  function getComByID($IDval)
        {

            $bdd = $this->dbConnect();
            $txtcomment = $bdd->prepare('SELECT txtcomment FROM comment WHERE IDcomment=?');
            $txtcomment->execute(array($IDval));
            return $txtxomment;
        }
    

}