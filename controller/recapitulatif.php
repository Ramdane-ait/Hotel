<?php
session_start();
use App\Auth;
use App\Connection;
use App\Model\Reservation;
use App\Table\ReservationTable;
dd($_GET);
if (Auth::check()){
    if(!empty($_POST['type_paiement'])){
        $_SESSION['type_paiement'] = $_POST['type_paiement'];  
    }
    
    $reservation = new Reservation();
    $rTable = new ReservationTable(Connection::getPdo());
    $reservation->setIdChambre($_SESSION['idType'])
    ->setIdClient($_SESSION['auth']->getId())
    ->setDateArrivee($_SESSION['dateA'])
    ->setDateDepart($_SESSION['dateD']);

    if (!empty($_GET['confirm'])){    
        $rTable->createReservation($reservation);
        header('Location:'. $router->url('accueil') . '?confirm=1');
        exit();
    }
   $prix = $_SESSION['prix'] * (int)date_diff(new DateTime($_SESSION['dateA']) ,new DateTime($_SESSION['dateD']))->format('%a');
    $elements = [
        'router' =>  $router,
        'r' => $reservation,
        'client' => $_SESSION['auth'],
        'prix' => $prix ,
        'connected' => isset($_SESSION['auth']),
        'confirm' =>isset($_GET['confirm'])
    ];
    echo $twig->render($view,$elements);
} else {
    header('Location:' . $router->url('connexion') . '?connect=1');
}
