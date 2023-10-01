<?php

namespace App;

class Autoloader
{
    // Enregistre l'autoloader
    static function register()
    {
        spl_autoload_register([
            __CLASS__,
            "autoload"
        ]);
    }

    // Charge automatiquement les classes lorsqu'elles sont utilisées
    static function autoload($class)
    {
        // Remplace le namespace de la classe par une chaîne vide
        $class = str_replace(__NAMESPACE__ . '\\', '', $class);

        // Remplace les antislashs par des slashs pour obtenir le chemin du fichier
        $class = str_replace('\\', '/', $class);

        // Construit le chemin complet vers le fichier de la classe
        $fichier = __DIR__ . '/' . $class . '.php';

        // Vérifie si le fichier de la classe existe
        if (file_exists($fichier)) {
            // Inclut le fichier de la classe
            include $fichier;
        }
    }
}
