<?php

namespace App\Entities;

class Admin
{
    private $id_admin;
    private $login;
    private $mdp_adm;

    /**
     * Get the value of id_admin
     */
    public function getId_admin()
    {
        return $this->id_admin;
    }

    /**
     * Set the value of id_admin
     *
     * @return  self
     */
    public function setId_admin($id_admin)
    {
        $this->id_admin = $id_admin;

        return $this;
    }

    /**
     * Get the value of login
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set the value of login
     *
     * @return  self
     */
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Get the value of mdp_adm
     */
    public function getMdp_adm()
    {
        return $this->mdp_adm;
    }

    /**
     * Set the value of mdp_adm
     *
     * @return  self
     */
    public function setMdp_adm($mdp_adm)
    {
        $this->mdp_adm = $mdp_adm;

        return $this;
    }
}
