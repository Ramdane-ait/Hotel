<?php
namespace App\Model;

class Chambre {

    private $id;

    private $nom;

    private $description;

    private $prix;

    private $type_id;




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
     * Get the value of nom
     */ 
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set the value of nom
     *
     * @return  self
     */ 
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get the value of description
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */ 
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

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
     * Get the value of images
     */ 
    public function getImages()
    {
        return $this->images;
    }

    public function getImagePath(){
        return 'images_chambres/'  . $this->images;
    }
    /**
     * Set the value of images
     *
     * @return  self
     */ 
    public function setImages($image)
    {
        $this->images = $image;

        return $this;
    }

    public function getArrayImages():array
    {
        $arrayImages = [];
        $array = explode(',',$this->images);
        foreach($array as $image){
            $arrayImages[] = 'images_chambres/' . $image;
        }
        return $arrayImages;
    }
}