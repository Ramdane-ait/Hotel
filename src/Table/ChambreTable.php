<?php
namespace App\Table;

use PDO;
use App\Model\Chambre;

final class ChambreTable extends Table{
    
    protected $table = 'chambre';
    protected $class = Chambre::class;
   
    public function createChambre(Chambre $chambre):void {
        $id = $this->create([
            'type_id' => $chambre->getTypeId(),
        ]);
        
        $chambre->setId($id);
    }
    public function updateChambre(Chambre $chambre):void {
        $this->update([
            'dispo' => $chambre->getDispo()
        ],$chambre->getId());
    }

}