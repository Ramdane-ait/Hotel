<?php

use App\Auth;
use App\Connection;
use App\Table\TypeTable;
use App\Table\ImageTable;
use App\Table\ChambreTable;
use App\Table\ClientTable;
use App\Table\ContactTable;
use App\Table\ReservationTable;

if (Auth::checkAdmin()){
    $pdo = Connection::getPdo();
    $chambreTable = new ChambreTable($pdo);
    $chambres = $chambreTable->count();
    $reservations = (new ReservationTable($pdo))->count();
    $messages = (new ContactTable($pdo))->count();
    $clients = (new ClientTable($pdo))->count(); 

    $elements = [
        'reservations' => $reservations,
        'chambres' => $chambres,
        'messages' => $messages,
        'clients' => $clients,
        'router' => $router,
        'connected' => isset($_SESSION['auth']) 
    ];
    echo $twig->render($view,$elements);


} else {
    header('Location:' . $router->url('connexionAdmin') . '?connect=1');
}

