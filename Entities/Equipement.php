<?php

namespace App\Entities;

class Equipement
{
    private $id_materiel;
    private $id_guitariste;

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
