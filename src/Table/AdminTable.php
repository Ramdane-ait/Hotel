<?php
namespace App\Table;

use PDO;
use App\Model\Admin;
use App\Table\Table;
use App\Table\Exception\NotFoundException;

class AdminTable extends Table {

    protected $table = 'admin';
    protected $class = Admin::class;

    public function findByEmail(string $email) {
        $query = $this->pdo->prepare('SELECT * FROM '. $this->table . ' WHERE email=:email');
        $query->execute(['email' => $email]);
        $query->setFetchMode(PDO::FETCH_CLASS,$this->class);
        $result = $query->fetch();
        if ($result === false){
            throw new NotFoundException($this->table,$email);
        }
        return $result;
    }
}