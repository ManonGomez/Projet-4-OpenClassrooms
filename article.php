<?php
include 'header.php';
include 'bdd.php';

$IDarticle = htmlspecialchars($_GET['id']);

require('model/model.php');
$article = getArticle($IDarticle);

require('model/model.php');
$comment = getJonction($IDarticle);


if(isset ($_POST['formcomment']))
{
    $pseudocomment = htmlspecialchars($_POST['pseudo']);
    $textcomment = htmlspecialchars($_POST['message']);
    
    if(!empty($pseudocomment) AND !empty($textcomment))
    {
        $pseudolenght = strlen($pseudocomment);
        if($pseudolenght <= 20 AND $pseudolenght >= 5)
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
            $error = 'Le pseudo doit avoir entre 5 et 20 lettres';
        }
    }
    else
    {
        $error = 'Veuillez compléter tous les champs';
    }
}
    
 require('view/template_article.php');   
    
?>



<?php include 'footer.php'; ?>
