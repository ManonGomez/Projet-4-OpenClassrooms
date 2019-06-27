<?php
include 'view/header.php';

require('controller/controller.php');


try{
if (isset($_GET['action'])) {
    if ($_GET['action'] == 'listPosts') {
        listPosts();
    } elseif ($_GET['action'] == 'post') {
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            post();
        } else {
             throw new Exception('Aucun identifiant de billet envoyé');
        }
    } elseif ($_GET['action'] == 'contact') {
        contact();
    }
    elseif($_GET['action'] == 'connect')
    {
        connect();
    }
    elseif($_GET['action'] == 'admin')
    {
        admin();
    }
    elseif($_GET['action'] == 'delete')
    {
        delete();
    }
    elseif($_GET['action'] == 'deletecom'){
        deletecom();
    }
    elseif($_GET['action'] == 'gestion'){
        gestion();
    }
    elseif($_GET['action'] == 'gestioncom'){
        gestioncom();
    }
     elseif($_GET['action'] == 'disconnect'){
        disconnect();
    }
    elseif($_GET['action'] == 'inscription'){
        inscription();
    }
    elseif($_GET['action'] == 'member'){
        member();
    }
    elseif($_GET['action'] == 'updatearticle'){
        updatearticle();
    }
} else {
    listPosts();
}
}
catch(Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}



include 'view/footer.php';
