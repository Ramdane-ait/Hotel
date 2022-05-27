<?php
namespace App\Table;

use App\Model\Addon;



class AddonsTable extends Table {

    protected $table = 'addons';
    protected $class = Addon::class;

    public function getPrice($id){
        $query = $this->pdo->prepare("SELECT prix_addon FROM {$this->table} WHERE id = ?");
        $query->execute([$id]);
        return $query->fetch();

    }
}