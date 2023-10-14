<?php

// Définition du namespace du contrôleur
namespace App\Controllers;

// Importation des classes nécessaires
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

// Déclaration de la classe AvisController qui hérite de la classe Controller
class AvisController extends Controller
{
    // Déclaration de la méthode addAvis
    public function addAvis()
    {
        // Initialisation de la variable $message
        $message = '';

        // Vérification de la soumission du formulaire
        if (isset($_POST['ajouter'])) {
            // Création d'un nouvel objet Avis
            $avis = new Avis();

            // Remplissage de l'objet Avis avec les données du formulaire, en utilisant la fonction htmlspecialchars() pour éviter les injections de code
            $avis->setNote(isset($_POST['note']) ? htmlspecialchars($_POST['note']) : '');
            $avis->setCommentaire(isset($_POST['commentaire']) ? htmlspecialchars($_POST['commentaire']) : '');
            $avis->setDate(date('Y-m-d'));
            $avis->setId_guitariste(isset($_POST['id_guitariste']) ? htmlspecialchars($_POST['id_guitariste']) : '');

            // Récupération de l'ID de l'utilisateur à partir de la session
            $idUtilisateur = $_SESSION['id_utilisateur'];

            // Ajout de l'ID de l'utilisateur à l'objet Avis
            $avis->setId_utilisateur($idUtilisateur);

            // Création d'un nouvel objet AvisModel
            $avisModel = new AvisModel();

            // Appel de la méthode addAvisModel() de l'objet AvisModel pour ajouter l'avis à la base de données
            $avisModel->addAvisModel($avis);

            // Ajout d'un message indiquant que l'avis a été ajouté avec succès
            $message = "Le formulaire d'avis a été envoyé avec succès !";
        }

        // Création d'un nouvel objet GuitaristeModel
        $guitaristeModel = new GuitaristeModel();

        // Récupération de la liste de tous les guitaristes
        $listGuitariste = $guitaristeModel->findAll();

        // Appel de la méthode render() pour afficher la vue 'avis/addAvis', en passant la liste des guitaristes et le message en paramètre
        $this->render('avis/addAvis', [
            'listGuitariste' => $listGuitariste,
            'message' => $message
        ]);
    }
}
