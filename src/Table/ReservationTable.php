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

    public function verifyRoom($dateA,$dateD,$id){
        $sql = "SELECT id FROM chambre C
        WHERE C.id = :id AND C.id NOT IN (
           SELECT id_chambre FROM reservation R
           WHERE :dateA BETWEEN R.date_arrivee AND R.date_depart
           OR :dateD BETWEEN R.date_arrivee AND R.date_depart
           OR R.date_arrivee BETWEEN :dateA AND :dateD
           OR R.date_depart BETWEEN :dateA AND :dateD)";
       
        $params = ['id' => $id,'dateA' => $dateA,'dateD' => $dateD];
        $query = $this->pdo->prepare($sql);
        $query->setFetchMode(PDO::FETCH_CLASS,Chambre::class);
        $query->execute($params);
        return $query->fetchAll();

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

}