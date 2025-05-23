<?php
require_once __DIR__ . '/Database.php';

class LoginModel {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    /**
     
     */
    public function authenticate($login, $password) {
        try {
            // 1. Chercher l'utilisateur avec groupe = 5 (Responsable de filière)
            $stmt = $this->db->prepare("
                SELECT u.id_util, u.login_util, u.mdp_util,
                       p.fk_id_GU as group_id, gu.lib_GU as group_name,
                       e.id_ens, e.nom_ens, e.prenom_ens, e.email
                FROM utilisateur u
                JOIN posseder p ON u.id_util = p.fk_id_util
                JOIN groupe_utilisateur gu ON p.fk_id_GU = gu.id_GU
                JOIN enseignant e ON u.id_util = e.fk_id_util
                WHERE u.login_util = ? AND p.fk_id_GU = 5
            ");
            $stmt->execute([$login]);
            $user = $stmt->fetch();

            if (!$user) {
                return false;
            }

            // 2. Vérifier le mot de passe (SHA256)
            $hashedPassword = hash('sha256', $password);
            if ($user['mdp_util'] !== $hashedPassword) {
                return false;
            }

            // 3. Retourner les infos utilisateur
            unset($user['mdp_util']);
            return $user;

        } catch (Exception $e) {
            error_log("Erreur d'authentification: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Mettre à jour la dernière activité
     */
    public function updateLastActivity($userId) {
        try {
            $stmt = $this->db->prepare("UPDATE utilisateur SET last_activity = NOW() WHERE id_util = ?");
            $stmt->execute([$userId]);
        } catch (Exception $e) {
            error_log("Erreur updateLastActivity: " . $e->getMessage());
        }
    }

    /**
     * Logger une connexion
     */
    public function logConnection($userId, $success = true) {
        try {
            $stmt = $this->db->prepare("
                INSERT INTO pister (fk_id_util, dte_acc, heure_pist, acceder) 
                VALUES (?, CURDATE(), CURTIME(), ?)
            ");
            $stmt->execute([$userId, $success ? 'oui' : 'non']);
        } catch (Exception $e) {
            error_log("Erreur logConnection: " . $e->getMessage());
        }
    }
}

