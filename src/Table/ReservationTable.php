<?php
namespace App\Table;

use PDO;
use DateTime;

use App\Model\Chambre;
use App\Model\Reservation;
use App\Model\Type;

class ReservationTable extends Table {

    protected $class = Reservation::class;
    protected $table = 'reservation';


   
    public function createReservation(Reservation $r):int{
        return $this->create([
            'id_chambre' => $r->getIdChambre(),
            'id_client' => $r->getIdClient(),
            'date_arrivee' => $r->getDateArrivee(),
            'date_depart' => $r->getDateDepart(),
            'prix' => $r->getPrix() 
        ]);
        
    }

    public function verifyDispo($dateA,$dateD){
        $sql = "SELECT * FROM chambre C
        WHERE C.id NOT IN (
           SELECT id_chambre FROM reservation R
           WHERE :dateA BETWEEN R.date_arrivee AND R.date_depart
           OR :dateD BETWEEN R.date_arrivee AND R.date_depart
           OR R.date_arrivee BETWEEN :dateA AND :dateD
           OR R.date_depart BETWEEN :dateA AND :dateD)";
       
        $params = ['dateA' => $dateA,'dateD' => $dateD];
        $query = $this->pdo->prepare($sql);
        $query->setFetchMode(PDO::FETCH_CLASS,Chambre::class);
        $query->execute($params);
        return $query->fetchAll();

    }

    public function findTypeDispo($dateA,$dateD){
        $sql = "SELECT DISTINCT T.id,T.nom_type,T.nb_personnes,T.prix
        FROM type T
        LEFT JOIN chambre C on T.id = C.type_id
                WHERE C.id NOT IN (
                   SELECT id_chambre FROM reservation R
                   WHERE :dateA BETWEEN R.date_arrivee AND R.date_depart
                   OR :dateD BETWEEN R.date_arrivee AND R.date_depart
                   OR R.date_arrivee BETWEEN :dateA AND :dateD
                   OR R.date_depart BETWEEN :dateA AND :dateD)
                AND C.id IS NOT NULL";
       
        $params = ['dateA' => $dateA,'dateD' => $dateD];
        $query = $this->pdo->prepare($sql);
        $query->setFetchMode(PDO::FETCH_CLASS,Type::class);
        $query->execute($params);
        return $query->fetchAll();

    }

    public function selectRoom($dateA,$dateD,$idType){
        $sql = "SELECT C.id FROM chambre C
        LEFT JOIN type T ON C.type_id = T.id
        WHERE C.id NOT IN (
           SELECT id_chambre FROM reservation R
           WHERE :dateA BETWEEN R.date_arrivee AND R.date_depart
           OR :dateD BETWEEN R.date_arrivee AND R.date_depart
           OR R.date_arrivee BETWEEN :dateA AND :dateD
           OR R.date_depart BETWEEN :dateA AND :dateD)
        AND C.type_id = :idType LIMIT 1";
       
        $params = ['dateA' => $dateA,'dateD' => $dateD,'idType' => $idType];
        $query = $this->pdo->prepare($sql);
        $query->execute($params);
        return $query->fetch()[0];
    }


    public function verifyType($dateA,$dateD,$idType){
        $sql = "SELECT DISTINCT COUNT(T.id) FROM type T
            LEFT JOIN chambre C ON C.type_id = T.id
                WHERE C.id NOT IN (
                   SELECT id_chambre FROM reservation R
                   WHERE :dateA BETWEEN R.date_arrivee AND R.date_depart
                   OR :dateD BETWEEN R.date_arrivee AND R.date_depart
                   OR R.date_arrivee BETWEEN :dateA AND :dateD
                   OR R.date_depart BETWEEN :dateA AND :dateD)
                 AND C.type_id = :idType";
       
        $params = ['idType' => $idType,'dateA' => $dateA,'dateD' => $dateD];
        $query = $this->pdo->prepare($sql);
        $query->execute($params);
        return (int)$query->fetch(PDO::FETCH_NUM)[0] > 0;

    }

    public function addAddons($idRes,$idAddon) {
        $query = $this->pdo->prepare(
            "INSERT INTO addon_reservation 
                    SET id_addon = :idAddon, id_reservation = :idRes"
            );
        
        return $query->execute([
            'idAddon' => $idAddon,
            'idRes' => $idRes
        ]);
        
    }

    public function getReservations($idClient) {
        $query = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE id_client = ? AND date_arrivee > DATE(NOW())");
        $query->setFetchMode(PDO::FETCH_CLASS,$this->class);
        $query->execute([$idClient]);
        return $query->fetchAll();

    }

}