<?php

use App\Auth;
use App\Connection;
use App\Table\AddonsTable;
use App\Table\ReservationTable;

if (Auth::check()){
    $pdo = Connection::getPdo();
    

    if (isset($_POST['dateA']) && isset($_POST['dateD']) && isset($_POST['typeId'])){
        $_SESSION['dateA'] = $_POST['dateA'];
        $_SESSION['dateD'] = $_POST['dateD'];
        $_SESSION['idType'] = $_POST['typeId'];
        $typeDispo = (new ReservationTable($pdo))->verifyType($_POST['dateA'],$_POST['dateD'],$_POST['typeId']);
        dd($typeDispo);
    } else if (isset($_POST['idType']) && isset($_POST['prix'])){
        $_SESSION['idType'] = $_POST['idType'];
        $_SESSION['prix'] = $_POST['prix'];
    }

    $addons = (new AddonsTable($pdo))->all();
     
    echo $twig->render($view,[
        'addons' => $addons,
        'router' => $router,
        'recap' => $router->url('recap'),
        'connected' => isset($_SESSION['auth']) ]); 
} else {
    header('Location:' . $router->url('connexion') . '?connect=1');
}


