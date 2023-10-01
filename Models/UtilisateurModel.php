<?php
// Utilisation de l'espace de noms App\Models
namespace App\Models;

// Importation des classes nécessaires
use PDO;
use Exception;
use App\Core\DbConnect;
use App\Entities\Utilisateur;

// Définition de la classe UtilisateurModel qui hérite de DbConnect (classe pour la connexion à la base de données)
class UtilisateurModel extends DbConnect
{
    // Méthode pour inscrire un nouvel utilisateur dans la base de données
    public function inscriptionModel(Utilisateur $user)
    {
        try {
            // Préparation de la requête SQL pour insérer un nouvel utilisateur
            $this->request = $this->connection->prepare("INSERT INTO utilisateur (pseudo, email, mdp_user, avatar, role) VALUES (:pseudo, :email, :mdp_user, :avatar, :role)");

            // Liaison des valeurs à la requête préparée
            $this->request->bindValue(":pseudo", $user->getPseudo());
            $this->request->bindValue(":email", $user->getEmail());
            $this->request->bindValue(":mdp_user", $user->getMdp_user());
            $this->request->bindValue(":avatar", 'images/upload/Mon_Compte.png');
            $this->request->bindValue(":role", $user->getRole());

            // Exécution de la requête SQL
            $this->request->execute();
        } catch (Exception $e) {
            // En cas d'erreur, le programme s'arrête et affiche le message d'erreur
            die('erreur :' . $e->getMessage());
        }
    }

    // Méthode pour se connecter en tant qu'utilisateur existant
    public function connexionModel($pseudo)
    {
        try {
            // Préparation de la requête SQL pour récupérer les informations de l'utilisateur en fonction du pseudo
            $this->request = $this->connection->prepare("SELECT * FROM utilisateur WHERE pseudo = :pseudo");

            // Liaison de la valeur du pseudo à la requête préparée
            $this->request->bindParam(":pseudo", $pseudo);

            // Exécution de la requête SQL
            $this->request->execute();

            // Récupération des informations de l'utilisateur et renvoi de ces informations
            $user = $this->request->fetch();
            return $user;
        } catch (Exception $e) {
            // En cas d'erreur, le programme s'arrête et affiche le message d'erreur
            die('erreur :' . $e->getMessage());
        }
    }

    // Méthode pour obtenir un utilisateur par son pseudo ou son email
    public function getUserByPseudoOrEmail(Utilisateur $user)
    {
        try {
            // Préparation de la requête SQL pour récupérer les informations de l'utilisateur en fonction du pseudo ou de l'email
            $this->request = $this->connection->prepare("SELECT * FROM utilisateur WHERE pseudo = :pseudo OR email = :email");

            // Liaison des valeurs à la requête préparée
            $this->request->bindValue(":pseudo", $user->getPseudo());
            $this->request->bindValue(":email", $user->getEmail());

            // Exécution de la requête SQL
            $this->request->execute();

            // Récupération des informations de l'utilisateur et renvoi de ces informations
            $user = $this->request->fetch();
            return $user;
        } catch (Exception $e) {
            // En cas d'erreur, le programme s'arrête et affiche le message d'erreur
            die('erreur :' . $e->getMessage());
        }
    }

    // Cette méthode recherche un utilisateur en fonction du pseudo et de l'email 
    // (les deux conditions doivent être remplies, grâce à l'opérateur AND dans la requête SQL)
    public function getUserByPseudoAndEmail(Utilisateur $user)
    {
        try {
            // Préparation de la requête SQL pour récupérer les informations de l'utilisateur 
            // en fonction du pseudo et de l'email
            $this->request = $this->connection->prepare("SELECT * FROM utilisateur WHERE pseudo = :pseudo AND email = :email");

            // Liaison des valeurs à la requête préparée
            // Cela évite les injections SQL car cela échappe automatiquement les caractères spéciaux
            $this->request->bindValue(":pseudo", $user->getPseudo());
            $this->request->bindValue(":email", $user->getEmail());

            // Exécution de la requête SQL
            $this->request->execute();

            // Récupération des informations de l'utilisateur et renvoi de ces informations
            // fetch() récupère la ligne suivante d'un jeu de résultats
            // Ici, on s'attend à ce qu'il n'y ait qu'un seul résultat, car le pseudo et l'email sont uniques
            return $this->request->fetch();
        } catch (Exception $e) {
            // En cas d'erreur, le programme s'arrête et affiche le message d'erreur
            die('erreur :' . $e->getMessage());
        }
    }

    // Méthode pour mettre à jour l'avatar d'un utilisateur
    public function updateAvatar(Utilisateur $user)
    {
        try {
            // Préparation de la requête SQL pour mettre à jour l'avatar de l'utilisateur en fonction du pseudo
            $this->request = $this->connection->prepare("UPDATE utilisateur SET avatar = :avatar WHERE pseudo = :pseudo");

            // Liaison des valeurs à la requête préparée
            $this->request->bindValue(":avatar", $user->getAvatar());
            $this->request->bindValue(":pseudo", $user->getPseudo());

            // Exécution de la requête SQL
            $this->request->execute();
        } catch (Exception $e) {
            // En cas d'erreur, le programme s'arrête et affiche le message d'erreur
            die('erreur :' . $e->getMessage());
        }
    }

    // Méthode pour trouver un utilisateur par son ID
    public function find(Utilisateur $user)
    {
        try {
            // Préparation de la requête SQL pour trouver un utilisateur en fonction de son ID
            $this->request = $this->connection->prepare("SELECT * FROM utilisateur WHERE id_utilisateur = :id_utilisateur");

            // Liaison de la valeur de l'ID de l'utilisateur à la requête préparée
            $this->request->bindValue(":id_utilisateur", $user->getId_utilisateur());

            // Exécution de la requête SQL
            $this->request->execute();

            // Récupération des informations de l'utilisateur sous forme d'objets et renvoi de ces objets
            return $this->request->fetchAll();
        } catch (Exception $e) {
            // En cas d'erreur, le programme s'arrête et affiche le message d'erreur
            die('erreur :' . $e->getMessage());
        }
    }
}
