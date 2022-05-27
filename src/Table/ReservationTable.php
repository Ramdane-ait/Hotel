<?php
namespace App\Table;

use PDO;
use DateTime;

use App\Model\Chambre;
use App\Model\Reservation;

class ReservationTable extends Table {

    protected $class = Reservation::class;
    protected $table = 'reservation';


   
    public function createReservation(Reservation $r):void {
        $this->create([
            'id_chambre' => $r->getIdChambre(),
            'id_client' => $r->getIdClient(),
            'date_arrivee' => $r->getDateArrivee(),
            'date_depart' => $r->getDateDepart(),
            'type_paiement' => $r->getTypePaiement()
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


}