<?php

use App\Util;
use App\Connection;
use App\Model\Client;
use App\Table\ClientTable;
use App\Validators\ClientValidator;

$client = new Client();
$errors = [];
if (!empty($_POST)){
$pdo = Connection::getPdo();
$clientTable = new ClientTable($pdo);
$v = new ClientValidator($_POST,$clientTable,$client->getId());
Util::hydrate($client,$_POST,['nom','prenom','email','date_naiss','sexe','tel','adresse','mdp']);


if ($v->validate()){
    $clientTable->createClient($client);
    header('Location: ' . $router->url('accueil') . '?inscri=1');
} else {
    $errors = $v->errors();
   
}


}
$elements = [
    'client' => $client,
    'action' => $router->url('inscription'),
    'errors' => $errors,
    'router' => $router,
    'connected' => isset($_SESSION['auth']) 
];
echo $twig->render($view,$elements);