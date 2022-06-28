<?php
namespace App;
use PDO;
class Connection {

    public static function getPdo() : PDO {
        return new PDO('mysql:dbname=hotel;host=localhost;','root','root',[
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
        
    }
}