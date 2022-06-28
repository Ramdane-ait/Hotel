<?php
namespace App\Table;

use PDO;
use App\Model\Client;
use App\Table\Exception\NotFoundException;

class ClientTable extends Table {

    protected $table = 'client';
    protected $class = Client::class;

    public function createClient(Client $client){
        $id = $this->create([
            'nom' => $client->getNom(),
            'prenom' => $client->getPrenom(),
            'email' => $client->getEmail(),
            'date_naiss' => $client->getDateNaiss()->format('Y-m-d'),
            'sexe' => $client->getSexe(),
            'tel' => $client->getTel(),
            'adresse' => $client->getAdresse(),
            'mdp' => password_hash($client->getMdp(), PASSWORD_DEFAULT)
        ]);
        
        $client->setId($id);
        
    }
    public function updateClient(Client $client):void {
        $this->update([
            'adresse' => $client->getAdresse(),
            'email' => $client->getEmail(),
            'tel' => $client->getTel(),
        ],$client->getId());
    }


    public function updateMdpClient(Client $client):void {
        $this->update(['mdp' => $client->getMdp()],$client->getId());
    }
    public function updateImageClient(Client $client):void {
        $this->update(['image_client' => $client->getImageClient()],$client->getId());
    }

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

    public function findMdp($id){
        $query = $this->pdo->prepare('SELECT mdp FROM '. $this->table . ' WHERE id=?');
        $query->execute([$id]);
        return $query->fetch()[0];
    }

    public function findNameAndImage($id) {
        $query = $this->pdo->prepare("SELECT CONCAT(nom,' ',prenom),image_client FROM {$this->table} WHERE id=?");
        $query->execute([$id]);  
        return $query->fetch();
        
    }
}