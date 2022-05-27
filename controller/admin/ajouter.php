<?php

use App\Auth;
use App\Util;
use App\Connection;
use App\ImageUploader;
use App\Model\Chambre;
use App\Table\ChambreTable;
use App\Table\ImageTable;
use App\Table\TypeTable;
use App\Validators\ChambreValidator;

if (Auth::checkAdmin()){
$chambre = new Chambre();
$errors = [];
$pdo = Connection::getPdo();
$typeTable = new TypeTable($pdo);
$types = $typeTable->all();

if (!empty($_POST)){
    
    
    $chambreTable = new ChambreTable($pdo);
    $v = new ChambreValidator($_POST,$chambreTable,$chambre->getId());
    Util::hydrate($chambre,$_POST,['nom','type_id','description','prix']);

    if ($v->validate()){
        
            $imageTable = new ImageTable($pdo);
            $chambreTable->createChambre($chambre);
            $chambreId = $chambre->getId();
            $images = ImageUploader::uploadImages('image');
           
            if (!empty($images)) {
                
                foreach ($images as $image){
                    $image->setIdChambre($chambreId);
                   
                    $imageTable->createImage($image);
                }
                header('Location:' . $router->url('admin'));
                exit(); 
            } else {
                $errors['images']  = 'image invalide';
            }   
    } else {
        $errors = $v->errors(); 
    } 

}

$elements = [
    'types' => $types,
    'action' =>$router->url('nouvelle_chambre'),
    'chambre' => $chambre,
    'errors' => $errors,
    'router' => $router,
    'connected' => isset($_SESSION['auth']) 
];
echo $twig->render($view,$elements);



}else {
    header('Location:' . $router->url('connexion') . '?connect=1');
}





