
<?php while ($showcom = $txtcomment->fetch()) { ?>

<h3>Voulez-vous valider <?= $showcom['txtcomment'] ?> et donc le supprimer de l'espace de modération ?</h3>
<form method="post">
    <input type="submit" id="send" name="valid" value="Non" class="btn btn-outline-dark">
</form>
<form method="post">
    <input type="submit" id="send" name="delete" value="Oui" class="btn btn-outline-dark">
</form>

<?php } ?>