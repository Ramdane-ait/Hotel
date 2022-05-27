<?php

use App\Auth;
use App\Connection;

use App\Table\AdminTable;

use App\Table\Exception\NotFoundException;
use App\Validators\ConnexionValidator;

if (!Auth::checkAdmin()){


$errors = [];
if (!empty($_POST)){

    $errors['mdp'] = 'Email ou mot de passe incorrect';
    $v = new ConnexionValidator($_POST);
    if ($v->validate()){
        
        $adminTable = new AdminTable(Connection::getPdo());
        try {
            $a = $adminTable->findByEmail($_POST['email']);
            
            if (password_verify($_POST['mdp'],$a->getMdp()) === true){
                if (session_status() === PHP_SESSION_NONE){
                    session_start();
                }
                $_SESSION['auth'] = $a->getId();
                $_SESSION['admin'] = 1;
                
                header('Location: ' . $router->url('admin'));
                exit();
            }
        } catch (NotFoundException $e){}
        
    }
    
}

$elements = [
    'router' => $router,
    'action' => $router->url('connexionAdmin'),
    'errors' => $errors,
    'connect' => isset($_GET['connect'])
];
echo $twig->render($view,$elements);
} else {
    header('Location:' . $router->url('accueil'));
}