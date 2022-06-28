<?php

use App\Auth;
use App\Connection;
use App\Table\ClientTable;


if (Auth::checkAdmin()){
    $pdo = Connection::getPdo();
    $clientsTable = new ClientTable($pdo);
    $clients = $clientsTable->all();

    $elements = [
        'clients' => $clients,
        'router' => $router,
        'connected' => isset($_SESSION['auth']) 
    ];
    echo $twig->render($view,$elements);


} else {
    header('Location:' . $router->url('connexionAdmin') . '?connect=1');
}

