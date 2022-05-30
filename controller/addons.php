<?php

use App\Auth;
use App\Connection;
use App\Table\AddonsTable;
use App\Table\ReservationTable;

if (Auth::check()){
    $pdo = Connection::getPdo();
    

    if (isset($_POST['dateA']) && isset($_POST['dateD'])){
        $_SESSION['dateA'] = $_POST['dateA'];
        $_SESSION['dateD'] = $_POST['dateD'];
        if (!(new ReservationTable($pdo))->verifyType($_POST['dateA'],$_POST['dateD'],$_POST['idType'])){
            header('Location:'. $router->url('types') . '?error=1');
        } 

    } 
    $_SESSION['idType'] = $_POST['idType'];
    $_SESSION['prix'] = $_POST['prix'];
    $addons = (new AddonsTable($pdo))->all();
     
    echo $twig->render($view,[
        'addons' => $addons,
        'router' => $router,
        'recap' => $router->url('recap'),
        'connected' => isset($_SESSION['auth']) ]); 
} else {
    header('Location:' . $router->url('connexion') . '?connect=1');
}


