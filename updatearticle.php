<?php
include 'header.php';
include 'bdd.php';
//et supprimer les comm qui vont avec les artcilesen utilisant la jonction

$IDupdate = htmlspecialchars($_GET['id']);

$articles = $bdd->prepare('SELECT titlearticle, textarticle FROM articles WHERE IDarticle=?');
$articles->execute(array($IDupdate));


        if(isset($_POST['billetup']))
        {
            if(!empty($_POST['titlearea']) AND !empty($_POST['textarea']))
            {
            $titlearticle = htmlspecialchars($_POST['titlearea']);
            $txt = htmlspecialchars($_POST['textarea']); 
            $uparticle = $bdd->prepare('UPDATE articles SET titlearticle=?, textarticle=?, datearticle=NOW()  WHERE IDarticle=?');
            $uparticle->execute(array($titlearticle, $txt, $IDupdate));
            header("Location: gestion.php");
            }
            else
            {
                $error = 'Veuillez remplir tous les champs';
            }

        }

?>

<?php while ($showarticle = $articles->fetch()) { ?>

<h3>Modification des billets</h3>
<form method="post" class="billetform">
    <input type="text" id="title" name="titlearea" value="<?= $showarticle['titlearticle'] ?>">
    <textarea id="mytextarea" name="textarea"><?= $showarticle['textarticle'] ?></textarea>
    <input type="submit" id="send" name="billetup" value="Modifier">
     <?php

        if (isset($error)) {
            echo '<p>' . $error . '</p>';
        }
                    ?>
</form>
<script>
    tinymce.init({
        selector: '#mytextarea'
    });
</script>

<?php } ?>

<?php

include 'footer.php'; 
?>