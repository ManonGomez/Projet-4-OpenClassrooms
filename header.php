<?php
session_start();
?>

<!DOCTYPE html>
<html lang=fr>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" media="screen and (max-width: 720px)" href="public/css/small.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <title>Billet simple pour l'Alaska</title>
    <meta name="description" content="Roman en ligne, chapître par chapître.">
</head>

<body>
    <header id="fixe">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="index.php">Billet simple pour l'Alaska</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="about.php">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contact</a>
                    </li>

                    <?php
                    if (!empty($_SESSION['username']) and !empty($_SESSION['mail'])) {
                        echo '<li class="nav-item"><a class="nav-link" href="disconnect.php" class="disconnect log">Déconnexion</a></li>';
                        if ($_SESSION['admin'] == 1) {
                            echo '<li class="nav-item"><a class="nav-link" href="gestion.php" class="gestion log">Gestion</a></li>';
                        }
                    } else {
                        echo '<li class="nav-item"><a class="nav-link btn btn-outline-dark" href="connect.php">Connexion</a></li>

<li><a href="inscription.php" class="nav-link btn btn-outline-dark">Inscription</a></li>';
                    }
                    ?>

                </ul>
            </div>
        </nav>
    </header>