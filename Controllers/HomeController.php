<?php

// Utilisation de l'espace de noms App\Controllers
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

// Définition de la classe HomeController, qui étend la classe de base Controller
class HomeController extends Controller
{
    // Définition de la méthode index(), qui sert à afficher la page d'accueil
    public function index()
    {
        // Appelle la méthode render (définie dans Controller) pour afficher la vue 'home/index'
        $this->render('home/index');
    }

    // Définition de la méthode charte(), qui sert à afficher la page de la charte
    public function charte()
    {
        // Appelle la méthode render (définie dans Controller) pour afficher la vue 'home/charte'
        $this->render('home/charte');
    }
}
