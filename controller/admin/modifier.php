<?php

use App\Auth;
use App\Util;

use App\Connection;
use App\ImageUploader;
use App\Model\Chambre;
use App\Table\TypeTable;
use App\Table\ImageTable;
use App\Table\ChambreTable;
use App\Validators\ChambreValidator;
if (Auth::checkAdmin()){
$pdo = Connection::getPdo();
$chambreTable = new ChambreTable($pdo);
$imageTable = new ImageTable($pdo);
$chambre = $chambreTable->find($params['id']);
$images = $imageTable->findImages($chambre->getID());
$typeTable = new TypeTable($pdo);
$types = $typeTable->all();
$errors = [];
if (!empty($_POST)){
    
    $v = new ChambreValidator($_POST,$chambreTable,$chambre->getId());
    Util::hydrate($chambre,$_POST,['nom','type_id','description','prix']);
    
    if ($v->validate()){
        
        
        $newImages = ImageUploader::uploadImages('image');
        
        if (!empty($newImages)) {
            foreach ($newImages as $key =>$image){
                if (file_exists($images[$key]->getPath())) unlink($images[$key]->getPath()); 
                if ($image->getName() != null ) $images[$key]->setName($image->getName());
                $imageTable->updateImage($images[$key]);
            }
            
        } else {
            $errors['image']  = 'image invalide';
        }
        $chambreTable->updateChambre($chambre);
        header('Location:' . $router->url('admin'));
    } else {
        $errors = $v->errors(); 
    }
    

}

$elements = [
    'types' => $types,
    'action' =>$router->url('modifier_chambre',['id' => $chambre->getId()]),
    'errors' => $errors,
    'chambre' => $chambre,
    'images' => $images,
    'router' => $router,
    'connected' => isset($_SESSION['auth']) 
];
echo $twig->render($view,$elements);


} else {
    header('Location:' . $router->url('connexion') . '?connect=1');
}






