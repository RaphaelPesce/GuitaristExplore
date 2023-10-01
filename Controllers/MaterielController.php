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

class MaterielController extends Controller
{
    public function addMateriel()
    {
        // ... votre code pour gérer l'ajout de matériel

        // Récupère tous les guitaristes associés à l'utilisateur
        $user = new Utilisateur();
        $user->setId_utilisateur($_SESSION['id_utilisateur']);
        $modelGuitariste = new GuitaristeModel();
        $idGuitaristeByUser = $modelGuitariste->getGuitaristesByUtilisateurId($user);

        // ... affichez votre formulaire d'ajout de matériel, en passant les guitaristes associés à l'utilisateur à la vue
        $this->render('materiel/addMateriel', ['idGuitaristeByUser' => $idGuitaristeByUser]);

        // ... le reste de votre code pour gérer l'ajout de matériel
    }

    public function updateMateriel()
    {
        $this->render('materiel/updateMateriel');
    }
}
