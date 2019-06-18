<?php while ($showarticle = $articles->fetch()) { ?>

<h3>Modification des billets</h3>
<form method="post" class="billetform">
    <input type="text" id="title" name="titlearea" value="<?= $showarticle['titlearticle'] ?>">
    <textarea id="mytextarea" name="textarea"><?= $showarticle['textarticle'] ?></textarea>
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
