<?php $title = 'Billet simple pour l\'Alaska'; ?>

<?php ob_start(); ?>
<div class="container">
    <section id="top">
        <p>Bienvenue sur mon blog, retrouvez mon livre "Billet simple pour l'Alaska" chapître par chapître juste ici ! N'hésitez pas à me laisser un commentaire</p>

        <?php while ($showarticles = $articles->fetch()) { ?>
           <div class="card">
                <!--  = apres ? permet de reprendre le php dans une boucle dit au code je remet du php qui appartient à la boule précedente ID créer-->
                <div class="card-header">
                <h2><a href="index.php?action=post&id=<?= $showarticles['Id'] ?>"><?= $showarticles['title'] ?></a></h2>
               </div>
               <div class="card-body">
                <p><?= htmlspecialchars_decode($showarticles['text']) ?></p>
                <p><?= $showarticles['dateArticle'] ?></p>
               </div>
            </div>
        <?php } ?>
        <!-- {} permet defaire du php sur plusieurs lignes toujoursdans while/ fetch tableau à mieux renseigner -->
    </section>
</div>
<?php $content = ob_get_clean(); ?>
<?php require('view/frontend/template.php'); ?>
