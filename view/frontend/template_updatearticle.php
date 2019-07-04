<?php $title = 'Billet simple pour l\'Alaska'; ?>


<?php ob_start(); ?>
<?php while ($showarticle = $articles->fetch()) { ?>

<h3>Modification des billets</h3>
<form method="post" class="billetform">
    <input type="text" id="title" name="titlearea" value="<?= $showarticle['title'] ?>">
    <textarea id="mytextarea" name="textarea"><?= $showarticle['text'] ?></textarea>
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
<?php $content = ob_get_clean(); ?>