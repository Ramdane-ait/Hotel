<?php

use App\Auth;
use App\Connection;
use App\Table\ChambreTable;
use App\Table\ImageTable;

if (Auth::checkAdmin()){
$pdo = Connection::getPdo();
$chambreTable = new ChambreTable($pdo);
$imageTable = new ImageTable($pdo);
$chambre = $chambreTable->find($params['id']);
$images = $imageTable->findImages($chambre->getId());
foreach ($images as $image) {
    if (file_exists($image->getPath())) unlink($image->getPath());
    $imageTable->delete($image->getId());  
}
    

$chambreTable->delete($params['id']);
header('Location:' . $router->url('admin'));


} else {
    header('Location:' . $router->url('connexion') . '?connect=1');
}


