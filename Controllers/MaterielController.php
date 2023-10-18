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
    public function getMaterielForGuitariste()
    {
        // Récupération de l'ID du guitariste depuis l'URL
        $id_guitariste = isset($_GET['id']) ? htmlspecialchars($_GET['id']) : "";

        // Initialisation du modèle MaterielModel et récupération des matériels associés au guitariste depuis la base de données
        $materielModel = new MaterielModel();
        $materiel = $materielModel->getEquipementByGuitaristeId($id_guitariste);

        // Envoi immédiat de la réponse à la requête AJAX
        echo json_encode($materiel);
    }

    public function addMateriel()
    {
        // Récupère tous les guitaristes associés à l'utilisateur
        $user = new Utilisateur();
        $user->setId_utilisateur($_SESSION['id_utilisateur']);
        $modelGuitariste = new GuitaristeModel();
        $idGuitaristeByUser = $modelGuitariste->getGuitaristesByUtilisateurId($user);

        // Affichez votre formulaire d'ajout de matériel, en passant les guitaristes associés à l'utilisateur à la vue
        $this->render('materiel/addMateriel', ['idGuitaristeByUser' => $idGuitaristeByUser]);
    }

    public function updateMateriel()
    {
        $this->render('materiel/updateMateriel');
    }
}
