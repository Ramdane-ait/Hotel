<?php

use App\Auth;
use App\Connection;
use App\Table\ClientTable;
use App\Table\ReservationTable;


if (Auth::checkAdmin()){
    $pdo = Connection::getPdo();
    $reservationsTable = new ReservationTable($pdo);
    $reservations = $reservationsTable->all();

    $clientTable = new ClientTable($pdo);
    $clients = [];
    foreach ($reservations as $key => $reservation) {
        $clients[$key] = $clientTable->findName($reservation->getIdClient());
    }

    $elements = [
        'reservations' => $reservations,
        'clients' =>$clients,
        'router' => $router,
        'connected' => isset($_SESSION['auth']) 
    ];
    echo $twig->render($view,$elements);


} else {
    header('Location:' . $router->url('connexionAdmin') . '?connect=1');
}

