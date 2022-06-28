<?php
namespace App\Model;

class Chambre {

    private $id;

    private $type_id;

    private $dispo;


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
     * Get the value of type
     */ 
    public function getTypeId()
    {
        return $this->type_id;
    }

    /**
     * Set the value of type
     *
     * @return  self
     */ 
    public function setTypeId($type)
    {
        $this->type_id = $type;

        return $this;
    }

   

    /**
     * Get the value of dispo
     */ 
    public function getDispo()
    {
        return $this->dispo;
    }

    /**
     * Set the value of dispo
     *
     * @return  self
     */ 
    public function setDispo($dispo)
    {
        $this->dispo = $dispo;

        return $this;
    }
}