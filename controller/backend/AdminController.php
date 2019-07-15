<?php
namespace controller\backend;

use controller\frontend\MainController;

class AdminController extends MainController
{
 public  function admin(){
     require('view/frontend/template_admin.php');
 }
}