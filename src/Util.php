<?php 
namespace App;

class Util {

    public static function hydrate($item,array $data,array $params) {
        foreach ($params as $param){
            $method = 'set'.str_replace(' ','',ucwords(str_replace('_',' ',$param)));
            $item->$method($data[$param]);
        }
    }
}