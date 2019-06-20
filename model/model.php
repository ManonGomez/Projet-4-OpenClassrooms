<?php
        function dbConnect()
        {
            try {
                $bdd = new PDO('mysql:host=sql.chaffy.net;dbname=w1vy57_phpmanon', 'w1vy57_phpmanon', '#MaBase01240#');
                return $bdd;
            } catch (Exception $e) {
                die('Erreur : ' . $e->getMessage());
            }
        }

        //from article.php
        function getArticle($IDarticle)
        {
            $bdd = dbConnect();
            $article = $bdd->prepare("SELECT * FROM articles WHERE IDarticle = ?");
            $article->execute(array($IDarticle));
            return $article;
        }

        function getComments($IDarticle)
        {

            $bdd = dbConnect();
            $comment = $bdd->prepare("SELECT * FROM articles, comment, jonctionCA WHERE articles.IDarticle = jonctionCA.IDarticleCA AND comment.IDcomment = jonctionCA.IDcommentCA AND jonctionCA.IDarticleCA = ? ");
            $comment->execute(array($IDarticle));
            return $comment;
        }

        function getCommentID()
        {

            $bdd = dbConnect();
            $reqIDcomment = $bdd->query('SELECT IDcomment FROM comment WHERE IDcomment=(SELECT MAX(IDcomment) FROM comment)');
            return $reqIDcomment;
        }

        //from connect.php
        function getUser($pseudo, $password)
        {

            $bdd = dbConnect();
            $requser = $bdd->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
            $requser->execute(array($pseudo, $password));
            return $requser;
        }

        //from index.php
        function getArticles()
        {

            $bdd = dbConnect();
            $articles = $bdd->query('SELECT * FROM articles ORDER BY datearticle ASC');
            return $articles;
        }

        //from inscription.php
        function getMail($mail)
        {

            $bdd = dbConnect();
            $reqmail = $bdd->prepare("SELECT * FROM users WHERE mail = ?");
            $reqmail->execute(array($mail));
            return $reqmail;
        }

        function getPseudo($pseudo)
        {

            $bdd = dbConnect();
            $reqpseudo = $bdd->prepare("SELECT *FROM users WHERE username = ?");
            $reqpseudo->execute(array($pseudo));
            return $reqpseudo;
        }
        //from delete.php
        function getNameArticle($IDdelete)
        {

            $bdd = dbConnect();
            $namearticle = $bdd->prepare('SELECT titlearticle FROM articles WHERE IDarticle=?');
            $namearticle->execute(array($IDdelete));
            return $namearticle;
        }

        //from deletecom.php
        function gettextcom($IDdelete)
        {

            $bdd = dbConnect();
            $txtcomment = $bdd->prepare('SELECT txtcomment FROM comment WHERE IDcomment=?');
            $txtcomment->execute(array($IDdelete));
            return $txtcomment;
        }

        //from gestion.php
        function getArticleBYDate()
        {

            $bdd = dbConnect();
            $articles = $bdd->query('SELECT * FROM articles ORDER BY datearticle ASC');
            return $articles;
        }

        //from gestioncom.php
        function getCOMBYDate()
        {

            $bdd = dbConnect();
            $comment = $bdd->query('SELECT * FROM comment WHERE rate >0 ORDER BY rate DESC');
            return $comment;
        }

        //from update.php
        function getArticleUp($IDupdate)
        {

            $bdd = dbConnect();
            $articles = $bdd->prepare('SELECT titlearticle, textarticle FROM articles WHERE IDarticle=?');
            $articles->execute(array($IDupdate));
            return $articles;
        }

        //from validcom.php
        function getComByID($IDval)
        {

            $bdd = dbConnect();
            $txtcomment = $bdd->prepare('SELECT txtcomment FROM comment WHERE IDcomment=?');
            $txtcomment->execute(array($IDval));
            return $txtxomment;
        }
