<?php 
namespace App\Model;

use DateTime;

class Reservation {
    private $id;
    private $id_chambre;
    private $id_client;
    private $date_arrivee;
    private $date_depart;
    private $prix;

    

    /**
     * Get the value of prix
     */ 
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set the value of prix
     *
     * @return  self
     */ 
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get the value of id_chambre
     */ 
    public function getIdChambre()
    {
        return $this->id_chambre;
    }

    /**
     * Set the value of id_chambre
     *
     * @return  self
     */ 
    public function setIdChambre($id_chambre)
    {
        $this->id_chambre = $id_chambre;

        return $this;
    }

    /**
     * Get the value of id_client
     */ 
    public function getIdClient()
    {
        return $this->id_client;
    }

    /**
     * Set the value of id_client
     *
     * @return  self
     */ 
    public function setIdClient($id_client)
    {
        $this->id_client = $id_client;

        return $this;
    }

    /**
     * Get the value of date_arrivee
     */ 
    public function getDateArrivee()
    {
        return $this->date_arrivee;
    }

    /**
     * Set the value of date_arrivee
     *
     * @return  self
     */ 
    public function setDateArrivee($date_arrivee)
    {
        $this->date_arrivee = $date_arrivee;

        return $this;
    }

    /**
     * Get the value of date_depart
     */ 
    public function getDateDepart()
    {
        return $this->date_depart;
    }

    /**
     * Set the value of date_depart
     *
     * @return  self
     */ 
    public function setDateDepart($date_depart)
    {
        $this->date_depart = $date_depart;

        return $this;
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}