<?php

$pseudo = '';
if (isset($_SESSION['auth'])){
    $pseudo = $_SESSION['auth']->getNom().','.$_SESSION['auth']->getPrenom(); 
}


$elements = [
    'router' => $router,
    'connected' => isset($_SESSION['auth']),
    'pseudo' => $pseudo
];

echo $twig->render($view,$elements);