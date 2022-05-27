<?php 
namespace App\Model;

class Addon {

    private $id;

    private $nom_addon;

    private $description_addon;

    private $prix_addon;

    private $image_addon;

    

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
     * Get the value of nom_addon
     */ 
    public function getNom()
    {
        return $this->nom_addon;
    }

    /**
     * Set the value of nom_addon
     *
     * @return  self
     */ 
    public function setNom($nom_addon)
    {
        $this->nom_addon = $nom_addon;

        return $this;
    }

    /**
     * Get the value of description_addon
     */ 
    public function getDescription()
    {
        return $this->description_addon;
    }

    /**
     * Set the value of description_addon
     *
     * @return  self
     */ 
    public function setDescription($description_addon)
    {
        $this->description_addon = $description_addon;

        return $this;
    }

    /**
     * Get the value of prix_addon
     */ 
    public function getPrix()
    {
        return $this->prix_addon;
    }

    /**
     * Set the value of prix_addon
     *
     * @return  self
     */ 
    public function setPrix($prix_addon)
    {
        $this->prix_addon = $prix_addon;

        return $this;
    }

    /**
     * Get the value of image_addon
     */ 
    public function getImage()
    {
        return $this->image_addon;
    }

    /**
     * Set the value of image_addon
     *
     * @return  self
     */ 
    public function setImage($image_addon)
    {
        $this->image_addon = $image_addon;

        return $this;
    }
}