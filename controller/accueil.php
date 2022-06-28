<?php

use App\Connection;
use App\Table\ChambreTable;
if (session_status() === PHP_SESSION_NONE){
    session_start();
}

$pseudo = '';
if (isset($_SESSION['auth'])){
    $pseudo = $_SESSION['auth']->getNom().','.$_SESSION['auth']->getPrenom(); 
}


$pdo = Connection::getPdo();
$chambreTable = new ChambreTable($pdo);
$chambres = $chambreTable->all();

$elements = [
    'pseudo' => $pseudo,
    'router' => $router,
    'connected' => isset($_SESSION['auth']),
    'admin' => isset($_SESSION['admin']),
    'confirm' =>isset($_GET['confirm']),
    'error' => isset($_GET['error']),
    'inscri' => isset($_GET['inscri']),
    'chambres' => $chambres 
];

echo $twig->render($view,$elements);

?>




