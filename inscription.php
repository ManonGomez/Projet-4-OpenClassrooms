<?php
include 'header.php';
include 'bdd.php';

if(isset ($_POST['forminscription']))
{
   if(!empty($_POST['pseudo']) AND !empty($_POST['firstname']) AND !empty($_POST['lastname']) AND !empty($_POST['mail']) AND !empty($_POST['password']) AND !empty($_POST['passwordconfirm']))
   {
       $pseudo = htmlspecialchars($_POST['pseudo']);
       $firstname = htmlspecialchars($_POST['firstname']);
       $lastname = htmlspecialchars($_POST['lastname']);
       $mail = htmlspecialchars($_POST['mail']);
       //hash pour encrypter et 'sha..' le format de lencyptage
       $password = hash('sha256', $salt.$_POST['password']);
       $confirmpassword = hash('sha256', $salt.$_POST['passwordconfirm']);
       
       if($password == $confirmpassword)
       {
           $pseudolenght = strlen($pseudo);
           if($pseudolenght <= 20 AND $pseudolenght >= 5)
           {
                  $firstnamelenght = strlen($firstname);
                   if($firstnamelenght <= 20 AND $firstnamelenght >= 2)
                   {
                         $lastnamelenght = strlen($lastname);
                           if($lastnamelenght <= 30 AND $lastnamelenght >= 2)
                           {
                                if(filter_var($mail, FILTER_VALIDATE_EMAIL)) 
                                {
                                    $passwordlenght = strlen($_POST['password']);
                                    if($passwordlenght >= 5)
                                    {
                                        //selct tt info users ou le mail= à ce que user à remplis
                                        $reqmail = $bdd->prepare("SELECT * FROM users WHERE mail = ?");
                                        $reqmail->execute(array($mail));
                                        $mailexist = $reqmail->rowCount();
                                        if($mailexist == 0)
                                        {
                                            $reqpseudo = $bdd->prepare("SELECT *FROM users WHERE username = ?");
                                            $reqpseudo->execute(array($pseudo));
                                            $pseudoexist = $reqpseudo->rowCount();
                                            if($pseudoexist == 0)
                                            {
                                                $insertuser = $bdd->prepare("INSERT INTO users(username, mail, password, firstname, lastname) VALUES(?, ?, ?, ?, ?)");
                                                $insertuser->execute(array($pseudo, $mail, $password, $firstname, $lastname));
                                                $message='Vous avez bien été inscrit';
                                            }
                                            else
                                            {
                                                $error='Ce pseudo est déjà pris, veuillez en choisir un autre';
                                            }
                                        }
                                        else
                                        {
                                            $error='Cette adresse mail est déjà enregistrée';
                                        }
                                    }
                                    else
                                    {
                                         $error = 'Le mot de passe est trop court';
                                    }
                                }
                                else
                                {
                                    $error = 'Ce n\'est pas une adresse mail';
                                }
                           }
                           else
                           {
                               $error ='Votre nom doit avoir entre 2 et 30 caractères';
                           }
                   }
                   else
                   {
                       $error ='Votre prénom doit avoir entre 2 et 20 caractères';
                   }
           }
          else
          {
              $error = 'Le pseudo doit avoir entre 5 et 20 caractères';
          }
       }
       else
       {
           $error = 'Les mots de passe ne sont pas identiques';
       }
   }
   else 
   {
       $error = 'Pas tous les champs sont remplis';
   }
}
    
?>



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

<?php include 'footer.php';?>
