<?php

namespace controller\backend;

use model\backend\Manager;
use model\frontend\PostManager;
use controller\frontend\MainController;
use model\frontend\CommentManager;
use model\backend\CommentAdminManager;

class CommentGestionController extends MainController
{
    public  function gestioncom()
    {
      //  if ($_SESSION['admin'] == 0) {
        //    header("Location: index.php");
      //  }
        $CommentAdminManager = new CommentAdminManager();
        $comments = $CommentAdminManager->getCOMBYDate();
        require('view/backend/template_gestioncom.php');
    }

    public function validcom($idComment)
    {

        $CommentAdminManager = new CommentAdminManager();
        $txtcomment = $CommentAdminManager->getComByID($idComment);
       

        if (isset($_POST['valid'])) {
            header("Location:  index.php?action=admin&page=gestioncom");
        }

        if (isset($_POST['delete'])) {
            $CommentAdminManager = new CommentAdminManager();
            $rate0 = $CommentAdminManager->validComment($idComment);
        
            header("Location:  index.php?action=admin&page=gestioncom");
        }
        require('view/backend/template_validcom.php');
    }

    public function deletecom($idComment)
    {
      //  if ($_SESSION['admin'] == 0) {
       //     header("Location: index.php");
       // }

        
        $CommentAdminManager = new CommentAdminManager();
        $txtcomment = $CommentAdminManager->gettextcom($idComment);
     

        if (isset($_POST['valid'])) {
            header("Location:  index.php?action=admin&page=gestioncom");
        }

        if (isset($_POST['delete'])) {
            var_dump('dddd');
            $CommentAdminManager = new CommentAdminManager();
            
            $delete= $CommentAdminManager->deleteCom($idComment);
            header("Location:  index.php?action=admin&page=gestioncom");
        }

        require('view/backend/template_deletecom.php');
    }
}
