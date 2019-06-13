<?php
include 'header.php';
include 'bdd.php';

if(empty($_SESSION['username'])AND empty($_SESSION['mail']))
{
    if(isset($_POST['formconnexion']))
    {
        if(!empty($_POST['pseudo']) AND !empty($_POST['password']))
        {
            $pseudo = htmlspecialchars($_POST['pseudo']);
            $password = hash('sha256', $salt.$_POST['password']);
            $requser = $bdd->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
            $requser->execute(array($pseudo, $password));
            $userexist = $requser->rowCount();
            if($userexist == 1)
            {
                $userdata = $requser->fetch();
                
                $_SESSION['username'] =  $userdata['username'];
                $_SESSION['firstname'] =  $userdata['firstname'];
                $_SESSION['lastname'] =  $userdata['lastname'];
                $_SESSION['mail'] =  $userdata['mail'];
                $_SESSION['admin'] =  $userdata['admin'];
                
                $message = 'Connexion établie.';
                //faire un délai ou renvoyer vers espace membre
                if($userdata['admin'] == 1)
                {
                  header("Location: admin.php");  
                }
                else
                {
                    header("Location: member.php");
                }
            }
            else
            {
                $error = 'Veuillez compléter tous les champs.';
            }
        }
        else
        {
            $error = 'Veuillez compléter tous les champs.';
        }
    }
}
else
{
   header("Location: index.php");
}
?>

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

<?php
include 'footer.php';
?>
