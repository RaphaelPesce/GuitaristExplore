<?php

// Définition du namespace du contrôleur
namespace App\Controllers;

// Import des classes nécessaires
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

// Définition de la classe GuitaristeController qui hérite de Controller
class GuitaristeController extends Controller
{
    // Méthode pour afficher la liste des guitaristes
    public function listeGuitariste()
    {
        // Création d'un nouvel objet GuitaristeModel
        $modelGuitariste = new GuitaristeModel();
        // Appel de la méthode findAll() pour récupérer tous les guitaristes
        $listGuitariste = $modelGuitariste->findAll();

        // Rendu de la vue listeGuitariste avec les données récupérées
        $this->render('guitariste/listeGuitariste', ['listGuitariste' => $listGuitariste]);
    }

    // Méthode pour afficher la fiche d'un guitariste
    public function ficheGuitariste()
    {
        // Récupération de l'ID du guitariste depuis l'URL
        $id_guitariste = isset($_GET['id']) ? htmlspecialchars($_GET['id']) : "";

        // Initialisation de l'objet guitariste avec l'ID récupéré et récupération des informations du guitariste depuis la base de données
        $guitariste = new Guitariste();
        $guitariste->setId_guitariste($id_guitariste);
        $modelGuitariste = new GuitaristeModel();
        $guitariste = $modelGuitariste->find($guitariste);

        // Initialisation de l'objet materiel avec l'ID récupéré et récupération des équipements du guitariste depuis la base de données
        $materielModel = new MaterielModel();
        $equipement = $materielModel->getEquipementByGuitaristeId($id_guitariste);

        // Initialisation de l'objet reglage avec l'ID récupéré et récupération des réglages du guitariste depuis la base de données
        $reglageModel = new ReglageModel();
        $reglages = $reglageModel->getReglagesByGuitaristeId($id_guitariste);

        // Initialisation de l'objet avis avec l'ID récupéré et récupération des avis sur le guitariste depuis la base de données
        $avisModel = new AvisModel();
        $avis = $avisModel->getAvisByGuitaristeId($id_guitariste);

        // Rendu de la vue ficheGuitariste avec les données récupérées
        $this->render('guitariste/ficheGuitariste', ['guitariste' => $guitariste, 'reglages' => $reglages, 'equipement' => $equipement, 'avis' => $avis]);
    }

    // Méthode pour afficher le classement des guitaristes
    public function classement()
    {
        // Création d'un nouvel objet GuitaristeModel
        $modelGuitariste = new GuitaristeModel();
        // Appel de la méthode classementGuitaristes() pour récupérer le classement des guitaristes
        $classement = $modelGuitariste->classementGuitaristes(50);

        // Rendu de la vue classement avec les données récupérées
        $this->render('guitariste/classement', ['classement' => $classement]);
    }

