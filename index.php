<?php
session_start();


use model\backend\Manager;
use controller\frontend\MainController;
use controller\frontend\PostsController;
use controller\frontend\CommentController;
use controller\frontend\ContactController;
use controller\frontend\AboutController;
use controller\backend\UserController;
use controller\backend\CommentGestionController;
use controller\backend\AdminPostController;
use controller\backend\AdminController;

require_once('SplClassLoader.php');
$autoLoader = new SplClassLoader();
$autoLoader->register();

try {
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'listPosts') {
            //appel du bon controller qui permet de gérer la homepage et la liste des posts
            $controller = new PostsController();
            $controller->index();
        } elseif ($_GET['action'] == 'post') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $controller = new PostsController();
                $controller->showPost($_GET['id']);
            } else {
                $controller = new MainController();
                $controller->notFound();
            }
        }  
        //signal commentaire rate
        elseif ($_GET['action'] == 'signalCom'){
            if (isset($_GET['idComment']) && $_GET['idComment'] > 0 && isset($_GET['idArticle']) && $_GET['idArticle'] > 0) {
                $controller = new CommentController();
                $controller->signalComment($_GET['idComment'], $_GET['idArticle']);
            } else {
                $controller = new MainController();
                $controller->notFound();
            }
            
        }
        //AJOUT DES COMMENTAIRES
        elseif ($_GET['action'] == 'addComment') {

            //ON VERIFIE LA PRÉSENCE DE L'ID DANS L'URL
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $controller = new CommentController();
                $controller->addComment($_GET['id']);
            } else {
                $controller = new MainController();
                $controller->notFound();
            }
        } elseif ($_GET['action'] == 'contact') {
            $controller = new ContactController();
            $controller->contact();
        } elseif ($_GET['action'] == 'about') {
            $controller = new AboutControlller();
            $controller->about();
        }   elseif ($_GET['action'] == 'connect') {

            $controller = new UserController();
            $controller->connect();

        }
        //Deconnexion
        elseif ($_GET['action'] == 'disconnect') {
            $userController = new UserController();
            $userController->disconnect();
        }
        //on regroupe ce qui concerne l'admin dans un seul if
        elseif ($_GET['action'] == 'admin') {

            $userController = new UserController();
            $isAdmin = $userController->isAdmin();
            //on teste si l'utilisateur est bien connecté
            if ($isAdmin) {

                $controller = new AdminController();
                $adminPostController = new AdminPostController();
                $CommentGestionController = new CommentGestionController();
                //page d'accueil de l'admin
                if ($_GET['page'] == 'dashboard') {
                    $controller->dashboard();
                }
                //liste des articles dans l'admin
                elseif ($_GET['page'] == 'listposts') {
                    $adminPostController->adminPosts();
                }
                //page de creation d'un billet
                elseif ($_GET['page'] == 'createpost') {
                    $adminPostController->createPost();
                }
                //page d'édition d'un post
                elseif ($_GET['page'] == 'editpost') {

                    if (isset($_GET['id']) && $_GET['id'] > 0) {
                        $adminPostController->updatePost($_GET['id']);
                    } else {
                        throw new Exception('Aucun identifiant de billet envoyé');
                    }
                } elseif ($_GET['page'] == 'deletepost') {
                    if (isset($_GET['id']) && $_GET['id'] > 0) {
                        $adminPostController->delete($_GET['id']);
                    } else {
                        throw new Exception('Aucun identifiant de billet envoyé');
                    }
                }
                //il faut ajouter ici les autres action liées à l'admin

                elseif ($_GET['page'] == 'deletecom') {
                    if (isset($_GET['id']) && $_GET['id'] > 0) {
                        $CommentGestionController->deletecom($_GET['id']);
                    } else {
                        throw new Exception('Aucun identifiant de billet envoyé');
                    }
                    
                } elseif ($_GET['page'] == 'validcom') {
                    if (isset($_GET['id']) && $_GET['id'] > 0) {
                        $CommentGestionController->validcom($_GET['id']);
                    } else {
                        throw new Exception('Aucun identifiant de billet envoyé');
                    }
                    
                }elseif ($_GET['page'] == 'gestioncom') {
    
                    $CommentGestionController->gestioncom();
                }
                else {
                    header('Location: index.php?action=admin&page=dashboard');
                }
                
            }
            //sinon accès interdit
            else {
                $controller = new MainController();
                $controller->unauthorize();
            }
        }
    } else {
        $controller = new PostsController();
        $controller->index();
    }
} catch (Exception $e) {
    echo 'Erreur : ' . $e->getCode();
}
