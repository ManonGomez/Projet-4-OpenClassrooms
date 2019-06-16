<?php
include 'header.php';
include 'bdd.php';
//et supprimer les comm qui vont avec les artcilesen utilisant la jonction

$IDdelete = htmlspecialchars($_GET['id']);


$namearticle = $bdd->prepare('SELECT titlearticle FROM articles WHERE IDarticle=?');
$namearticle->execute(array($IDdelete));

if(isset($_POST['valid']))
{
     header("Location: gestion.php");
}

if(isset($_POST['delete']))
{
    $delete = $bdd->prepare('DELETE FROM articles WHERE IDarticle=?');
    $delete->execute(array($IDdelete));
    header("Location: gestion.php");
}

?>






<?php while ($showname = $namearticle->fetch()) { ?>

<h3>Voulez-vous supprimer <?= $showname['titlearticle'] ?> ?</h3>
<form method="post">
    <input type="submit" id="send" name="valid" value="Non" class="btn btn-outline-dark">
</form>
<form method="post">
    <input type="submit" id="send" name="delete" value="Oui" class="btn btn-outline-dark">
</form>

<?php } ?>

<?php

include 'footer.php'; 
?>
