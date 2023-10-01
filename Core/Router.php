<?php

namespace App\Core;

class Router
{
    public function route()
    {
        // Démarre la session
        session_start();

        // Récupère le nom du contrôleur à partir de la requête GET, sinon utilise le contrôleur par défaut 'home'
        $controller = isset($_GET['controller']) ? ucfirst($_GET['controller']) : ucfirst('home');

        // Construit le nom de la classe du contrôleur en ajoutant le namespace et le suffixe 'Controller'
        $controller = '\\App\\Controllers\\' . $controller . 'Controller';

        // Récupère le nom de l'action à partir de la requête GET, sinon utilise l'action 'index' par défaut
        $action = isset($_GET['action']) ? $_GET['action'] : 'index';

        // Instancie le contrôleur approprié
        $controller = new $controller();

        // Appelle la méthode de l'action sur le contrôleur
        $controller->$action();
    }
}
