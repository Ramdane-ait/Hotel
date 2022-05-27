<?php 
namespace App\Model;

use DateTime;

class Client extends Utilisateur {

    private $date_naiss;

    private $sexe;

    private $tel;

    private $adresse;


    /**
     * Get the value of date_naiss
     */ 
    public function getDateNaiss()
    {
        return new DateTime($this->date_naiss);
    }

    /**
     * Set the value of date_naiss
     *
     * @return  self
     */ 
    public function setDateNaiss($date_naiss)
    {
        $this->date_naiss = $date_naiss;

        return $this;
    }

    /**
     * Get the value of sexe
     */ 
    public function getSexe()
    {
        return $this->sexe;
    }

    /**
     * Set the value of sexe
     *
     * @return  self
     */ 
    public function setSexe($sexe)
    {
        $this->sexe = $sexe;

        return $this;
    }

    /**
     * Get the value of tel
     */ 
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * Set the value of tel
     *
     * @return  self
     */ 
    public function setTel($tel)
    {
        $this->tel = $tel;

        return $this;
    }

    /**
     * Get the value of adresse
     */ 
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set the value of adresse
     *
     * @return  self
     */ 
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }
}