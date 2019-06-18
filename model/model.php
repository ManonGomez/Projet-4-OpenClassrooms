<?php
//from article.php
function getArticle($IDarticle)
{

    try {
        $bdd = new PDO('mysql:host=sql.chaffy.net;dbname=w1vy57_phpmanon', 'w1vy57_phpmanon', '#MaBase01240#');
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }

    $article = $bdd->prepare("SELECT * FROM articles WHERE IDarticle = ?");
    $article->execute(array($IDarticle));
    return $article;
}

function getJonction($IDarticle)
{

    try {
        $bdd = new PDO('mysql:host=sql.chaffy.net;dbname=w1vy57_phpmanon', 'w1vy57_phpmanon', '#MaBase01240#');
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }

    $comment = $bdd->prepare("SELECT * FROM articles, comment, jonctionCA WHERE articles.IDarticle = jonctionCA.IDarticleCA AND comment.IDcomment = jonctionCA.IDcommentCA AND jonctionCA.IDarticleCA = ? ");
    $comment->execute(array($IDarticle));
    return $comment;
}

function getComment()
{

    try {
        $bdd = new PDO('mysql:host=sql.chaffy.net;dbname=w1vy57_phpmanon', 'w1vy57_phpmanon', '#MaBase01240#');
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }

    $reqIDcomment = $bdd->query('SELECT IDcomment FROM comment WHERE IDcomment=(SELECT MAX(IDcomment) FROM comment)');
    return $reqIDcomment;
}

//from connect.php
function getUser($pseudo, $password)
{

    try {
        $bdd = new PDO('mysql:host=sql.chaffy.net;dbname=w1vy57_phpmanon', 'w1vy57_phpmanon', '#MaBase01240#');
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }

    $requser = $bdd->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
    $requser->execute(array($pseudo, $password));
    return $requser;
}

//from index.php
function getArticles()
{

    try {
        $bdd = new PDO('mysql:host=sql.chaffy.net;dbname=w1vy57_phpmanon', 'w1vy57_phpmanon', '#MaBase01240#');
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }

    $articles = $bdd->query('SELECT * FROM articles ORDER BY datearticle ASC');
    return $articles;
}

//from inscription.php
function getMail($mail)
{

    try {
        $bdd = new PDO('mysql:host=sql.chaffy.net;dbname=w1vy57_phpmanon', 'w1vy57_phpmanon', '#MaBase01240#');
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }

    $reqmail = $bdd->prepare("SELECT * FROM users WHERE mail = ?");
    $reqmail->execute(array($mail));
    return $reqmail;
}

function getPseudo($pseudo)
{

    try {
        $bdd = new PDO('mysql:host=sql.chaffy.net;dbname=w1vy57_phpmanon', 'w1vy57_phpmanon', '#MaBase01240#');
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }

    $reqpseudo = $bdd->prepare("SELECT *FROM users WHERE username = ?");
    $reqpseudo->execute(array($pseudo));
    return $reqpseudo;
}
//from delete.php
function getNameArticle($IDdelete)
{

    try {
        $bdd = new PDO('mysql:host=sql.chaffy.net;dbname=w1vy57_phpmanon', 'w1vy57_phpmanon', '#MaBase01240#');
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }

    $namearticle = $bdd->prepare('SELECT titlearticle FROM articles WHERE IDarticle=?');
$namearticle->execute(array($IDdelete));
     return $namearticle;
}