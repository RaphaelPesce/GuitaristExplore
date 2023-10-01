<?php

namespace App\Entities;

class Avis
{
    private $id_avis;
    private $note;
    private $commentaire;
    private $date;
    private $id_utilisateur;
    private $id_guitariste;

    /**
     * Get the value of id_avis
     */
    public function getId_avis()
    {
        return $this->id_avis;
    }

    /**
     * Set the value of id_avis
     *
     * @return  self
     */
    public function setId_avis($id_avis)
    {
        $this->id_avis = $id_avis;

        return $this;
    }

    /**
     * Get the value of note
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set the value of note
     *
     * @return  self
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get the value of commentaire
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }

    /**
     * Set the value of commentaire
     *
     * @return  self
     */
    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    /**
     * Get the value of date
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set the value of date
     *
     * @return  self
     */
    public function setDate($date)
    {
        $this->date = $date;

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
}
