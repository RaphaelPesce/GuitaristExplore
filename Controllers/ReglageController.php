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
    public function checkReglageForMateriel()
    {
        // Récupération des ID du matériel et du guitariste depuis la requête GET
        $id_materiel = isset($_GET['id_materiel']) ? htmlspecialchars($_GET['id_materiel']) : "";
        $id_guitariste = isset($_GET['id_guitariste']) ? htmlspecialchars($_GET['id_guitariste']) : "";
        // Création d'une instance de MaterielModel
        $materielModel = new ReglageModel();
        // Appel de la méthode hasReglage pour vérifier si un réglage existe
        $hasReglage = $materielModel->hasReglage($id_materiel, $id_guitariste);
        // Renvoi de la réponse en format JSON
        echo json_encode(['hasReglage' => $hasReglage]);
    }


    public function addReglage()
    {
        if (isset($_POST['ajouterReglage'])) {
            // Création d'une instance de Reglage
            $reglage = new Reglage();
            $reglage->setTonalite(isset($_POST['tonalite']) ? htmlspecialchars($_POST['tonalite']) : '');
            $reglage->setId_materiel(isset($_POST['id_materiel']) ? htmlspecialchars($_POST['id_materiel']) : '');
            $reglage->setId_guitariste(isset($_POST['id_guitariste']) ? htmlspecialchars($_POST['id_guitariste']) : '');

            // Création d'une instance de votre modèle et appel de la méthode pour ajouter un réglage
            $reglageModel = new ReglageModel();
            $reglageModel->addReglageModel($reglage);

            // Redirection ou affichage d'un message de succès
        }

        // Récupère tous les guitaristes associés à l'utilisateur
        $user = new Utilisateur();
        $user->setId_utilisateur($_SESSION['id_utilisateur']);

        $modelGuitariste = new GuitaristeModel();
        $idGuitaristeByUser = $modelGuitariste->getGuitaristesByUtilisateurId($user);

        $this->render('reglage/addReglage', ['idGuitaristeByUser' => $idGuitaristeByUser]);
    }

    public function updateReglage()
    {
        $this->render('reglage/updateReglage');
    }
}
