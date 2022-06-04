<?php

use App\Auth;
use App\Connection;
use App\Table\ReservationTable;

if (Auth::check()){
    (new ReservationTable(Connection::getPdo()))->delete($params['id']);
    header('Location:' . $router->url('client'));
}