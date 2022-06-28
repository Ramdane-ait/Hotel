<?php

use App\Auth;
use App\Util;
use App\Connection;
use App\Model\Client;
use App\Table\ClientTable;
use App\Table\ReservationTable;
use App\Validators\ClientModifValidator;
use App\Validators\PasswordValidator;

if (Auth::check()){
    $pseudo = '';
    if (isset($_SESSION['auth'])){
        $pseudo = $_SESSION['auth']->getNom().','.$_SESSION['auth']->getPrenom(); 
    }

    $pdo = Connection::getPdo();
    $client = new Client();
    $client->setId($_SESSION['auth']->getId());
    $errors = [];
    $errorsMdp = [];
    if(!empty($_POST)){
        $clientTable = new ClientTable($pdo);
        if (isset($_POST['mdp'])){
            $mdpV = new PasswordValidator($_POST,$clientTable,$_SESSION['auth']->getId());
            if ($mdpV->validate()){
                $client->setMdp($_POST['New-mdp']);
                $clientTable->updateMdpClient($client);
            } else {
                $errorsMdp = $mdpV->errors();
            }
        } else {
            $v = new ClientModifValidator($_POST,$clientTable,$_SESSION['auth']->getId());
            Util::hydrate($client,$_POST,['email','tel','adresse']);
            if ($v->validate()){
                $clientTable->updateClient($client);
                Util::hydrate($_SESSION['auth'],$_POST,['email','tel','adresse']);
            } else {
                $errors = $v->errors();
            }
        }
    }
$rTable = new ReservationTable($pdo);
$reservations = $rTable->getReservations($_SESSION['auth']->getId());


$elements = [
    'client' => $_SESSION['auth'],
    'reservations' => $reservations,
    'router' => $router,
    'errors' => $errors,
    'errorsMdp' => $errorsMdp,
    'connected' => isset($_SESSION['auth']),
    'pseudo' => $pseudo
];

echo $twig->render($view,$elements);


} else {
    header('Location:' . $router->url('connexion') . '?connect=1');
}