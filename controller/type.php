<?php

use App\Connection;
use App\Table\ImageTable;
use App\Table\TypeTable;
$pdo = Connection::getPdo();
$type = (new TypeTable($pdo))->find($params['id']);
$images = (new ImageTable($pdo))->findImages($params['id']);

$elements = [
    'type' => $type,
    'images' => $images,
    'router' => $router
];

echo $twig->render($view,$elements);