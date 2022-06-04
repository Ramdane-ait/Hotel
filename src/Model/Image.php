<?php
namespace App\Model;

class Image {

    private $id;
    private $name;
    private $id_type;

   

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

    /**
     * Get the value of id_type
     */ 
    public function getIdType()
    {
        return $this->id_type;
    }

    /**
     * Set the value of id_type
     *
     * @return  self
     */ 
    public function setIdType($id_type)
    {
        $this->id_type = $id_type;

        return $this;
    }
}