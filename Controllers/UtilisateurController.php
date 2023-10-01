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

// Définition de la classe UtilisateurController qui étend la classe de base Controller
class UtilisateurController extends Controller
{
    // Définition de la méthode inscription()
    public function inscription()
    {
        // Initialisation du message
        // Initialisation des messages
        $messagePseudo = '';
        $messageEmail = '';
        $messagePseudoAndEmail = '';
        $messageSuccess = '';

        // Vérifie si le formulaire a été soumis
        if (isset($_POST['envoyer'])) {
            // Récupération des données du formulaire
            $pseudo = htmlspecialchars($_POST['pseudo']);
            $email = htmlspecialchars($_POST['email']);
            $mdp = htmlspecialchars($_POST['mdp_user']);

            // Vérification si l'utilisateur existe déjà
            $user = new Utilisateur();
            $user->setPseudo($pseudo);
            $user->setEmail($email);
            // Création d'un nouvel objet UtilisateurModel pour interagir avec la base de données
            $modelUser = new UtilisateurModel();
            // Vérification si le pseudo ou l'email existent déjà
            $existingUserPseudoOrEmail = $modelUser->getUserByPseudoOrEmail($user);
            // Vérification si le couple pseudo-email existe déjà
            $existingUserPseudoAndEmail = $modelUser->getUserByPseudoAndEmail($user);

            // Si le couple pseudo-email existent déjà 
            if ($existingUserPseudoAndEmail) {
                $messagePseudoAndEmail = "Ce compte existe déjà !";
            } elseif ($existingUserPseudoOrEmail) {
                // Sinon si le pseudo existe déjà
                if ($existingUserPseudoOrEmail->pseudo == $pseudo) {
                    $messagePseudo = "Ce pseudo est déjà pris !";
                }
                // Sinon si l'email existe déjà
                if ($existingUserPseudoOrEmail->email == $email) {
                    $messageEmail = "Cette e-mail est déjà liée a un compte !";
                }
            }

            if (!$existingUserPseudoOrEmail && !$existingUserPseudoAndEmail) {
                // Si l'utilisateur n'existe pas, procède à l'inscription
                $user = new Utilisateur();
                $user->setPseudo($pseudo);
                $user->setEmail($email);
                $hash = password_hash($mdp, PASSWORD_DEFAULT); // Hashage du mot de passe
                $user->setMdp_user($hash); // Enregistrement du mot de passe hashé
                $user->setRole('user');

                $modelUser->inscriptionModel($user); // Inscription de l'utilisateur

                // Message de succès
                $messageSuccess = "Inscription réussie !";
            }
        }

        // Appelle la méthode render pour afficher la vue 'utilisateur/inscription' et passe le message en argument
        $this->render('utilisateur/inscription', [
            'messagePseudoAndEmail' => htmlspecialchars($messagePseudoAndEmail),
            'messagePseudo' => htmlspecialchars($messagePseudo),
            'messageEmail' => htmlspecialchars($messageEmail),
            'messageSuccess' => htmlspecialchars($messageSuccess)
        ]);
    }

