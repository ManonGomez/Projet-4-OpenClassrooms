<?php

namespace controller\backend;

use model\backend\Manager;
use model\frontend\PostManager;
use controller\frontend\MainController;
use model\frontend\CommentManager;

class CommentGestionController extends MainController
{
    public  function gestioncom()
    {
      //  if ($_SESSION['admin'] == 0) {
        //    header("Location: index.php");
      //  }
        $CommentManager = new CommentManager();
        $comment = $CommentManager->getCOMBYDate();
        require('view/backend/template_gestioncom.php');
    }

    public function validcom()
    {

        $IDval = htmlspecialchars($_GET['id']);

        
        $CommentManager = new CommentManager();
        $txtcomment = $CommentManager->getComByID($IDval);
       

        if (isset($_POST['valid'])) {
            header("Location:  index.php?action=admin&page=gestioncom");
        }

        if (isset($_POST['delete'])) {
        $CommentManager = new CommentManager();
        $rate0 = $CommentManager->signalComment($IDval);
      
            header("Location:  index.php?action=admin&page=gestioncom");
        }
        require('view/backend/template_validcom.php');
    }

    public function deletecom()
    {
      //  if ($_SESSION['admin'] == 0) {
       //     header("Location: index.php");
       // }

        $IDdelete = htmlspecialchars($_GET['id']);

        
        $CommentManager = new CommentManager();
        $txtcomment = $CommentManager->gettextcom($IDdelete);
     

        if (isset($_POST['valid'])) {
            header(" index.php?action=admin&page=gestioncom");
        }

        if (isset($_POST['delete'])) {
             $CommentManager = new CommentManager();
        $delete= $CommentManager->deleteCom($IDdelete);
        
            header("Location:  index.php?action=admin&page=gestioncom");
        }

        require('view/backend/template_deletecom.php');
    }
}
