<?php 
namespace App\Table;

use \PDO;
use App\Table\Exception\NotFoundException;

abstract class Table {

    protected $pdo;
    protected $table = null;
    protected $class = null;
    public function __construct(\PDO $pdo ){
        $this->pdo = $pdo;
    }

    public function find(int $id) {
        $query = $this->pdo->prepare('SELECT * FROM '. $this->table . ' WHERE id=:id');
        $query->execute(['id' => $id]);
        $query->setFetchMode(PDO::FETCH_CLASS,$this->class);
        $result = $query->fetch();
        if ($result === false){
            throw new NotFoundException($this->table,$id);
        }
        return $result;
    }
    /**
     * verifie si une valeur existe dans la table
     *  @params string $field Champs a rechercher
     *  @params mixed $value Valeur associé au champs 
     */
    public function exists(string $field,$value,?int $except = null):bool 
    {
        $sql = "SELECT COUNT(id) FROM {$this->table} WHERE $field = ?";
        $params = [$value];
        if ($except !== null){
            $sql .= " AND id != ?";
            $params[] = $except;
        }
        $query = $this->pdo->prepare($sql);
        $query->execute($params);
        return (int)$query->fetch(PDO::FETCH_NUM)[0] > 0 ;
    }

    public function all():array {
        $sql = "SELECT * FROM {$this->table}";
        return $this->pdo->query($sql,PDO::FETCH_CLASS,$this->class)->fetchAll();
    }

    public function delete(int $id):void {
        $query = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id=?");
        $ok = $query->execute([$id]);
        if ($ok === false){
            throw new \Exception("Impossible de suprimmer dans la table {$this->table}");
        }
    }

    public function create(array $data):int {
        $sqlFields = [];
        foreach($data as $key =>$value){
            $sqlFields[] = "$key = :$key";
        }
        $query = $this->pdo->prepare("INSERT INTO {$this->table} SET " . implode(', ',$sqlFields));
        
        $ok = $query->execute($data);
        if ($ok === false){
            throw new \Exception("Impossible d'ajouter dans la table {$this->table}");
        }
        return (int)$this->pdo->lastInsertId();
    }

    public function update(array $data, int $id): void {
        $sqlFields = [];
        foreach($data as $key =>$value){
            $sqlFields[] = "$key = :$key";
        }
        $query = $this->pdo->prepare("UPDATE {$this->table} SET " . implode(', ',$sqlFields) . " WHERE id = :id");
        $ok = $query->execute(array_merge($data,['id' => $id]));
        if ($ok === false){
            throw new \Exception("Impossible de modifier cette enregistrement dans la table {$this->table}");
        }
    }
    
}