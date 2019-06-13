<section>
    <form method="post" class="inscriptionform">

        <div class="form-group">
            <label for="exampleFormControlInput1">Pseudo</label>
            <input type="text" id="pseudo" name="pseudo" class="form-control">
        </div>

        <div class="form-group">
            <label for="exampleFormControlInput2">Prénom</label>
            <input type="text" id="firstname" name="firstname" class="form-control">
        </div>

        <div class="form-group">
            <label for="exampleFormControlInput3">Nom</label>
            <input type="text" id="lastname" name="lastname" class="form-control">
        </div>

        <div class="form-group">
            <label for="exampleFormControlInput4">E-Mail</label>
            <input type="email" id="mail" name="mail" class="form-control">
        </div>

        <div class="form-group">
            <label for="exampleFormControlInput5">Mot de passe</label>
            <input type="password" id="password" name="password" class="form-control">
        </div>

        <div class="form-group">
            <label for="exampleFormControlInput6">Confirmation mot de passe</label>
            <input type="password" id="passwordconfirm" name="passwordconfirm" class="form-control">
        </div>

        <input type="submit" id="send" name="forminscription" value="S'inscrire" class="btn btn-outline-dark">
        <?php 
        
        if(isset($error))
        {
            echo '<p>'.$error.'</p>';
        }
        if(isset($message))
        {
            echo '<p>'.$message.'<p>';
        }
        
        ?>
    </form>

</section>