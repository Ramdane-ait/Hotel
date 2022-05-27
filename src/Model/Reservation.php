<?php 
namespace App\Model;

use DateTime;

class Reservation {

    private $idChambre;
    private $idClient;
    private $dateArrivee;
    private $dateDepart;

    /**
     * Get the value of idChambre
     */ 
    public function getIdChambre()
    {
        return $this->idChambre;
    }

    /**
     * Set the value of idChambre
     *
     * @return  self
     */ 
    public function setIdChambre($idChambre)
    {
        $this->idChambre = $idChambre;

        return $this;
    }

    /**
     * Get the value of idClient
     */ 
    public function getIdClient()
    {
        return $this->idClient;
    }

    /**
     * Set the value of idClient
     *
     * @return  self
     */ 
    public function setIdClient($idClient)
    {
        $this->idClient = $idClient;

        return $this;
    }

    /**
     * Get the value of dateArrivee
     */ 
    public function getDateArrivee()
    {
        return $this->dateArrivee;
    }

    /**
     * Set the value of dateArrivee
     *
     * @return  self
     */ 
    public function setDateArrivee($dateArrivee)
    {
        $this->dateArrivee = $dateArrivee;

        return $this;
    }

    /**
     * Get the value of dateDepart
     */ 
    public function getDateDepart()
    {
        return $this->dateDepart;
    }

    /**
     * Set the value of dateDepart
     *
     * @return  self
     */ 
    public function setDateDepart($dateDepart)
    {
        $this->dateDepart = $dateDepart;

        return $this;
    }

}