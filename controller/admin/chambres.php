<?php

use App\Auth;
use App\Connection;
use App\Model\Chambre;
use App\Table\ChambreTable;
use App\Table\TypeTable;

if (Auth::checkAdmin()){
    $pdo = Connection::getPdo();
    $chambre = new Chambre();
    $chambresTable = new ChambreTable($pdo);
    if (!empty($_POST)){
        if (!empty($_POST['dispo'])){
            $chambre->setId($_POST['dispo']);
            $chambre->setDispo(1);
        } else if (!empty($_POST['notDispo'])){
            $chambre->setId($_POST['notDispo']);
            $chambre->setDispo(0);
        }
        $chambresTable->updateChambre($chambre);
    }
    $chambres = $chambresTable->all();

    $typesTable = new TypeTable($pdo);
    $types = [];
    foreach ($chambres as $key => $chambre){
        $types[$key] = $typesTable->findTypeName($chambre->getTypeId())[0]; 

    }
    $elements = [
        'chambres' => $chambres,
        'types' => $types,
        'router' => $router,
        'connected' => isset($_SESSION['auth']) 
    ];
    echo $twig->render($view,$elements);


} else {
    header('Location:' . $router->url('connexionAdmin') . '?connect=1');
}

