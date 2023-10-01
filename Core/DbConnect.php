<?php

// Ajouter un espace de noms pour la classe DbConnect
namespace App\Core;

// Importer les classes PDO et Exception dans l'espace de noms actuel
use PDO;
use Exception;

// Définir une nouvelle classe nommée DbConnect
class DbConnect
{
    // Déclaration des propriétés de la classe
    protected $connection;
    protected $request;

    // Déclaration de constantes de connexion à la base de données en local
    const SERVER = 'localhost';
    const USER = 'root';
    const PASSWORD = '';
    const DATABASE = 'guitaristexplore';

    // Déclaration de constantes de connexion à la base de données sur serveur de production
    /*const SERVER = 'sqlprive-pc2372-001.eu.clouddb.ovh.net:35167';
    const USER = 'cefiidev1327';
    const PASSWORD = '3A2e5wBu';
    const DATABASE = 'cefiidev1327';*/

    // Définition du constructeur de la classe
    public function __construct()
    {
        // Utilisation d'un bloc try/catch pour gérer les exceptions
        try {
            // Définir les options pour la connexion à la base de données
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Activer le mode d'erreur pour afficher les exceptions
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, // Définir le mode de récupération par défaut pour renvoyer un objet
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8" // Envoyer une commande SQL pour définir l'encodage des caractères
            ];

            // Créer une nouvelle instance de PDO pour se connecter à la base de données
            $this->connection = new PDO("mysql:host=" . self::SERVER . ";dbname=" . self::DATABASE, self::USER, self::PASSWORD, $options);
        } catch (Exception $error) { // Si une exception est levée...
            die('Erreur :' . $error->getMessage()); // Arrêter l'exécution du script et afficher le message d'erreur
        }
    }
}
