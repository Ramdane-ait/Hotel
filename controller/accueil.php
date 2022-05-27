<?php

use App\Connection;
use App\Table\ChambreTable;
if (session_status() === PHP_SESSION_NONE){
    session_start();
}

$pdo = Connection::getPdo();
$chambreTable = new ChambreTable($pdo);
$chambres = $chambreTable->all();

$elements = [
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




