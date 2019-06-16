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
    $delete = $bdd->prepare('DELETE FROM comment WHERE IDcomment=?');
    $delete->execute(array($IDdelete));
    $deletejonction = $bdd->prepare('DELETE FROM jonctionCA WHERE IDcommentCA=?');
    $deletejonction->execute(array($IDdelete));
    header("Location: gestioncom.php");
}

?>






<?php while ($showcom = $txtcomment->fetch()) { ?>

<h3>Voulez-vous supprimer <?= $showcom['txtcomment'] ?> ?</h3>
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