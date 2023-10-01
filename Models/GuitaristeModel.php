<?php
// Utilisation de l'espace de noms App\Models
namespace App\Models;

// Importation des classes nécessaires
use PDO;
use Exception;
use App\Core\DbConnect;
use App\Entities\Guitariste;
use App\Entities\Image;
use App\Entities\Utilisateur;

// Déclaration de la classe GuitaristeModel qui étend (hérite de) DbConnect, 
class GuitaristeModel extends DbConnect
{
    // Déclaration d'une méthode publique pour récupérer tous les guitaristes de la base de données
    public function findAll()
    {
        try {
            // Définition de la requête SQL pour récupérer tous les guitaristes, triés par nom en ordre croissant
            $this->request = "SELECT * FROM guitariste  ORDER BY nom ASC ";

            // Exécution de la requête SQL sur la base de données et stockage du résultat dans la variable $result
            $result = $this->connection->query($this->request);

            // Récupération de toutes les lignes de résultats sous forme d'un tableau et stockage dans la variable $list
            $list = $result->fetchAll();

            // Retour du tableau contenant tous les guitaristes
            return $list;
        } catch (Exception $e) {
            // Si une exception est levée (c'est-à-dire une erreur), le programme s'arrête et le message d'erreur est affiché.
            die('erreur :' . $e->getMessage());
        }
    }

