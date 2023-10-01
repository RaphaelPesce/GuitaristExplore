<?php

namespace App\Entities;

class Image
{
    private $id_image;
    private $image_1;
    private $image_2;
    private $image_3;
    private $id_guitariste;
    private $id_materiel;

    /**
     * Get the value of id_image
     */
    public function getId_image()
    {
        return $this->id_image;
    }

    /**
     * Set the value of id_image
     *
     * @return  self
     */
    public function setId_image($id_image)
    {
        $this->id_image = $id_image;

        return $this;
    }

    /**
     * Get the value of image_1
     */
    public function getImage_1()
    {
        return $this->image_1;
    }

    /**
     * Set the value of image_1
     *
     * @return  self
     */
    public function setImage_1($image_1)
    {
        $this->image_1 = $image_1;

        return $this;
    }

    /**
     * Get the value of image_2
     */
    public function getImage_2()
    {
        return $this->image_2;
    }

    /**
     * Set the value of image_2
     *
     * @return  self
     */
    public function setImage_2($image_2)
    {
        $this->image_2 = $image_2;

        return $this;
    }

    /**
     * Get the value of image_3
     */
    public function getImage_3()
    {
        return $this->image_3;
    }

    /**
     * Set the value of image_3
     *
     * @return  self
     */
    public function setImage_3($image_3)
    {
        $this->image_3 = $image_3;

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
