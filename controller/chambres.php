<?php

use App\Connection;
use App\Table\ChambreTable;
use App\Table\ImageTable;

if (session_status() === PHP_SESSION_NONE){
    session_start();
}

$pdo = Connection::getPdo();
$chambreTable = new ChambreTable($pdo);
$imagesTable = new ImageTable($pdo);
$images = [];
$chambres = $chambreTable->all();
foreach ($chambres as $chambre){
    $images[$chambre->getId()] = $imagesTable->findImages($chambre->getId());
}

$elements = [
    'chambres' => $chambres,
    'images' => $images,
    'router' =>  $router,
    'connected' => isset($_SESSION['auth']),
    'admin' => isset($_SESSION['admin'])
];
echo $twig->render($view,$elements);




