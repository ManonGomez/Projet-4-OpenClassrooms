<?php

namespace model\backend;



class CommentManager extends Manager
{
    public function gettextcom($IDdelete)
    {

        $bdd = $this->dbConnect();
        $txtcomment = $bdd->prepare('SELECT text FROM comments WHERE Id=?');
        $txtcomment->execute(array($IDdelete));
        return $txtcomment;
    }

    public function getCOMBYDate()
    {

        $bdd = $this->dbConnect();
        $comment = $bdd->query('SELECT * FROM comments WHERE rate >0 ORDER BY rate DESC');
        return $comment;
    }

    public  function getComByID($IDval)
    {

        $bdd = $this->dbConnect();
        $txtcomment = $bdd->prepare('SELECT text FROM comments WHERE Id=?');
        $txtcomment->execute(array($IDval));
        return $txtxomment;
    }

    public function signalComment($IDval)
    {
        $bdd = $this->dbConnect();
        $rate0 = $bdd->prepare('UPDATE comments SET rate=0 WHERE Id=?');
        $rate0->execute(array($IDval));
        return $rate0;
    }
    public function deleteCom($IDdelete)
    {
        $bdd = $this->dbConnect();
        $delete = $bdd->prepare('DELETE FROM comments WHERE Id=?');
        $delete->execute(array($IDdelete));
        return $delete;
    }
}
