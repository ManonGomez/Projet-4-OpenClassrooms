<?php
namespace model\frontend;


class PostManager extends Manager
{

    public function getArticle($IDarticle)
    {
        $bdd = $this->dbConnect();
        $article = $bdd->prepare("SELECT * FROM articles WHERE Id = ?");
        $article->execute(array($IDarticle));
      
        return $article->fetch();
    }

    public function getArticles()
    {

        $bdd = $this->dbConnect();
        $articles = $bdd->query('SELECT * FROM articles ORDER BY dateArticle ASC');
        return $articles;
    }
}
