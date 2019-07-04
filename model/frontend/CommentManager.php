<?php
namespace model\frontend;



class CommentManager extends Manager
{

    public function getComments($IDarticle)
    {

        $bdd = $this->dbConnect();
         $comment = $bdd->prepare("SELECT * FROM comments WHERE Id = ? ORDER BY dateComment DESC");
        $comment->execute(array($IDarticle));
        return $comment;
    }

    public function getCommentID()
    {

        $bdd = $this->dbConnect();
        $reqIDcomment = $bdd->query('SELECT Id FROM comments WHERE Id=(SELECT MAX(Id) FROM comments)');
        return $reqIDcomment;
    }
    
      public function postComment($idArticle, $author, $comment) {

        $bdd = $this->dbConnect();
        $comments = $bdd->prepare( 'INSERT INTO comments(IdArticle, pseudo, text, rate) VALUES(?,?,?,NOW() )');
        $affectedLines = $comments->execute(array($idArticle, $author, $comment));

        return $affectedLines;
    }
}
