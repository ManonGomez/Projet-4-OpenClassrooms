<?php
include 'header.php';
include 'bdd.php';

$IDarticle = htmlspecialchars($_GET['id']);

require('model/model.php');
$article = getArticle($IDarticle);

require('model/model.php');
$comment = getJonction($IDarticle);

        if(isset($_POST['signal']))
        {
            $signalcom = $bdd->prepare('UPDATE comment SET rate = rate + 1 WHERE IDcomment = ?');
            $signalcom->execute(array($IDarticle));   
        }

//rediriger si url id de larticle existe pas
if(isset($IDarticle))
{
    header("Location: index.php");
}

if ($_SESSION['admin'] == 0)
{
if(isset ($_POST['formcomment']))
{
    $pseudocomment = htmlspecialchars( $_SESSION['username']);
    $textcomment = htmlspecialchars($_POST['message']);
    
    if(!empty($pseudocomment) AND !empty($textcomment))
    {
       
            $textcommentlenght = strlen($textcomment);
            if($textcommentlenght <=110 AND $textcommentlenght >=4)
            {
                $insertcom = $bdd->prepare("INSERT INTO comment(txtcomment, datecomment, pseudocomment) VALUES(?, NOW(), ?)");
                $insertcom->execute(array($textcomment, $pseudocomment));
                require('model/model.php');
                $reqIDcomment = getComment();
                while ($reqID = $reqIDcomment->fetch()) {
                    $IDcomment = $reqID['IDcomment'];
                }
                $insertjonct = $bdd->prepare("INSERT INTO jonctionCA(IDarticleCA, IDcommentCA) VALUES(?, ?)");
                $insertjonct->execute(array($IDarticle, $IDcomment));
                $message='Votre commentaire à été publié'; 
            
            }
            else
            {
                $error = 'Le commentaire doit comprendre au minimum 4 cractères et au maximum 110';
            }
        
    }
    else
    {
        $error = 'Veuillez compléter tous les champs';
    }
}
    else
    {
        $display = "display:none;";
        $error = 'pour laisser un commentaire, connectez-vous ou inscrivez-vous';
    }
}

    
    
 require('view/template_article.php');   
    
include 'footer.php'; 
