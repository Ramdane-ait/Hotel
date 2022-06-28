<?php

use App\Connection;
use App\Table\TypeTable;
use App\Table\ImageTable;
use App\Table\ChambreTable;
use App\Table\ReservationTable;

if (session_status() === PHP_SESSION_NONE){
    session_start();
}
$pseudo = '';
if (isset($_SESSION['auth'])){
    $pseudo = $_SESSION['auth']->getNom().','.$_SESSION['auth']->getPrenom(); 
}

$pdo = Connection::getPdo();
$typeTable = new TypeTable($pdo);
$imagesTable = new ImageTable($pdo);
$images = [];
$types = $typeTable->all();
foreach ($types as $type){
    $images[$type->getId()] = $imagesTable->findImages($type->getId())[0]->getName();
}

$elements = [
    'addonsUrl' => $router->url('addons'),
    'types' => $types,
    'images' => $images,
    'router' =>  $router,
    'connected' => isset($_SESSION['auth']),
    'admin' => isset($_SESSION['admin']),
    'error' => isset($_GET['error']),
    'pseudo' => $pseudo
];
echo $twig->render($view,$elements);




