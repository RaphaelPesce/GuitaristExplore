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
            $this->request = $this->connection->prepare("SELECT reglage.tonalite, materiel.nom_materiel
            FROM reglage
            INNER JOIN materiel ON reglage.id_materiel = materiel.id_materiel
            WHERE reglage.id_guitariste = :id_guitariste");

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
}
