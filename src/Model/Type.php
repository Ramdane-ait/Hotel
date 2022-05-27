<?php
namespace App\Model;

class Type {

    private $id;

    private $nom_type;

    private $nb_personnes;

    

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

    /**
     * Get the value of nom_type
     */ 
    public function getNomType()
    {
        return $this->nom_type;
    }

    /**
     * Set the value of nom_type
     *
     * @return  self
     */ 
    public function setNomType($nom_type)
    {
        $this->nom_type = $nom_type;

        return $this;
    }

    /**
     * Get the value of nb_personnes
     */ 
    public function getNbPersonnes()
    {
        return $this->nb_personnes;
    }

    /**
     * Set the value of nb_personnes
     *
     * @return  self
     */ 
    public function setNbPersonnes($nb_personnes)
    {
        $this->nb_personnes = $nb_personnes;

        return $this;
    }
}
