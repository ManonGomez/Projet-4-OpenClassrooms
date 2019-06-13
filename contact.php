<?php
include 'header.php';
include 'bdd.php';

if(isset ($_POST['formcontact']))
{
    $origin = "Contact Billet simple pour l'Alaska";
    $sujet = htmlspecialchars($_POST['subject']);
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $mail = htmlspecialchars($_POST['mail']);
    $text = htmlspecialchars($_POST['message']);
    
    if(!empty($pseudo) AND !empty($mail) AND !empty($sujet) AND !empty($text))
    {
        if(filter_var($mail, FILTER_VALIDATE_EMAIL)) 
        {
            $headers = 'MIME-Version: 1.0'."\r\n";
            $headers .= 'Content-type: text/html; charset=utf8'."\r\n";
            $headers .= 'From: "'.$pseudo.'"<'.$mail.'>'."\n";
            $headers .= 'Reply-To: '.$mail.''."\n";
            
            $for = 'manon.gomez@chaffy.net';
                
            $contenu = '<html>';
            $contenu .= '<head><title>'.$origin.'</title></head>';
            $contenu .= '<body><h4>'.$pseudo.'</h4>';
            $contenu .= '<h5>'.$mail . '</h5>';
            $contenu .= '<h5>'.$sujet.'</h5>';
            $contenu .= '<p>'.$text.'</p></body>';
            $contenu .= '</html>';
// erreur à ce niveau
            mail($for, $contenu, $headers);

            $message = 'Votre message à bien été envoyé.';
                
        }
        else
        {
            $error = 'Erreur dans l\'adresse mail';
        } 
    }
    else
    {
        $error = 'Veuillez remplir tous les champs';
    }
}

?>

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


<?php include 'footer.php'; ?>