    // Méthode pour ajouter un nouveau guitariste
    public function addGuitariste()
    {
        $message = '';

        // Si le formulaire a été soumis
        if (isset($_POST['ajouter'])) {
            // Création d'un nouvel objet Guitariste avec les données du formulaire
            $guitariste = new Guitariste();
            $guitariste->setNom(isset($_POST['nom']) ? htmlspecialchars($_POST['nom']) : '');
            $guitariste->setBio(isset($_POST['bio']) ? htmlspecialchars($_POST['bio']) : '');
            // Enregistrement de l'image du guitariste
            move_uploaded_file($_FILES['img_gtr']['tmp_name'], "images/upload/" . $_FILES['img_gtr']['name']);
            $afficheImg_gtr = "images/upload/" . $_FILES['img_gtr']['name'];
            $guitariste->setImg_gtr($afficheImg_gtr);
            $guitariste->setId_utilisateur(isset($_SESSION['id_utilisateur']) ? htmlspecialchars($_SESSION['id_utilisateur']) : '');

            // Création d'un nouvel objet Image avec les données du formulaire
            $image = new Image();
            // Enregistrement des images du guitariste
            move_uploaded_file($_FILES['image_1']['tmp_name'], "images/upload/" . $_FILES['image_1']['name']);
            $afficheImage_1  = "images/upload/" . $_FILES['image_1']['name'];
            $image->setImage_1($afficheImage_1);
            move_uploaded_file($_FILES['image_2']['tmp_name'], "images/upload/" . $_FILES['image_2']['name']);
            $afficheImage_2 = "images/upload/" . $_FILES['image_2']['name'];
            $image->setImage_2($afficheImage_2);
            move_uploaded_file($_FILES['image_3']['tmp_name'], "images/upload/" . $_FILES['image_3']['name']);
            $afficheImage_3 = "images/upload/" . $_FILES['image_3']['name'];
            $image->setImage_3($afficheImage_3);
            // Création d'un nouvel objet GuitaristeModel et ajout du nouveau guitariste
            $guitaristeModel = new GuitaristeModel();
            $guitaristeModel->addGuitaristeModel($guitariste, $image);

            $message = "Le formulaire d'ajout guitariste a été envoyé avec succès !";
        }

        // Rendu de la vue addGuitariste avec le message
        $this->render('guitariste/addGuitariste', ['message' => $message]);
    }
    // Méthode pour mettre a jour un guitariste
    public function updateGuitariste()
    { {
            // vérifie si le bouton de soumission du formulaire est pressé
            if (isset($_POST['modifier'])) {
                // création d'un nouvel objet guitariste
                $guitariste = new Guitariste();

                // récupération et affectation des valeurs du formulaire à l'objet guitariste
                $guitariste->setId_guitariste(htmlspecialchars($_POST['id_guitariste']));
                $guitariste->setNom(htmlspecialchars($_POST['nom']));
                $guitariste->setBio(htmlspecialchars($_POST['bio']));

                // déplace l'image téléchargée dans le dossier "images/upload/"
                move_uploaded_file($_FILES['img_gtr']['tmp_name'], "images/upload/" . $_FILES['img_gtr']['name']);
                $imageGuitariste = "images/upload/" . $_FILES['img_gtr']['name'];
                $guitariste->setImg_gtr($imageGuitariste);

                // création d'un nouvel objet image
                $image = new Image();

                // déplace les images téléchargées dans le dossier "images/upload/"
                // et affecte leurs adresses à l'objet image
                move_uploaded_file($_FILES['image_1']['tmp_name'], "images/upload/" . $_FILES['image_1']['name']);
                $afficheImage_1  = "images/upload/" . $_FILES['image_1']['name'];
                $image->setImage_1($afficheImage_1);
                move_uploaded_file($_FILES['image_2']['tmp_name'], "images/upload/" . $_FILES['image_2']['name']);
                $afficheImage_2 = "images/upload/" . $_FILES['image_2']['name'];
                $image->setImage_2($afficheImage_2);
                move_uploaded_file($_FILES['image_3']['tmp_name'], "images/upload/" . $_FILES['image_3']['name']);
                $afficheImage_3 = "images/upload/" . $_FILES['image_3']['name'];
                $image->setImage_3($afficheImage_3);

                // création d'un nouvel objet GuitaristeModel et mise à jour du guitariste dans la base de données
                $guitaristeModel = new GuitaristeModel();
                $guitaristeModel->updateGuitaristeModel($guitariste, $image);
            }

            // récupère l'id du guitariste à partir de l'URL
            $id = isset($_GET['id']) ? htmlspecialchars($_GET['id']) : "";

            // création d'un nouvel objet guitariste
            $guitariste = new Guitariste();

            // affectation de l'id récupéré à l'objet guitariste
            $guitariste->setId_guitariste($id);

            // création d'un nouvel objet GuitaristeModel et récupération des informations du guitariste à partir de l'id
            $guitaristeModel = new GuitaristeModel();
            $guitariste = $guitaristeModel->find($guitariste);
        }
        // render la vue 'updateGuitariste' avec les informations du guitariste
        $this->render('guitariste/updateGuitariste', ['guitariste' => $guitariste]);
    }
}
