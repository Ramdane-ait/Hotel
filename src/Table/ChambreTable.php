<?php
namespace App\Table;

use PDO;
use App\Model\Chambre;

final class ChambreTable extends Table{
    
    protected $table = 'chambre';
    protected $class = Chambre::class;
   
    public function createChambre(Chambre $chambre):void {
        $id = $this->create([
            'nom' => $chambre->getNom(),
            'description' => $chambre->getDescription(),
            'prix' => $chambre->getPrix(),
            'type_id' => $chambre->getTypeId(),
        ]);
        
        $chambre->setId($id);
    }
    public function updateChambre(Chambre $chambre):void {
        $id = $this->update([
            'nom' => $chambre->getNom(),
            'description' => $chambre->getDescription(),
            'prix' => $chambre->getPrix(),
            'type_id' => $chambre->getTypeId(),
        ],$chambre->getId());
    }
}