<?php 
namespace controller\frontend;


class MainController {

    public function notFound (){

        header("HTTP/1.0 404 Not Found");
        require('view/frontend/404.php');
    }
    
    public function unauthorize () {
        header("HTTP/1.0 401 Unauthorized");
        require('view/frontend/unauthorize.php');
    }
    
    
}