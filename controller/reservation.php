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
            $pdo = Connection::getPdo();
            $_SESSION['dateA'] = $_POST['dateA'];
            $_SESSION['dateD'] = $_POST['dateD'];
            $reservationTable = new ReservationTable($pdo);
            $imagesTable = new ImageTable($pdo);
            $images = [];
            $types = $reservationTable->findTypeDispo($_POST['dateA'],$_POST['dateD']);
            foreach ($types as $type){
                $images[$type->getId()] = $imagesTable->findImages($type->getId())[0]->getName();
            }


            echo $twig->render($view,['types' => $types,'images' => $images,'router' => $router,'connected' => isset($_SESSION['auth'])]);
        } else {
            header('Location: ' . $router->url('accueil') . '?error=1');
            
        }
   
    }
 
} else {
    header('Location:' . $router->url('connexion') . '?connect=1');
}
