<?php

use App\Auth;
use App\Connection;
use App\Table\ClientTable;
use App\Table\ContactTable;


if (Auth::checkAdmin()){
    $pdo = Connection::getPdo();
    $contactTable = new ContactTable($pdo);
    $contacts = $contactTable->all();

    $elements = [
        'contacts' => $contacts,
        'router' => $router,
        'connected' => isset($_SESSION['auth']) 
    ];
    echo $twig->render($view,$elements);


} else {
    header('Location:' . $router->url('connexionAdmin') . '?connect=1');
}

