<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Entities\Admin;
use App\Models\AvisModel;
use App\Entities\Avis;
use App\Models\EquipementModel;
use App\Entities\Equipement;
use App\Models\GuitaristeModel;
use App\Entities\Guitariste;
use App\Models\ImageModel;
use App\Entities\Image;
use App\Models\MaterielModel;
use App\Entities\Materiel;
use App\Models\ReglageModel;
use App\Entities\Reglage;
use App\Models\UtilisateurModel;
use App\Entities\Utilisateur;

class ReglageController extends Controller
{
    public function addReglage()
    {
        $this->render('reglage/addReglage');
    }

    public function updateReglage()
    {
        $this->render('reglage/updateReglage');
    }
}
