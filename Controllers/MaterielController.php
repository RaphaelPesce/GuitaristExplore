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
        // Convertir les données en JSON et les retourner
        echo json_encode($materiel);
    }

    public function getAvailableMaterielForGuitariste()
    {
        $id_guitariste = isset($_GET['id']) ? htmlspecialchars($_GET['id']) : "";
        $categorie = $_GET['categorie'];
        $materielModel = new MaterielModel();
        $availableMateriel = $materielModel->getAvailableMaterielForGuitaristeId($id_guitariste, $categorie);

        echo json_encode($availableMateriel);
    }

    public function materielDetails()
    {
        $id_materiel = isset($_GET['id']) ? htmlspecialchars($_GET['id']) : "";

        // Création de l'instance du modèle
        $materielModel = new MaterielModel();

        // Appel de la méthode pour obtenir les détails du matériel
        $detailMateriel = $materielModel->getMaterielDetailsById($id_materiel);

        // Renvoi des données en format JSON
        echo json_encode($detailMateriel);
    }

    public function addMateriel()
    {
        if (isset($_POST['ajouter'])) {
            $equipement = new Equipement();
            $equipement->setId_materiel(isset($_POST['id_materiel']) ? htmlspecialchars($_POST['id_materiel']) : '');
            $equipement->setId_guitariste(isset($_POST['id_guitariste']) ? htmlspecialchars($_POST['id_guitariste']) : '');
            // Instance du modèle MaterielModel
            $equipementModel = new MaterielModel();
            // Lier le matériel au guitariste
            $equipementModel->addMaterielModel($equipement);
        }
        // Récupère tous les guitaristes associés à l'utilisateur
        $user = new Utilisateur();
        $user->setId_utilisateur($_SESSION['id_utilisateur']);
        $modelGuitariste = new GuitaristeModel();
        $idGuitaristeByUser = $modelGuitariste->getGuitaristesByUtilisateurId($user);

        // Affichez votre formulaire d'ajout de matériel, en passant les guitaristes associés à l'utilisateur à la vue
        $this->render('materiel/addMateriel', ['idGuitaristeByUser' => $idGuitaristeByUser]);
    }

    public function addNewMateriel()
    {
        if (isset($_POST['ajouterNew'])) {
            $materiel = new Materiel();
            $materiel->setNom_materiel(isset($_POST['nom_materiel']) ? htmlspecialchars($_POST['nom_materiel']) : '');
            $materiel->setCategorie(isset($_POST['categorie']) ? htmlspecialchars($_POST['categorie']) : '');
            $materiel->setDescription(isset($_POST['description']) ? htmlspecialchars($_POST['description']) : '');
            move_uploaded_file($_FILES['img_mtr']['tmp_name'], "images/upload/" . $_FILES['img_mtr']['name']);
            $imageMateriel = "images/upload/" . $_FILES['img_mtr']['name'];
            $materiel->setImg_mtr($imageMateriel);

            // Instance du modèle MaterielModel
            $materielModel = new MaterielModel();
            $id_materiel = $materielModel->addNewMaterielModel($materiel);

            if ($id_materiel) {
                $equipement = new Equipement();
                $equipement->setId_materiel($id_materiel);
                $equipement->setId_guitariste(isset($_POST['id_guitariste']) ? htmlspecialchars($_POST['id_guitariste']) : '');
                $equipementModel = new MaterielModel();
                $equipementModel->addMaterielModel($equipement);
            }
        }
        $this->render('materiel/addMateriel');
    }

    public function updateMateriel()
    {
        $this->render('materiel/updateMateriel');
    }
}
