<?php
namespace App\Table;

use PDO;
use App\Model\Note;

final class NoteTable extends Table {

    protected $table = 'note';
    protected $class = Note::class;

    public function createNote(Note $note):void {
        $id = $this->create([
            'stars' => $note->getStars(),
            'comment' => $note->getComment(),
            'id_client' => $note->getIdClient(),      
        ]);
        
        $note->setId($id);
    }

    public function findNotes(){
        $sql = "SELECT * FROM {$this->table} WHERE stars >= 3 LIMIT 3";
        return $this->pdo->query($sql,PDO::FETCH_CLASS,$this->class)->fetchAll();
    }
}