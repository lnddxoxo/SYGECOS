<?php
session_start();

// Headers de sécurité
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');

require_once __DIR__ . '../src/Controller/LoginController.php';

$loginController = new LoginController();

// Gestion des actions via GET
$action = $_GET['action'] ?? '';

switch ($action) {
    case 'logout':
        $loginController->logout();
        break;
        
    default:
        // Si connecté → dashboard, sinon → login
        if ($loginController->isLoggedIn()) {
            // Vérifier l'auth et afficher le dashboard
            $loginController->requireAuth();
            $currentUser = $loginController->getCurrentUser();
            require_once __DIR__ . '../src/View/home.php';
        } else {
            // Traiter la connexion ou afficher le formulaire
            $loginController->login();
        }
        break;
}
?>