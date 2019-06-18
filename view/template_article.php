<?php while ($dataarticle = $article->fetch()) { ?>
<div class="articleComplet">
    <h2><?= $dataarticle['titlearticle'] ?></h2>
    <p><?= htmlspecialchars_decode($dataarticle['textarticle']) ?></p>
    <p><?= $dataarticle['datearticle'] ?></p>
</div>
<?php } ?>

<form method="post" class="commentform">

    <div class="form-group">
        <label for="exampleFormControlInput1"></label>
        <input class="field form-control" type="text" name="pseudo" id="pseudo" required="" autofocus="" placeholder="Pseudo" value="<?php if (isset($_SESSION['username'])) { } ?> disabled="disabled"">
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

<?php while ($commentDisplay = $comment->fetch()) { ?>
<div class="completcomment">
    <p><?= $_SESSION['username']; ?></p>
    <p><?= $commentDisplay['txtcomment'] ?></p>
    <p><?= $commentDisplay['datecomment'] ?></p>
    <form method="post">
        <input type="submit" class="btn btn-danger" value="Signaler" name="signal">
    </form>
</div>
<?php } ?>
