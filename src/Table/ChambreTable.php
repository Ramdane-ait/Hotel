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

    public function findRoom($idType){
        $query = $this->pdo->prepare("SELECT id FROM $this->table WHERE type_id = ? LIMIT 1");
        $query->execute([$idType]);
        return $query->fetch()[0];
    }
}