<?php

require_once('model/Manager.php') ;

class CommentManager extends Manager{
    
    public function getComments($IDarticle)
        {

            $bdd = $this->dbConnect();
            $comment = $bdd->prepare("SELECT * FROM articles, comment, jonctionCA WHERE articles.IDarticle = jonctionCA.IDarticleCA AND comment.IDcomment = jonctionCA.IDcommentCA AND jonctionCA.IDarticleCA = ? ");
            $comment->execute(array($IDarticle));
            return $comment;
        }

     public function getCommentID()
        {

             $bdd = $this->dbConnect();
            $reqIDcomment = $bdd->query('SELECT IDcomment FROM comment WHERE IDcomment=(SELECT MAX(IDcomment) FROM comment)');
            return $reqIDcomment;
        }
}