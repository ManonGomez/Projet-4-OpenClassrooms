<?php
namespace model\backend;
//class Manager
class Manager
{
    protected $salt = 'security&salt#it';

    protected function dbConnect()
    {

            $bdd = new \PDO('mysql:host=sql.chaffy.net;dbname=w1vy57_phpmanon', 'w1vy57_phpmanon', '#MaBase01240#');
            return $bdd;
        }
    }
