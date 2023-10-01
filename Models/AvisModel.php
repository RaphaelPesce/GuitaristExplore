<?php
// Utilisation de l'espace de noms App\Models
namespace App\Models;
// Importation des classes nécessaires

use PDO;
use Exception;
use App\Core\DbConnect;
use App\Entities\Avis;
use App\Entities\Utilisateur;

// Définition de la classe AvisModel qui hérite de DbConnect (classe pour la connexion à la base de données)
class AvisModel extends DbConnect
{

    // Méthode pour ajouter un avis à la base de données
    public function addAvisModel(Avis $avis)
    {
        try {
            // Préparation de la requête SQL pour insérer une nouvelle entrée dans la table "avis". 
            $this->request = $this->connection->prepare("INSERT INTO avis (note, commentaire, date, id_guitariste, id_utilisateur) 
            VALUES (:note, :commentaire, :date, :id_guitariste, :id_utilisateur)");

            // Liaison des valeurs à l'identifiant de paramètre dans la requête SQL préparée
            $this->request->bindValue(":note", $avis->getNote());
            $this->request->bindValue(":commentaire", $avis->getCommentaire());
            $this->request->bindValue(":date", $avis->getDate());
            $this->request->bindValue(":id_guitariste", $avis->getId_guitariste());
            $this->request->bindValue(":id_utilisateur", $avis->getId_utilisateur());

            // Exécution de la requête SQL
            $this->request->execute();
        } catch (Exception $e) {
            // Si une exception est levée (c'est-à-dire une erreur), le programme s'arrête et le message d'erreur est affiché.
            die('Erreur : ' . $e->getMessage());
        }
    }

    // Méthode pour obtenir tous les avis liés à un guitariste spécifique
    public function getAvisByGuitaristeId($id_guitariste)
    {

        try {
            // Préparer une requête SQL pour obtenir tous les avis où l'ID du guitariste correspond à celui fourni
            $this->request = $this->connection->prepare(
                "SELECT avis.*, utilisateur.pseudo as pseudo, utilisateur.avatar 
                FROM avis 
                INNER JOIN utilisateur ON avis.id_utilisateur = utilisateur.id_utilisateur
                WHERE avis.id_guitariste = :id_guitariste"
            );

            // Lier l'ID du guitariste fourni à la requête SQL
            $this->request->bindValue(":id_guitariste", $id_guitariste);

            // Exécuter la requête
            $this->request->execute();

            // Récupérer tous les résultats et les stocker dans la variable $avis
            $avis = $this->request->fetchAll();

            // Renvoyer les résultats
            return $avis;
        } catch (Exception $e) {
            // En cas d'exception, terminer le script et afficher le message d'erreur
            die('erreur :' . $e->getMessage());
        }
    }

    // Méthode pour obtenir le nombre de notes par ID utilisateur 
    public function getNbNotesByUtilisateurId(Utilisateur $utilisateur)
    {
        try {
            // Préparation de la requête SQL pour obtenir le nombre total de notes faites par un utilisateur spécifique.
            // La requête utilise une clause WHERE pour filtrer les notes en fonction de l'ID utilisateur.
            $this->request = $this->connection->prepare("SELECT COUNT(*) FROM avis WHERE id_utilisateur = :id_utilisateur");

            // Liaison de la valeur de l'ID utilisateur à la requête SQL préparée précédemment.
            $this->request->bindValue(":id_utilisateur", $utilisateur->getId_utilisateur());

            // Exécution de la requête SQL préparée.
            $this->request->execute();

            // Récupération du nombre total de notes sous forme de colonne unique. 
            // La méthode fetchColumn() est utilisée pour obtenir une seule valeur à partir du résultat de la requête.
            $nbNotes = $this->request->fetchColumn();

            // Retourne le nombre total de notes.
            return $nbNotes;
        } catch (Exception $e) { // Si une exception est levée lors de l'exécution du bloc "try", elle est capturée ici.
            // Arrête le script et affiche un message d'erreur.
            die('erreur :' . $e->getMessage());
        }
    }

    // Méthode pour obtenir le nombre de commentaires par ID d'utilisateur
    public function getNbCommentairesByUtilisateurId(Utilisateur $utilisateur)
    {
        try {

            $this->request = $this->connection->prepare("SELECT COUNT(*) FROM avis WHERE id_utilisateur = :id_utilisateur AND commentaire IS NOT NULL");
            // Liaison de la valeur de l'ID de l'utilisateur à l'identifiant de paramètre dans la requête SQL préparée
            $this->request->bindValue(":id_utilisateur", $utilisateur->getId_utilisateur());

            // Exécution de la requête SQL
            $this->request->execute();

            // Récupération du nombre de commentaires. fetchColumn() renvoie la première colonne du jeu de résultats de la requête
            // Dans ce cas, puisque la requête est "SELECT COUNT(*), le résultat sera le nombre de commentaires
            $nbCommentaires = $this->request->fetchColumn();

            // Retour du nombre de commentaires pour cet utilisateur
            return $nbCommentaires;
        } catch (Exception $e) {
            // Si une exception est levée (c'est-à-dire une erreur), le programme s'arrête et le message d'erreur est affiché.
            die('erreur :' . $e->getMessage());
        }
    }
}
