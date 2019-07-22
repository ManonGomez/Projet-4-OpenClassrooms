<?php $title = 'Rédaction'; ?>


<?php ob_start(); ?>
<h2>Bienvenue Jean</h2>

<h3>Création des billets</h3>
<form method="post" class="billetform" action="index.php?action=admin&page=createpost">
    <input type="text" id="title" name="titlearea" placeholder="Titre du billet">
    <textarea id="mytextarea" name="textarea"></textarea>
    <input type="submit" id="send" name="billetvalid" value="Publier">
    <?php

    if (isset($error)) {
        echo '<p>' . $error . '</p>';
    }
    if (isset($message)) {
        echo '<p>' . $message . '<p>';
    }

    ?>
</form>
<script>
    window.addEventListener('load', () => {
        tinymce.init({
            selector: '#mytextarea'
        });
    })
</script>
<?php $content = ob_get_clean(); ?>
<?php require('view/frontend/template.php'); ?>