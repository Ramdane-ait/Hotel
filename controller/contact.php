<?php

use App\Auth;
use App\Connection;
use App\Model\Contact;
use App\Table\ContactTable;
use App\Util;
use App\Validators\ContactValidator;

if (session_status() === PHP_SESSION_NONE){
    session_start();
}

if (Auth::check()) $email = $_SESSION['auth']->getEmail();
if (!empty($_POST)){
    if (Auth::check()){
       $contact = new Contact();
        $contactTable = new ContactTable(Connection::getPdo());
        $v = new ContactValidator($_POST);
        Util::hydrate($contact,$_POST,['email','message']);
        if ($v->validate()){
            $contactTable->createContact($contact);
            header('Location: ' . $router->url('contact') . '?succes=1');
            exit();
        } 
    } else {
        header('Location:' . $router->url('connexion') . '?connect=1');
        exit();
    } 

}

$elements = [
    'router' => $router,
    'connected' => isset($_SESSION['auth']),
    'admin' => isset($_SESSION['admin']),
    'email' => $email ?? '',
    'succes' => isset($_GET['succes'])
];
echo $twig->render($view,$elements);