<?php

use App\Connection;
use App\Table\ImageTable;
use App\Table\TypeTable;
$pseudo = '';
if (isset($_SESSION['auth'])){
    $pseudo = $_SESSION['auth']->getNom().','.$_SESSION['auth']->getPrenom(); 
}

$pdo = Connection::getPdo();
$tTable = new TypeTable($pdo);
$type = $tTable->find($params['id']);
$images = (new ImageTable($pdo))->findImages($params['id']);
$caracts = $tTable->findCaract($params['id']);
$elements = [
    'type' => $type,
    'caracts' => $caracts,
    'images' => $images,
    'router' => $router,
    'pseudo' => $pseudo
];

echo $twig->render($view,$elements);