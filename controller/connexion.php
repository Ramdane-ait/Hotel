<?php

use App\Auth;
use App\Connection;

use App\Table\ClientTable;
use App\Table\Exception\NotFoundException;
use App\Validators\ConnexionValidator;

if (!Auth::check()){



$errors = [];
if (!empty($_POST)){
    
    $errors['mdp'] = 'Email ou mot de passe incorrect';
    $v = new ConnexionValidator($_POST);
    if ($v->validate()){
        $clientTable = new ClientTable(Connection::getPdo());
        try {
            $u = $clientTable->findByEmail($_POST['email']);
            if (password_verify($_POST['mdp'],$u->getMdp()) === true){
                if (session_status() === PHP_SESSION_NONE){
                    session_start();
                }
                $_SESSION['auth'] = $u;
                header('Location: ' . $router->url('accueil'));
                exit();
            }
        } catch (NotFoundException $e){  
        }  
    }
    
}

$elements = [
    'router' => $router,
    'action' => $router->url('connexion'),
    'errors' => $errors,
    'connect' => isset($_GET['connect'])
];
echo $twig->render($view,$elements);
} else {
    header('Location:' . $router->url('accueil'));
}