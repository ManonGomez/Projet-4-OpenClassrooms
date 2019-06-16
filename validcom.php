<?php
include 'header.php';
include 'bdd.php';
//et supprimer les comm qui vont avec les artcilesen utilisant la jonction

$IDdelete = htmlspecialchars($_GET['id']);


$txtcomment = $bdd->prepare('SELECT txtcomment FROM comment WHERE IDcomment=?');
$txtcomment->execute(array($IDdelete));

if(isset($_POST['valid']))
{
     header("Location: gestioncom.php");
}

if(isset($_POST['delete']))
{
    $rate0 = $bdd->prepare('UPDATE comment SET rate=0 WHERE IDcomment=?');
    $rate0->execute(array($IDdelete));
    header("Location: gestioncom.php");
}

?>


<?php while ($showcom = $txtcomment->fetch()) { ?>

<h3>Voulez-vous valider <?= $showcom['txtcomment'] ?> et donc le supprimer de l'espace de modération ?</h3>
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