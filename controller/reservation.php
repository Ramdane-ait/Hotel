<?php

use App\Auth;
use App\Connection;
use App\Table\ImageTable;
use App\Model\Reservation;
use App\Table\ReservationTable;
use App\Validators\ReservationValidator;


if (Auth::check()){
    
   $errors = [];
    if (!empty($_POST)){
    
        $v = new ReservationValidator($_POST);
        
        
        if ($v->validate() && $_POST['dateA'] < $_POST['dateD']){
            $_SESSION['dateA'] = $_POST['dateA'];
            $_SESSION['dateD'] = $_POST['dateD'];
            $reservationTable = new ReservationTable(Connection::getPdo());
            $imagesTable = new ImageTable(Connection::getPdo());
            $images = [];
            $chambres = $reservationTable->verifyDispo($_POST['dateA'],$_POST['dateD']);
            foreach ($chambres as $chambre){
                $images[$chambre->getId()] = $imagesTable->findImages($chambre->getId())[0];
            }
            echo $twig->render($view,['chambres' => $chambres,'images' => $images,'router' => $router,'connected' => isset($_SESSION['auth'])]);
        } else {
            header('Location: ' . $router->url('accueil') . '?error=1');
            
        }
   
    }
 
} else {
    header('Location:' . $router->url('connexion') . '?connect=1');
}
