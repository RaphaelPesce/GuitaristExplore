<?php
// Utilisation de l'espace de noms App\Models
namespace App\Models;

// Importation des classes nécessaires
use PDO;
use Exception;
use App\Core\DbConnect;
use App\Entities\Materiel;

// Définition de la classe MaterielModel qui hérite de DbConnect (classe pour la connexion à la base de données)
class MaterielModel extends DbConnect
{
    // Déclaration d'une méthode publique pour obtenir l'équipement d'un guitariste spécifique dans la base de données
    public function getEquipementByGuitaristeId($id_guitariste)
    {
        try {
            // Préparation de la requête SQL pour récupérer l'équipement d'un guitariste spécifique.
            // Cette requête utilise une jointure interne pour récupérer les informations de l'équipement.
            $this->request = $this->connection->prepare("SELECT materiel.nom_materiel, materiel.categorie, materiel.description, materiel.img_mtr
            FROM materiel
            INNER JOIN Equipement ON materiel.id_materiel = Equipement.id_materiel
            WHERE Equipement.id_guitariste = :id_guitariste
            ORDER BY FIELD(materiel.categorie, 'guitare', 'amplificateur', 'pédale d\'effet')");

            // Liaison de la valeur de l'ID du guitariste à l'identifiant de paramètre dans la requête SQL préparée
            $this->request->bindValue(":id_guitariste", $id_guitariste);

            // Exécution de la requête SQL
            $this->request->execute();

            // Récupération de tout l'équipement du guitariste spécifique sous forme de tableau associatif
            $equipement = $this->request->fetchAll();

            // Retour du tableau associatif contenant l'équipement du guitariste
            return $equipement;
        } catch (Exception $e) {
            // Si une exception est levée (c'est-à-dire une erreur), le programme s'arrête et le message d'erreur est affiché.
            die('erreur :' . $e->getMessage());
        }
    }
}
