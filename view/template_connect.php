<form method="post" class="connexion">

    <div class="form-group">
        <label for="exampleFormControlInput1">Pseudo</label>
        <input class="field form-control" type="text" name="pseudo" id="pseudo" required="" autofocus="">
    </div>


    <div class="form-group">
        <label for="exampleFormControlInput1">Mot de passe</label>
        <input class="field form-control" type="password" required="" name="password" id="password">
    </div>

    <input class="btn btn-outline-dark" id="send" name="formconnexion" type="submit" value="Se connecter">
    <?php

    if (isset($error)) {
        echo '<p>' . $error . '</p>';
    }
    if (isset($message)) {
        echo '<p>' . $message . '<p>';
    }

    ?>
</form>