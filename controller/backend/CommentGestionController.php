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
        if ($_SESSION['admin'] == 0) {
            header("Location: index.php");
        }
        $comment = getCOMBYDate();
        require('view/frontend/template_gestioncom.php');
    }

    public function validcom()
    {

        $IDval = htmlspecialchars($_GET['id']);

        $txtxomment = getComByID($IDval);

        if (isset($_POST['valid'])) {
            header("Location: template_gestioncom.php");
        }

        if (isset($_POST['delete'])) {
            $rate0 = signalComment($IDval);
            header("Location: template_gestioncom.php");
        }
        require('view/frontend/template_validcom.php');
    }

    public function deletecom()
    {
        if ($_SESSION['admin'] == 0) {
            header("Location: index.php");
        }

        $IDdelete = htmlspecialchars($_GET['id']);

        $txtcomment = gettextcom($IDdelete);

        if (isset($_POST['valid'])) {
            header("Location: template_gestioncom.php");
        }

        if (isset($_POST['delete'])) {
            $delete = deleteCom($IDdelete);
            header("Location: template_gestioncom.php");
        }

        require('view/frontend/template_deletecom.php');
    }
}