    // Déclaration d'une méthode publique pour trouver un guitariste spécifique dans la base de données
    public function find(Guitariste $guitariste)
    {
        try {
            // Préparation de la requête SQL pour récupérer un guitariste et ses images associées.
            // Cette requête utilise une jointure gauche pour récupérer les informations du guitariste ainsi que les images associées.
            $this->request = $this->connection->prepare("SELECT guitariste.id_guitariste, guitariste.nom, guitariste.bio, image.image_1, 
             image.image_2, image.image_3
            FROM guitariste
            LEFT JOIN image ON guitariste.id_guitariste = image.id_guitariste
            WHERE guitariste.id_guitariste = :id_guitariste");

            // Liaison de la valeur de l'ID du guitariste à l'identifiant de paramètre dans la requête SQL préparée
            $this->request->bindValue(":id_guitariste", $guitariste->getId_guitariste());

            // Exécution de la requête SQL
            $this->request->execute();

            // Récupération du guitariste spécifique (et de ses images associées) sous forme de tableau associatif
            $guitariste = $this->request->fetch();

            // Retour du tableau associatif contenant les informations du guitariste et de ses images associées
            return $guitariste;
        } catch (Exception $e) {
            // Si une exception est levée (c'est-à-dire une erreur), le programme s'arrête et le message d'erreur est affiché.
            die('erreur :' . $e->getMessage());
        }
    }

    // Méthode pour obtenir le classement des guitaristes par leur note moyenne
    public function classementGuitaristes($limit)
    {
        try {
            // Préparation de la requête SQL pour récupérer les guitaristes et leur note moyenne.
            // Les guitaristes sont classés en fonction de la note moyenne en ordre décroissant. 
            // La requête ne retournera que le nombre de résultats défini par la variable $limit.
            $this->request = $this->connection->prepare(
                "SELECT guitariste.id_guitariste, guitariste.nom, guitariste.img_gtr, AVG(avis.note) AS moyenne_notes
            FROM guitariste
            INNER JOIN avis ON guitariste.id_guitariste = avis.id_guitariste
            GROUP BY guitariste.id_guitariste, guitariste.nom
            ORDER BY moyenne_notes DESC
            LIMIT :limit"
            );

            // Liaison de la valeur de la limite à l'identifiant de paramètre dans la requête SQL préparée.
            // PDO::PARAM_INT indique que le type de données est un entier.
            $this->request->bindValue(":limit", $limit, PDO::PARAM_INT);

            // Exécution de la requête SQL
            $this->request->execute();

            // Récupération de toutes les lignes de résultats sous forme d'un tableau et stockage dans la variable $classement
            $classement = $this->request->fetchAll();

            // Retour du tableau contenant le classement des guitaristes
            return $classement;
        } catch (Exception $e) {
            // Si une exception est levée (c'est-à-dire une erreur), le programme s'arrête et le message d'erreur est affiché.
            die('erreur :' . $e->getMessage());
        }
    }

    // Déclaration d'une méthode publique pour récupérer tous les guitaristes associés à un utilisateur spécifique
    public function getGuitaristesByUtilisateurId(Utilisateur $user)
    {
        try {
            // Préparation de la requête SQL pour récupérer les guitaristes associés à un utilisateur spécifique
            // Les informations requises sont spécifiques (id_guitariste, nom, bio, img_gtr)
            $this->request = $this->connection->prepare("SELECT guitariste.id_guitariste, guitariste.nom, guitariste.bio, guitariste.img_gtr 
            FROM guitariste WHERE id_utilisateur = :id_utilisateur");

            // Liaison de la valeur de l'ID de l'utilisateur à l'identifiant de paramètre dans la requête SQL préparée
            $this->request->bindValue(":id_utilisateur", $user->getId_utilisateur());

            // Exécution de la requête SQL
            $this->request->execute();

            // Récupération de tous les guitaristes associés à cet utilisateur sous forme d'un tableau
            $guitaristes = $this->request->fetchAll();

            // Retour du tableau contenant les guitaristes associés à cet utilisateur
            return $guitaristes;
        } catch (Exception $e) {
            // Si une exception est levée (c'est-à-dire une erreur), le programme s'arrête et le message d'erreur est affiché.
            die('erreur :' . $e->getMessage());
        }
    }
    // Déclaration d'une méthode publique pour ajouter un nouveau guitariste et ses images associées dans la base de données
    public function addGuitaristeModel(Guitariste $guitariste, Image $image)
    {
        try {
            // Préparation de la requête SQL pour insérer un nouveau guitariste dans la table 'guitariste'
            $this->request = $this->connection->prepare("INSERT INTO guitariste (nom, bio, img_gtr, id_utilisateur) 
            VALUES (:nom, :bio, :img_gtr, :id_utilisateur)");

            // Liaison des valeurs aux paramètres dans la requête SQL préparée
            $this->request->bindValue(":nom", $guitariste->getNom());
            $this->request->bindValue(":bio", $guitariste->getBio());
            $this->request->bindValue(":img_gtr", $guitariste->getImg_gtr());
            $this->request->bindValue(":id_utilisateur", $guitariste->getId_utilisateur());

            // Exécution de la requête SQL
            $this->request->execute();

            // Récupération de l'ID du dernier guitariste inséré
            $id_guitariste = $this->connection->lastInsertId();

            // Préparation de la requête SQL pour insérer les images associées au guitariste dans la table 'image'
            $this->request = $this->connection->prepare("INSERT INTO image (image_1, image_2, image_3, id_guitariste) 
            VALUES (:image_1, :image_2, :image_3, :id_guitariste)");

            // Liaison des valeurs aux paramètres dans la requête SQL préparée
            $this->request->bindValue(":image_1", $image->getImage_1());
            $this->request->bindValue(":image_2", $image->getImage_2());
            $this->request->bindValue(":image_3", $image->getImage_3());
            $this->request->bindValue(":id_guitariste", $guitariste->getId_guitariste());

            // Exécution de la requête SQL
            $this->request->execute();
        } catch (Exception $e) {
            // Si une exception est levée (c'est-à-dire une erreur), le programme s'arrête et le message d'erreur est affiché.
            die('Erreur : ' . $e->getMessage());
        }
    }

    // Déclaration d'une méthode publique pour mettre à jour un guitariste et ses images associées dans la base de données
    public function updateGuitaristeModel(Guitariste $guitariste, Image $image)
    {
        try {
            // Préparation de la requête SQL pour mettre à jour les détails d'un guitariste dans la table 'guitariste'
            $this->request = $this->connection->prepare("UPDATE guitariste SET nom = :nom, bio = :bio, img_gtr = :img_gtr 
            WHERE id_guitariste = :id_guitariste");

            // Liaison des valeurs aux paramètres dans la requête SQL préparée
            $this->request->bindValue(":nom", $guitariste->getNom());
            $this->request->bindValue(":bio", $guitariste->getBio());
            $this->request->bindValue(":img_gtr", $guitariste->getImg_gtr());
            $this->request->bindValue(":id_guitariste", $guitariste->getId_guitariste());

            // Exécution de la requête SQL
            $this->request->execute();

            // Préparation de la requête SQL pour mettre à jour les images associées à un guitariste dans la table 'image'
            $this->request = $this->connection->prepare("UPDATE image SET image_1 = :image_1, image_2 = :image_2, image_3 = :image_3 
            WHERE id_guitariste = :id_guitariste");

            // Liaison des valeurs aux paramètres dans la requête SQL préparée
            $this->request->bindValue(":image_1", $image->getImage_1());
            $this->request->bindValue(":image_2", $image->getImage_2());
            $this->request->bindValue(":image_3", $image->getImage_3());
            $this->request->bindValue(":id_guitariste", $guitariste->getId_guitariste());

            // Exécution de la requête SQL
            $this->request->execute();
        } catch (Exception $e) {
            // Si une exception est levée (c'est-à-dire une erreur), le programme s'arrête et le message d'erreur est affiché.
            die('Erreur : ' . $e->getMessage());
        }
    }
}
