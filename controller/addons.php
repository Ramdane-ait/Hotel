<?php

use App\Auth;
use App\Connection;
use App\Table\AddonsTable;


if (Auth::check()){
    $_SESSION['idType'] = $_POST['idType'];
    $_SESSION['prix'] = $_POST['prix'];
    $addons = (new AddonsTable(Connection::getPdo()))->all();
     
    echo $twig->render($view,[
        'addons' => $addons,
        'router' => $router,
        'recap' => $router->url('recap'),
        'connected' => isset($_SESSION['auth']) ]); 
} else {
    header('Location:' . $router->url('connexion') . '?connect=1');
}


