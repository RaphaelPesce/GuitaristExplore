<?php

namespace App\Entities;

class Reglage
{
    private $id_reglage;
    private $tonalite;
    private $id_materiel;

    /**
     * Get the value of id_reglage
     */
    public function getId_reglage()
    {
        return $this->id_reglage;
    }

    /**
     * Set the value of id_reglage
     *
     * @return  self
     */
    public function setId_reglage($id_reglage)
    {
        $this->id_reglage = $id_reglage;

        return $this;
    }

    /**
     * Get the value of tonalite
     */
    public function getTonalite()
    {
        return $this->tonalite;
    }

    /**
     * Set the value of tonalite
     *
     * @return  self
     */
    public function setTonalite($tonalite)
    {
        $this->tonalite = $tonalite;

        return $this;
    }

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
}
