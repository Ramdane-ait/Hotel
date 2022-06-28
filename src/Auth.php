<?php
namespace App;

use Exception;


class Auth {
    public static function check(){
        if (session_status() === PHP_SESSION_NONE){
            session_start();
        }
        if (!isset($_SESSION['auth']) &&!isset($_SESSION['client']) ){
            return false;
        }
        return true;
    }
    public static function checkAdmin(){
        if (session_status() === PHP_SESSION_NONE){
            session_start();
        }
        if (!isset($_SESSION['auth']) && !isset($_SESSION['admin'])){
            return false;
        }
        return true;
    }
}