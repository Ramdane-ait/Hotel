<?php

use App\Auth;
use App\Connection;
use App\Table\TypeTable;
use App\Table\ImageTable;
use App\Table\ChambreTable;

if (Auth::checkAdmin()){
    $pdo = Connection::getPdo();
    $chambreTable = new ChambreTable($pdo);
    $imagesTable = new ImageTable($pdo);
    $images = [];
    $chambres = $chambreTable->all();
    $typeTable = new TypeTable($pdo);
    
    $typeChambre = [];
    foreach ($chambres as $chambre){
        $typeChambre[$chambre->getId()] = $typeTable->findTypeName($chambre->getTypeId())[0];
    }
    
    foreach ($chambres as $chambre){
        $images[$chambre->getId()] = $imagesTable->findImages($chambre->getId());
    }

    $elements = [
        'typeChambre' => $typeChambre,
        'chambres' => $chambres,
        'images' => $images,
        'router' => $router,
        'connected' => isset($_SESSION['auth']) 
    ];
    echo $twig->render($view,$elements);


} else {
    header('Location:' . $router->url('connexionAdmin') . '?connect=1');
}

