<?php
namespace App\Table;

use PDO;
use App\Model\Image;
use App\Table\Exception\NotFoundException;

final class ImageTable extends Table{
    
    protected $table = 'image';
    protected $class = Image::class;
   
    public function createImage(Image $image):void {
        $id = $this->create([
            'name' => $image->getName(),
            'id_chambre' => $image->getIdChambre(),      
        ]);
        
        $image->setId($id);
    }
    public function updateImage(Image $image):void {
        $id = $this->update([
            'name' => $image->getName(),
        ],$image->getId());
    }
    public function findImages(int $idChambre){
        $query = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE id_chambre = :idChambre");
        $query->execute(['idChambre' => $idChambre]);
        $query->setFetchMode(PDO::FETCH_CLASS,$this->class);
        $result = $query->fetchAll();
        if ($result === false){
            throw new NotFoundException($this->table,$idChambre);
        }
        return $result;
    
    }
}