<?php
session_start();
use App\Auth;
use App\Connection;
use App\Model\Reservation;
use App\Table\AddonsTable;
use App\Table\ChambreTable;
use App\Table\ReservationTable;

if (Auth::check()){
   
    $pdo = Connection::getPdo();
    $reservation = new Reservation();
    $rTable = new ReservationTable($pdo);

    $reservation->setIdChambre((new ChambreTable($pdo))->findRoom($_SESSION['idType']))
    ->setIdClient($_SESSION['auth']->getId())
    ->setDateArrivee($_SESSION['dateA'])
    ->setDateDepart($_SESSION['dateD']);

    
    if (!empty($_GET['confirm'])){  
        $idRes = $rTable->createReservation($reservation);
        if (!empty($_GET['addons'])){
            $addons = explode(',',$_GET['addons']);
            $aTable = new AddonsTable($pdo);
            foreach ($addons as $addon){
                $rTable->addAddons($idRes,$addon);
            }
        }
        
        header('Location:'. $router->url('accueil') . '?confirm=1');
        exit();
    } else {
        $prixAddon = 0;
        if (!empty($_GET['addons'])){
            $addons = explode(',',$_GET['addons']);
            $aTable = new AddonsTable($pdo); 
            foreach ($addons as $addon){
                $prixAddon += $aTable->getPrice($addon)[0];
            }
        }
        $prix = ($_SESSION['prix'] * (int)date_diff(new DateTime($_SESSION['dateA']) ,new DateTime($_SESSION['dateD']))->format('%a')) + $prixAddon;
    
    }
    $elements = [
        'addons' =>$_GET['addons'],
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
