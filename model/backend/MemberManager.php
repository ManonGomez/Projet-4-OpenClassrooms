<?php

namespace model\backend\MemberManager;

use model\backend\Manager;

class PostManager extends Manager
{


    //from connect.php
    public function getUser($pseudo, $password)
    {

        $bdd = $this->dbConnect();
        $requser = $bdd->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
        $requser->execute(array($pseudo, $password));
        return $requser;
    }


}
