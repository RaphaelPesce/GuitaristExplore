<?php

namespace App\Entities;

class Materiel
{
    private $id_materiel;
    private $categorie;
    private $nom_materiel;
    private $description;
    private $img_mtr;

    /**
     * Get the value of id_materiel
     */
    public function getId_materiel()
    {
        return $this->id_materiel;
    }

    /**
     * Set the value of id_materiel
     *
     * @return  self
     */
    public function setId_materiel($id_materiel)
    {
        $this->id_materiel = $id_materiel;

        return $this;
    }

    /**
     * Get the value of categorie
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * Set the value of categorie
     *
     * @return  self
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get the value of nom_materiel
     */
    public function getNom_materiel()
    {
        return $this->nom_materiel;
    }

    /**
     * Set the value of nom_materiel
     *
     * @return  self
     */
    public function setNom_materiel($nom_materiel)
    {
        $this->nom_materiel = $nom_materiel;

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
     * Get the value of img_mtr
     */
    public function getImg_mtr()
    {
        return $this->img_mtr;
    }

    /**
     * Set the value of img_mtr
     *
     * @return  self
     */
    public function setImg_mtr($img_mtr)
    {
        $this->img_mtr = $img_mtr;

        return $this;
    }
}
