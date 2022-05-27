<?php

use App\Auth;


if (Auth::check()){
    $_SESSION['id_chambre'] = $_POST['id_chambre'];
    $_SESSION['prix'] = $_POST['prix'];
    echo $twig->render($view,['router' => $router,'connected' => isset($_SESSION['auth']) ]); 
} else {
    header('Location:' . $router->url('connexion') . '?connect=1');
}