    // Définition de la méthode connexion
    public function connexion()
    {
        // Initialisation du message et redirection 
        $message = '';
        $redirectUrl = '';
        // Vérifie si le formulaire de connexion a été soumis
        if (isset($_POST['connecter'])) {
            // Création d'une instance de UtilisateurModel
            $modelUser = new UtilisateurModel();

            // Tente de récupérer l'utilisateur par son pseudo
            $userLogin = $modelUser->connexionModel(htmlspecialchars($_POST['pseudo']));

            // Vérifie si l'utilisateur existe
            if ($userLogin) {
                // Crée une nouvelle instance de Utilisateur
                $user = new Utilisateur();
                $user->setId_utilisateur($userLogin->id_utilisateur);
                $user->setPseudo($userLogin->pseudo);
                $user->setEmail($userLogin->email);
                $user->setMdp_user($userLogin->mdp_user);

                // Enregistre l'avatar dans la session
                $_SESSION['avatar'] = $userLogin->avatar;

                // Vérifie si le mot de passe est correct
                if (password_verify($_POST['mdp_user'], $user->getMdp_user())) {
                    // Si le mot de passe est correct, régénère l'ID de session
                    session_regenerate_id();

                    // Enregistre l'ID utilisateur, le pseudo et l'email dans la session
                    $_SESSION['id_utilisateur'] = $user->getId_utilisateur();
                    $_SESSION['pseudo'] = $user->getPseudo();
                    $_SESSION['email'] = $user->getEmail();

                    // Redirige vers la page d'accueil
                    $redirectUrl = 'index.php';
                } else {
                    // Si le mot de passe est incorrect, génère un message d'erreur
                    $message = "Pseudo et ou mot de passe incorrect !";
                }
            } else {
                // Si le compte n'existe pas, génère un message d'erreur
                $message = "Pseudo et ou mot de passe incorrect !";
            }
        }
        // Si l'URL de redirection est définie, redirige vers cette URL
        if ($redirectUrl) {
            header('Location: ' . $redirectUrl);
            exit;
        }
        // Appelle la méthode render pour afficher la vue 'utilisateur/connexion' et passe le message en argument
        $this->render('utilisateur/connexion', ['message' => htmlspecialchars($message)]);
    }

    // Définition de la méthode connexion
    public function deconnexion()
    {
        // Détruit toutes les données associées à la session en cours
        session_destroy();

        // Redirige l'utilisateur vers la page de connexion
        header('Location: index.php?controller=utilisateur&action=connexion');
        exit();
    }
    // Définition de la méthode profil
    public function profil()
    {
        // Vérifie si l'utilisateur est connecté en vérifiant si l'ID de l'utilisateur existe en session
        if (isset($_SESSION['id_utilisateur'])) {
            $modelUser = new UtilisateurModel();

            // Crée une nouvelle instance de l'entité Utilisateur et définie son ID avec l'ID de l'utilisateur en session
            // puis récupère les informations de cet utilisateur via la méthode find du modèle Utilisateur
            $user = new Utilisateur();
            $user->setId_utilisateur($_SESSION['id_utilisateur']);
            $infoUtilisateur = $modelUser->find($user);
            $user->setPseudo($infoUtilisateur[0]->pseudo);

            // Si le formulaire de modification d'avatar a été soumis
            if (isset($_POST['ajouter'])) {
                // Vérifie si un fichier a été envoyé et s'il n'y a pas d'erreur avec ce fichier
                if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] == 0) {
                    $avatarFile = $_FILES['avatar']['name'];
                    $uploadDir = 'images/upload/';
                    $uploadFile = $uploadDir . basename($avatarFile);

                    // Déplace le fichier téléchargé dans le dossier d'upload
                    if (move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadFile)) {
                        // Si le déplacement a réussi, met à jour l'avatar de l'utilisateur dans la base de données et en session
                        $user->setAvatar($uploadFile);
                        $modelUser->updateAvatar($user);
                        $_SESSION['avatar'] = $uploadFile;
                    }
                } else {
                    echo "Failed to upload file.";
                }
            }

            // Récupère tous les guitaristes associés à l'utilisateur
            $idGuitaristeByUser = new Guitariste();
            $modelGuitariste = new GuitaristeModel();
            $idGuitaristeByUser = $modelGuitariste->getGuitaristesByUtilisateurId($user);

            // Récupère le nombre de notes et de commentaires laissés par l'utilisateur
            $modelAvis = new AvisModel();
            $nbNotes = $modelAvis->getNbNotesByUtilisateurId($user);
            $nbCommentaires = $modelAvis->getNbCommentairesByUtilisateurId($user);

            // Affiche la page de profil de l'utilisateur avec toutes les informations récupérées
            $this->render('utilisateur/profil', [
                'infoUtilisateur' => $infoUtilisateur,
                'idGuitaristeByUser' => $idGuitaristeByUser,
                'nbNotes' => $nbNotes,
                'nbCommentaires' => $nbCommentaires
            ]);
        } else {
            // Si l'utilisateur n'est pas connecté, redirige vers la page d'accueil
            echo "<meta http-equiv='refresh' content='0;URL=index.php'>";
        }
    }
}
