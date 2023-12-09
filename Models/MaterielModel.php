<?php
// Utilisation de l'espace de noms App\Models
namespace App\Models;

// Importation des classes nécessaires
use PDO;
use Exception;
use App\Core\DbConnect;
use App\Entities\Materiel;
use App\Entities\Equipement;

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
            ORDER BY FIELD (materiel.categorie, 'Guitare', 'Amplificateur', 'Effet')");

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

    public function getAvailableMaterielForGuitaristeId($id_guitariste, $categorie)
    {
        try {
            $this->request = $this->connection->prepare("SELECT id_materiel, nom_materiel 
            FROM materiel 
            WHERE categorie = :categorie 
            AND id_materiel 
            NOT IN (SELECT id_materiel FROM 
            equipement 
            WHERE id_guitariste = :id_guitariste) 
            ORDER BY nom_materiel ASC");

            $this->request->bindValue(":categorie", $categorie);
            $this->request->bindValue(":id_guitariste", $id_guitariste);
            $this->request->execute();
            return $this->request->fetchAll();
        } catch (Exception $e) {
            die('Erreur :' . $e->getMessage());
        }
    }

    public function getMaterielDetailsById($id_materiel)
    {
        try {
            // Préparation de la requête pour récupérer les détails du matériel
            $this->request = $this->connection->prepare("SELECT nom_materiel, categorie, description, img_mtr 
            FROM materiel 
            WHERE id_materiel = :id_materiel");

            // Liaison du paramètre id_materiel
            $this->request->bindValue(":id_materiel", $id_materiel);

            // Exécution de la requête
            $this->request->execute();

            // Récupération des données
            return $this->request->fetch();
        } catch (Exception $e) {
            die('Erreur :' . $e->getMessage());
        }
    }

    public function addMaterielModel(Equipement $equipement)
    {
        try {
            $this->request = $this->connection->prepare("INSERT INTO equipement (id_materiel, id_guitariste) 
            VALUES (:id_materiel, :id_guitariste)");

            $this->request->bindValue(":id_materiel", $equipement->getId_materiel());
            $this->request->bindValue(":id_guitariste", $equipement->getId_guitariste());
            $this->request->execute();
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    public function addNewMaterielModel(Materiel $materiel)
    {
        try {
            $this->request = $this->connection->prepare("INSERT INTO materiel (nom_materiel, categorie, description, img_mtr) 
            VALUES (:nom_materiel, :categorie, :description, :img_mtr)");

            $this->request->bindValue(":nom_materiel", $materiel->getNom_materiel());
            $this->request->bindValue(":categorie", $materiel->getCategorie());
            $this->request->bindValue(":description", $materiel->getDescription());
            $this->request->bindValue(":img_mtr", $materiel->getImg_mtr());
            $this->request->execute();

            return $this->connection->lastInsertId();
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
            return null;
        }
    }
}
