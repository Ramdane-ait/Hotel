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