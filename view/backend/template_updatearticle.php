<?php $title = 'Billet simple pour l\'Alaska'; ?>


<?php ob_start(); ?>
<?php while ($showarticle = $articles->fetch()) { ?>

<h3>Modification des billets</h3>
<form method="post" class="billetform" action="index.php?action=admin&page=editpost&id=<?php echo $showarticle['Id']; ?>">
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
    window.addEventListener('load', () => {
        tinymce.init({
            selector: '#mytextarea'
        });
    })
    
</script>

<?php } ?>
<?php $content = ob_get_clean(); ?>
<?php require('view/frontend/template.php'); ?>