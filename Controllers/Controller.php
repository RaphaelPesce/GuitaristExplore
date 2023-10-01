<?php

// Déclaration d'un espace de noms pour la classe Controller
namespace App\Controllers;

// Déclaration d'une classe abstraite Controller
// Une classe abstraite est une classe qui ne peut pas être instanciée directement
abstract class Controller
{
    // Déclaration d'une méthode protégée render qui accepte une chaîne (chemin du fichier à inclure) et un tableau (données à passer à la vue)
    protected function render(string $path, array $data = [])
    {
        // La fonction extract convertit les clés de tableau en noms de variable et les valeurs de tableau en valeurs de variable
        extract($data);

        // La fonction ob_start démarre la temporisation de sortie.
        // Cela signifie que toute sortie qui est générée après cette fonction est stockée dans un tampon interne
        ob_start();

        // Inclure le fichier PHP qui correspond au chemin donné. Le chemin est relatif au répertoire parent de ce fichier
        // dirname(__DIR__) renvoie le chemin du répertoire parent de ce fichier
        include dirname(__DIR__) . '/views/' . $path . ".php";

        // ob_get_clean récupère le contenu du tampon de sortie et met fin à la temporisation de sortie
        // Le contenu du tampon de sortie est ensuite stocké dans la variable $content
        $content = ob_get_clean();

        // Inclut le fichier base.php qui est le layout principal de l'application
        // Il utilisera probablement la variable $content pour afficher le contenu de la vue spécifique
        include dirname(__DIR__) . '/views/base.php';
    }
}
