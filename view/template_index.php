<div class="container">
    <section id="top">
        <p>Bienvenue sur mon blog, retrouvez mon livre "Billet simple pour l'Alaska" chapître par chapître juste ici ! N'hésitez pas à me laisser un commentaire</p>

        <?php while ($showarticles = $articles->fetch()) { ?>
            <div class="completArticle">
                <!--  = apres ? permet de reprendre le php dans une boucle dit au code je remet du php qui appartient à la boule précedente ID créer-->
                <h2><a href="article.php?id=<?= $showarticles['IDarticle'] ?>"><?= $showarticles['titlearticle'] ?></a></h2>
                <p><?= htmlspecialchars_decode($showarticles['textarticle']) ?></p>
                <p><?= $showarticles['datearticle'] ?></p>
            </div>
        <?php } ?>
        <!-- {} permet defaire du php sur plusieurs lignes toujoursdans while/ fetch tableau à mieux renseigner -->
    </section>
</div>