<?php
namespace App\Table;

use App\Model\Type;
use App\Table\Exception\NotFoundException;

class TypeTable extends Table {

    protected $table = 'type';
    protected $class = Type::class;

    public function findTypeName($idType){
        $query = $this->pdo->prepare("SELECT nom_type FROM {$this->table} WHERE id = ?");
        $query->execute([$idType]);
        $result = $query->fetch();
        
        if ($result === false){
            throw new NotFoundException($this->table);
        }
        return $result;

    }

    public function findCaract($idType){
        $query = $this->pdo->prepare("
        SELECT nom_caract FROM caract C
        LEFT JOIN caract_type CT ON C.id = CT.id_caract
        WHERE CT.id_type = ?;");
        $query->execute([$idType]);
        return $query->fetchAll();

    }

}