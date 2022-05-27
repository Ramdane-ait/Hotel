<?php
namespace App\Model;

class Image {

    private $id;
    private $name;
    private $id_chambre;

   

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
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of idChambre
     */ 
    public function getIdChambre()
    {
        return $this->id_chambre;
    }

    /**
     * Set the value of idChambre
     *
     * @return  self
     */ 
    public function setIdChambre($idChambre)
    {
        $this->id_chambre = $idChambre;

        return $this;
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }
    public function getPath()
    {
        return 'images_chambres/'. $this->name;
    }
}