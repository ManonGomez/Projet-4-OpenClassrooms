<?php
include 'header.php';
include 'bdd.php';

if($_SESSION['admin'] == 0)
{
     header("Location: index.php");
    
}

    if(isset ($_POST['billetvalid']))
    {
        if(!empty($_POST['textarea']) AND !empty($_POST['titlearea']))
        {
            $titlearticle = htmlspecialchars($_POST['titlearea']);
            $textarticle = htmlspecialchars($_POST['textarea']);
            
            $insertarticle = $bdd->prepare("INSERT INTO articles (titlearticle, textarticle, datearticle) VALUES (?, ?, NOW())");
            $insertarticle->execute(array($titlearticle, $textarticle));
                // -> = pour preparer et executer la bdd
            $message = "L'article à bien été posté";
            
        
        }
        else
         {
            $error = "Veuillez remplir tous les champs" ;  
         }
    }

 require('view/template_admin.php');

?>

<?php include 'footer.php'; ?>
<script>
    tinymce.init({
        selector: '#mytextarea'
    });
</script>
