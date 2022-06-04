<?php

use App\Auth;
use App\Connection;
use App\Table\ReservationTable;

if (Auth::check()){

$rTable = new ReservationTable(Connection::getPdo());
$reservations = $rTable->getReservations($_SESSION['auth']->getId());


$elements = [
    'client' => $_SESSION['auth'],
    'reservations' => $reservations,
    'router' => $router
];
echo $twig->render($view,$elements);
}