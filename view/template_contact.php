<form method="post" class="contactform">

    <div class="form-group">
        <label for="exampleFormControlInput1">Pseudo</label>
        <input type="text" id="pseudo" class="form-control" name="pseudo" value="<?php if(isset($_SESSION['username'])){echo $_SESSION['username'];}?>">
    </div>

    <div class="form-group">
        <label for="exampleFormControlInput2">E-Mail</label>
        <input type="email" id="mail" class="form-control" name="mail" value="<?php if(isset($_SESSION['mail'])){echo $_SESSION['mail'];}?>">
    </div>

    <div class="form-group">
        <label for="exampleFormControlInput3">Sujet</label>
        <input type="text" id="subject" class="form-control" name="subject">
    </div>

    <div class="form-group">
        <label for="exampleFormControlInput4">Message</label>
        <textarea name="message" id="message" class="form-control" rows="3"></textarea>
    </div>

    <input type="submit" id="send" name="formcontact" value="Envoyer" class="btn btn-outline-dark">
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