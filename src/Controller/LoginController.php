<?php
require_once __DIR__ . '/../Model/Database.php';
require_once __DIR__ . '/../Model/LoginModel.php';

class LoginController {
    private $loginModel;

    public function __construct() {
        $this->loginModel = new LoginModel();
    }

    /**
     * Gestion de la connexion
     */
    public function login() {
        // Si déjà connecté, rediriger
        if ($this->isLoggedIn()) {
            $this->redirectToResponsableFiliere();
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->processLogin();
        } else {
            $this->showLoginForm();
        }
    }

    /**
     * Traitement de la connexion
     */
    private function processLogin() {
        $login = trim($_POST['login'] ?? '');
        $password = $_POST['password'] ?? '';

        // Validation de base
        if (empty($login) || empty($password)) {
            $_SESSION['error'] = 'Tous les champs sont requis.';
            $this->showLoginForm();
            return;
        }

        // Authentification
        $user = $this->loginModel->authenticate($login, $password);

        if ($user) {
            $this->handleSuccessfulLogin($user);
        } else {
            $this->handleFailedLogin();
        }
    }

    /**
     * Gestion de la connexion réussie
     */
    private function handleSuccessfulLogin($user) {
        session_regenerate_id(true);
    
        // Stocker les informations en session
        $_SESSION['user_id'] = $user['id_util'];
        $_SESSION['user_specific_id'] = $user['id_ens'];
        $_SESSION['user_type'] = 'responsable_filiere';
        $_SESSION['user_group_id'] = $user['group_id'];
        $_SESSION['user_group_name'] = $user['group_name'];
        $_SESSION['user_name'] = $user['nom_ens'] . ' ' . $user['prenom_ens'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_login'] = $user['login_util'];
        $_SESSION['login_time'] = time();
        $_SESSION['last_activity'] = time();
    
        $this->loginModel->updateLastActivity($user['id_util']);
        $this->loginModel->logConnection($user['id_util'], true);
    
        $_SESSION['success'] = 'Connexion réussie ! Bienvenue ' . $_SESSION['user_name'];
        
        // SIMPLE redirection vers la même page
        $this->showDashboard();
        exit();
    }
    private function showDashboard() {
        $currentUser = $this->getCurrentUser();
        require_once __DIR__ . '/../View/home.php';
    }
    /**
     * Gestion de la connexion échouée
     */
    private function handleFailedLogin() {
        $_SESSION['error'] = 'Identifiants incorrects ou vous n\'êtes pas un Responsable de Filière.';
        $this->showLoginForm();
    }

    /**
     * Redirection vers le dashboard du responsable de filière
     */
    private function redirectToResponsableFiliere() {
        header('Location: index.php');
        exit();
    }

    /**
     * Déconnexion
     */
    public function logout() {
        $_SESSION = [];
        
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        
        session_destroy();
        
        session_start();
        $_SESSION['success'] = 'Vous avez été déconnecté avec succès.';
        header('Location: index.php');
        exit();
    }
    /**
     * Middleware d'authentification - UNIQUEMENT RESPONSABLE DE FILIÈRE
     */
    public function requireAuth() {
        if (!$this->isLoggedIn() || $_SESSION['user_group_id'] != 5) {
            $_SESSION['error'] = 'Accès réservé aux Responsables de Filière.';
            header('Location: /login.php');
            exit();
        }

        // Vérifier l'expiration de session (30 minutes)
        if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 1800)) {
            $this->logout();
            return;
        }

        // Mettre à jour l'activité
        $_SESSION['last_activity'] = time();
        $this->loginModel->updateLastActivity($_SESSION['user_id']);
    }

    /**
     * Vérifier si l'utilisateur est connecté
     */
    public function isLoggedIn() {
        return isset($_SESSION['user_id']) && 
               isset($_SESSION['user_type']) && 
               $_SESSION['user_type'] === 'responsable_filiere' &&
               $_SESSION['user_group_id'] == 5;
    }

    /**
     * Obtenir les informations de l'utilisateur actuel
     */
    public function getCurrentUser() {
        if (!$this->isLoggedIn()) {
            return null;
        }

        return [
            'id' => $_SESSION['user_id'],
            'specific_id' => $_SESSION['user_specific_id'],
            'type' => $_SESSION['user_type'],
            'group_id' => $_SESSION['user_group_id'],
            'group_name' => $_SESSION['user_group_name'],
            'name' => $_SESSION['user_name'],
            'email' => $_SESSION['user_email'],
            'login' => $_SESSION['user_login'],
            'login_time' => $_SESSION['login_time'] ?? null
        ];
    }

    /**
     * Afficher le formulaire de connexion
     */
    private function showLoginForm() {
        if (!isset($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        
        require __DIR__ . '/../View/login.php';
    }
}

