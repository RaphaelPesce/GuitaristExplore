<?php
// Utilisation de l'espace de noms App\Models
namespace App\Models;

// Importation des classes nécessaires
use PDO;
use Exception;
use App\Core\DbConnect;
use App\Entities\Reglage;

// Définition de la classe ReglageModel qui hérite de DbConnect (classe pour la connexion à la base de données)
class ReglageModel extends DbConnect
{
    // Déclaration d'une méthode publique pour obtenir les réglages d'un guitariste spécifique dans la base de données
    public function getReglagesByGuitaristeId($id_guitariste)
    {
        try {
            // Préparation de la requête SQL pour récupérer les réglages d'un guitariste spécifique.
            // Cette requête utilise une jointure interne pour récupérer les informations des réglages.
            $this->request = $this->connection->prepare("SELECT reglage.tonalite, materiel.nom_materiel, materiel.categorie
            FROM reglage
            INNER JOIN materiel ON reglage.id_materiel = materiel.id_materiel
            WHERE reglage.id_guitariste = :id_guitariste
            ORDER BY materiel.categorie, materiel.nom_materiel");

            // Liaison de la valeur de l'ID du guitariste à l'identifiant de paramètre dans la requête SQL préparée
            $this->request->bindValue(":id_guitariste", $id_guitariste);

            // Exécution de la requête SQL
            $this->request->execute();

            // Récupération de tous les réglages du guitariste spécifique sous forme de tableau associatif
            $reglages = $this->request->fetchAll();

            // Retour du tableau associatif contenant les réglages du guitariste
            return $reglages;
        } catch (Exception $e) {
            // Si une exception est levée (c'est-à-dire une erreur), le programme s'arrête et le message d'erreur est affiché.
            die('erreur :' . $e->getMessage());
        }
    }

    public function hasReglage($id_materiel, $id_guitariste)
    {
        try {
            // Préparation de la requête SQL pour compter le nombre de réglages pour un id_materiel et un id_guitariste donnés
            $this->request = $this->connection->prepare("SELECT COUNT(*) FROM reglage WHERE id_materiel = :id_materiel AND id_guitariste = :id_guitariste");
            // Liaison des id_materiel et id_guitariste à la requête pour éviter les injections SQL
            $this->request->bindValue(":id_materiel", $id_materiel, PDO::PARAM_INT);
            $this->request->bindValue(":id_guitariste", $id_guitariste, PDO::PARAM_INT);
            // Exécution de la requête
            $this->request->execute();

            // Récupération du nombre de réglages et renvoi d'un booléen (true si un réglage existe)
            $count = $this->request->fetchColumn();
            return $count > 0;
        } catch (Exception $e) {
            // Gestion des erreurs
            die('Erreur :' . $e->getMessage());
        }
    }

    public function addReglageModel(Reglage $reglage)
    {
        try {
            // Préparation de la requête SQL pour insérer un nouveau réglage
            $this->request = $this->connection->prepare("INSERT INTO reglage (tonalite, id_materiel, id_guitariste) 
            VALUES (:tonalite, :id_materiel, :id_guitariste)");

            // Liaison des valeurs en utilisant les getters de l'objet Reglage
            $this->request->bindValue(":tonalite", $reglage->getTonalite());
            $this->request->bindValue(":id_materiel", $reglage->getId_materiel());
            $this->request->bindValue(":id_guitariste", $reglage->getId_guitariste());

            // Exécution de la requête
            $this->request->execute();
        } catch (Exception $e) {
            die('Erreur :' . $e->getMessage());
        }
    }
}
