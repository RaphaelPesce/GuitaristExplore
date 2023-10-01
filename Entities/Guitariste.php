<?php

namespace App\Entities;

class Guitariste
{
    private $id_guitariste;
    private $nom;
    private $bio;
    private $img_gtr;
    private $id_utilisateur;

    /**
     * Get the value of id_guitariste
     */
    public function getId_guitariste()
    {
        return $this->id_guitariste;
    }

    /**
     * Set the value of id_guitariste
     *
     * @return  self
     */
    public function setId_guitariste($id_guitariste)
    {
        $this->id_guitariste = $id_guitariste;

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
     * Get the value of bio
     */
    public function getBio()
    {
        return $this->bio;
    }

    /**
     * Set the value of bio
     *
     * @return  self
     */
    public function setBio($bio)
    {
        $this->bio = $bio;

        return $this;
    }

    /**
     * Get the value of img_gtr
     */
    public function getImg_gtr()
    {
        return $this->img_gtr;
    }

    /**
     * Set the value of img_gtr
     *
     * @return  self
     */
    public function setImg_gtr($img_gtr)
    {
        $this->img_gtr = $img_gtr;

        return $this;
    }

    /**
     * Get the value of id_utilisateur
     */
    public function getId_utilisateur()
    {
        return $this->id_utilisateur;
    }

    /**
     * Set the value of id_utilisateur
     *
     * @return  self
     */
    public function setId_utilisateur($id_utilisateur)
    {
        $this->id_utilisateur = $id_utilisateur;

        return $this;
    }
}
