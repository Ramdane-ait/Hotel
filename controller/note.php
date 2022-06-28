<?php

use App\Auth;
use App\Connection;
use App\Model\Note;
use App\Table\NoteTable;

if (Auth::check()){
    if (!empty($_POST)){
       if (!empty($_POST['stars']) && !empty($_POST['comment'])){
        $note = new Note();
        $note
        ->setStars((int)$_POST['stars'])
       ->setComment($_POST['comment'])
       ->setIdClient($_SESSION['auth']->getId());
          
        (new NoteTable(Connection::getPdo()))->createNote($note);
        header('Location: ' . $router->url('accueil'));
       }

    }

    
} else {
    header('Location:' . $router->url('connexion') . '?connect=1');
}