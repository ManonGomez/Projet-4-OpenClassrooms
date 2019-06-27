<?php

require_once('model/Manager.php') ;

class PostManager extends Manager{
    
  
    //from connect.php
       public function getUser($pseudo, $password)
        {

            $bdd = $this->dbConnect();
            $requser = $bdd->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
            $requser->execute(array($pseudo, $password));
            return $requser;
        }

       
       
        //from inscription.php
       public function getMail($mail)
        {

             $bdd = $this->dbConnect();
            $reqmail = $bdd->prepare("SELECT * FROM users WHERE mail = ?");
            $reqmail->execute(array($mail));
            return $reqmail;
        }

       public function getPseudo($pseudo)
        {

             $bdd = $this->dbConnect();
            $reqpseudo = $bdd->prepare("SELECT *FROM users WHERE username = ?");
            $reqpseudo->execute(array($pseudo));
            return $reqpseudo;
        }
       

}