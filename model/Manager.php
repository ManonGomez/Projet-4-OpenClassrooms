<?php

class Manager{
    
    protected function dbConnect(){
        
         try {
                $bdd = new PDO('mysql:host=sql.chaffy.net;dbname=w1vy57_phpmanon', 'w1vy57_phpmanon', '#MaBase01240#');
                return $bdd;
            } catch (Exception $e) {
                die('Erreur : ' . $e->getMessage());
            }
    }
}