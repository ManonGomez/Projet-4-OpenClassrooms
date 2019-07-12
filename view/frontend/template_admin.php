<?php $title = 'Votre espace'; ?>


<?php ob_start(); ?>
<h2>Bienvenue Jean</h2>

<div class="card">
    <div class="card-body">
        <h3 class="card-title">Que voulez-vous faire ?</h3>
        <input class="btn btn-outline-dark" id="send" href="view/frontend/template_gestion.php" type="submit" value="Gérer les articles">
        <input class="btn btn-outline-dark" id="send" href="view/frontend/template_gestioncom.php" type="submit" value="Modérerles commentaires">
    </div>
</div>
<?php $content = ob_get_clean(); ?>
<?php require('view/frontend/template.php'); ?>
