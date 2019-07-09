<?php $title = ['title']; ?>

<?php ob_start(); ?>

<?php while ($dataarticle = $article->fetch()) { ?>
<div class="articleComplet">
    <h2><?= $dataarticle['title'] ?></h2>
    <p><?= htmlspecialchars_decode($dataarticle['text']) ?></p>
    <p><?= $dataarticle['dateArticle'] ?></p>
</div>
<?php } ?>

<form method="post" class="commentform">

    <div class="form-group">
        <label for="exampleFormControlInput1"></label>
        <input class="field form-control" type="text" name="pseudo" id="pseudo" required="" autofocus="" placeholder="Pseudo" value="">
    </div>

    <div class="form-group">
        <label for="exampleFormControlInput2"></label>
        <textarea name="message" id="message" class="form-control" rows="3" placeholder="Votre commentaire"></textarea>
    </div>

    <input type="submit" id="send" name="formcomment" value="Commenter" class="btn btn-outline-dark">

    <?php

    if (isset($error)) {
        echo '<p>' . $error . '</p>';
    }
    if (isset($message)) {
        echo '<p>' . $message . '<p>';
    }

    ?>

</form>

<?php while ($commentDisplay = $comments->fetch()) { ?>
<!--$comment issu de controller fonctionne comme juste au dessus $article-->
<div class="completcomment">
   <!-- <p><//?= $commentDisplay['pseudo']; ?></p>-->
    <p><?= $commentDisplay['text'] ?></p>
    <p><?= $commentDisplay['dateComment'] ?></p>
    <form method="post">
        <input type="submit" class="btn btn-danger" value="Signaler" name="signal">
    </form>
</div>
<?php } ?>
<?php $content = ob_get_clean(); ?>
<?php require('view/frontend/template.php'); ?>