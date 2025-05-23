<?php
/**
 * Composant Navbar Modulaire SYGECOS
 * Fichier: components/navbar.php
 * 
 * Usage: include_once 'components/navbar.php';
 */

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: /login.php');
    exit();
}

// Récupérer les informations utilisateur
$user_name = $_SESSION['user_name'] ?? 'Utilisateur';
$user_type = $_SESSION['user_type'] ?? 'guest';
$user_email = $_SESSION['user_email'] ?? '';

// Configuration des menus selon le type d'utilisateur
$menu_config = [
    'etudiant' => [
        'dashboard' => ['icon' => 'fas fa-home', 'label' => 'Tableau de Bord', 'url' => '/dashboard/student.php'],
        'rapports' => [
            'icon' => 'fas fa-file-alt', 
            'label' => 'Mes Rapports',
            'submenu' => [
                'deposer' => ['label' => 'Déposer un Rapport', 'url' => '/student/deposit_report.php'],
                'liste' => ['label' => 'Mes Rapports', 'url' => '/student/my_reports.php'],
                'statut' => ['label' => 'Statut Validation', 'url' => '/student/validation_status.php']
            ]
        ],
        'stage' => [
            'icon' => 'fas fa-briefcase',
            'label' => 'Stage',
            'submenu' => [
                'informations' => ['label' => 'Informations Stage', 'url' => '/student/internship_info.php'],
                'entreprise' => ['label' => 'Mon Entreprise', 'url' => '/student/company_info.php']
            ]
        ],
        'notifications' => ['icon' => 'fas fa-bell', 'label' => 'Notifications', 'url' => '/student/notifications.php']
    ],
    
    'enseignant' => [
        'dashboard' => ['icon' => 'fas fa-home', 'label' => 'Tableau de Bord', 'url' => '/dashboard/teacher.php'],
        'etudiants' => [
            'icon' => 'fas fa-users',
            'label' => 'Mes Étudiants',
            'submenu' => [
                'encadres' => ['label' => 'Étudiants Encadrés', 'url' => '/teacher/supervised_students.php'],
                'rapports' => ['label' => 'Rapports à Valider', 'url' => '/teacher/reports_to_validate.php']
            ]
        ],
        'commission' => [
            'icon' => 'fas fa-gavel',
            'label' => 'Commission',
            'submenu' => [
                'validation' => ['label' => 'Validation Rapports', 'url' => '/teacher/commission_validation.php'],
                'comptes_rendus' => ['label' => 'Comptes Rendus', 'url' => '/teacher/reports_summary.php']
            ]
        ],
        'planning' => ['icon' => 'fas fa-calendar', 'label' => 'Planning', 'url' => '/teacher/schedule.php']
    ],
    
    'personnel' => [
        'dashboard' => ['icon' => 'fas fa-home', 'label' => 'Tableau de Bord', 'url' => '/dashboard/admin.php'],
        'gestion_etudiants' => [
            'icon' => 'fas fa-user-graduate',
            'label' => 'Gestion Étudiants',
            'submenu' => [
                'liste' => ['label' => 'Liste Étudiants', 'url' => '/admin/students_list.php'],
                'inscriptions' => ['label' => 'Inscriptions', 'url' => '/admin/registrations.php'],
                'notes' => ['label' => 'Saisie Notes', 'url' => '/admin/grades_entry.php']
            ]
        ],
        'validation' => [
            'icon' => 'fas fa-check-circle',
            'label' => 'Validation',
            'submenu' => [
                'niveau1' => ['label' => 'Vérification N1', 'url' => '/admin/validation_n1.php'],
                'niveau2' => ['label' => 'Validation N2', 'url' => '/admin/validation_n2.php'],
                'historique' => ['label' => 'Historique', 'url' => '/admin/validation_history.php']
            ]
        ],
        'rapports' => [
            'icon' => 'fas fa-chart-bar',
            'label' => 'Rapports & Stats',
            'submenu' => [
                'exports' => ['label' => 'Exports', 'url' => '/admin/exports.php'],
                'statistiques' => ['label' => 'Statistiques', 'url' => '/admin/statistics.php'],
                'tableaux_bord' => ['label' => 'Tableaux de Bord', 'url' => '/admin/dashboards.php']
            ]
        ],
        'parametres' => [
            'icon' => 'fas fa-cog',
            'label' => 'Paramètres',
            'submenu' => [
                'ue_ecue' => ['label' => 'UE/ECUE', 'url' => '/admin/ue_management.php'],
                'utilisateurs' => ['label' => 'Utilisateurs', 'url' => '/admin/users_management.php'],
                'systeme' => ['label' => 'Système', 'url' => '/admin/system_settings.php']
            ]
        ]
    ]
];

// Obtenir la page actuelle
$current_page = basename($_SERVER['PHP_SELF']);
$current_path = $_SERVER['REQUEST_URI'];

// Fonction pour déterminer si un menu est actif
function isActive($url, $current_path) {
    return strpos($current_path, $url) !== false;
}

// Générer le breadcrumb
function generateBreadcrumb($current_path, $menu_config, $user_type) {
    $breadcrumb = [['label' => 'Accueil', 'url' => '/dashboard/']];
    
    foreach ($menu_config[$user_type] as $key => $menu) {
        if (isset($menu['submenu'])) {
            foreach ($menu['submenu'] as $subkey => $submenu) {
                if (isActive($submenu['url'], $current_path)) {
                    $breadcrumb[] = ['label' => $menu['label'], 'url' => '#'];
                    $breadcrumb[] = ['label' => $submenu['label'], 'url' => $submenu['url'], 'active' => true];
                    return $breadcrumb;
                }
            }
        } elseif (isActive($menu['url'], $current_path)) {
            $breadcrumb[] = ['label' => $menu['label'], 'url' => $menu['url'], 'active' => true];
            return $breadcrumb;
        }
    }
    
    return $breadcrumb;
}

$breadcrumb = generateBreadcrumb($current_path, $menu_config, $user_type);
?>

<style>
/* Styles pour la navbar - Intégré dans le composant */
:root {
    --primary-color: #2c3e50;
    --secondary-color: #3498db;
    --accent-color: #e74c3c;
    --success-color: #27ae60;
    --warning-color: #f39c12;
    --danger-color: #e74c3c;
    --text-primary: #2c3e50;
    --text-secondary: #6c757d;
    --text-light: #ffffff;
    --text-muted: #adb5bd;
    --bg-primary: #ffffff;
    --bg-secondary: #f8f9fa;
    --bg-sidebar: #34495e;
    --spacing-xs: 0.25rem;
    --spacing-sm: 0.5rem;
    --spacing-md: 1rem;
    --spacing-lg: 1.5rem;
    --spacing-xl: 2rem;
    --border-radius: 6px;
    --border-radius-lg: 8px;
    --border-color: #dee2e6;
    --shadow-sm: 0 1px 2px rgba(0, 0, 0, 0.05);
    --shadow-md: 0 4px 6px rgba(0, 0, 0, 0.1);
    --transition-base: 200ms ease-in-out;
    --font-primary: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    --font-heading: 'Montserrat', 'Inter', sans-serif;
    --text-sm: 0.875rem;
    --text-base: 1rem;
    --text-lg: 1.125rem;
    --text-xl: 1.25rem;
    --text-2xl: 1.5rem;
}

.navbar-container {
    display: flex;
    min-height: 100vh;
}

/* Sidebar */
.navbar-sidebar {
    width: 250px;
    background-color: var(--bg-sidebar);
    color: var(--text-light);
    transition: all var(--transition-base);
    height: 100vh;
    position: sticky;
    top: 0;
    overflow-y: auto;
    z-index: 1000;
}

.navbar-sidebar.collapsed {
    width: 80px;
}

.sidebar-header {
    padding: var(--spacing-lg);
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.sidebar-brand {
    font-family: var(--font-heading);
    font-weight: 600;
    font-size: var(--text-xl);
    color: var(--text-light);
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: var(--spacing-sm);
    transition: all var(--transition-base);
}

.sidebar-brand i {
    font-size: var(--text-2xl);
    color: var(--secondary-color);
}

.sidebar-brand .brand-text {
    transition: opacity var(--transition-base);
}

.navbar-sidebar.collapsed .brand-text {
    opacity: 0;
    width: 0;
    overflow: hidden;
}

.sidebar-menu {
    padding: var(--spacing-md) 0;
}

.menu-title {
    padding: var(--spacing-sm) var(--spacing-lg);
    font-size: var(--text-sm);
    text-transform: uppercase;
    letter-spacing: 0.05em;
    color: var(--text-muted);
    margin-top: var(--spacing-md);
    transition: opacity var(--transition-base);
}

.navbar-sidebar.collapsed .menu-title {
    opacity: 0;
    height: 0;
    padding: 0;
    margin: 0;
    overflow: hidden;
}

.menu-item {
    display: flex;
    align-items: center;
    padding: var(--spacing-sm) var(--spacing-lg);
    color: var(--text-light);
    text-decoration: none;
    transition: all var(--transition-base);
    border-left: 3px solid transparent;
    cursor: pointer;
}

.menu-item:hover {
    background-color: rgba(255, 255, 255, 0.05);
    border-left-color: var(--secondary-color);
    color: var(--text-light);
    text-decoration: none;
}

.menu-item.active {
    background-color: rgba(255, 255, 255, 0.1);
    border-left-color: var(--secondary-color);
}

.menu-item i {
    margin-right: var(--spacing-sm);
    width: 24px;
    text-align: center;
    font-size: var(--text-lg);
}

.menu-item .menu-text {
    flex: 1;
    transition: opacity var(--transition-base);
}

.menu-item .menu-arrow {
    margin-left: auto;
    transition: all var(--transition-base);
    font-size: var(--text-sm);
}

.menu-item.collapsed .menu-arrow {
    transform: rotate(-90deg);
}

.navbar-sidebar.collapsed .menu-text,
.navbar-sidebar.collapsed .menu-arrow {
    opacity: 0;
    width: 0;
    overflow: hidden;
}

.navbar-sidebar.collapsed .menu-item {
    justify-content: center;
    padding: var(--spacing-md) 0;
}

.navbar-sidebar.collapsed .menu-item i {
    margin-right: 0;
}

.submenu {
    background-color: rgba(0, 0, 0, 0.1);
    overflow: hidden;
    max-height: 0;
    transition: max-height var(--transition-base);
}

.submenu.show {
    max-height: 500px;
}

.navbar-sidebar.collapsed .submenu {
    display: none;
}

.submenu-item {
    padding: var(--spacing-xs) var(--spacing-lg);
    padding-left: calc(var(--spacing-lg) + 40px);
    color: var(--text-light);
    text-decoration: none;
    display: block;
    opacity: 0.8;
    font-size: var(--text-sm);
    transition: all var(--transition-base);
}

.submenu-item:hover {
    opacity: 1;
    color: var(--secondary-color);
    text-decoration: none;
    background-color: rgba(255, 255, 255, 0.05);
}

.submenu-item.active {
    opacity: 1;
    color: var(--secondary-color);
    font-weight: 500;
    background-color: rgba(52, 152, 219, 0.1);
}

/* Topbar */
.navbar-topbar {
    background-color: var(--bg-primary);
    padding: var(--spacing-md) var(--spacing-lg);
    box-shadow: var(--shadow-sm);
    display: flex;
    align-items: center;
    justify-content: space-between;
    position: sticky;
    top: 0;
    z-index: 999;
    border-bottom: 1px solid var(--border-color);
}

.topbar-left {
    display: flex;
    align-items: center;
}

.sidebar-toggle {
    background: none;
    border: none;
    color: var(--text-secondary);
    font-size: var(--text-lg);
    margin-right: var(--spacing-md);
    cursor: pointer;
    padding: var(--spacing-sm);
    border-radius: var(--border-radius);
    transition: all var(--transition-base);
}

.sidebar-toggle:hover {
    background-color: var(--bg-secondary);
    color: var(--primary-color);
}

.breadcrumb {
    display: flex;
    align-items: center;
    list-style: none;
    margin: 0;
}

.breadcrumb-item {
    font-size: var(--text-sm);
}

.breadcrumb-item a {
    color: var(--text-secondary);
    text-decoration: none;
    transition: color var(--transition-base);
}

.breadcrumb-item a:hover {
    color: var(--primary-color);
}

.breadcrumb-item.active {
    color: var(--text-primary);
    font-weight: 500;
}

.breadcrumb-divider {
    margin: 0 var(--spacing-sm);
    color: var(--text-muted);
    font-size: var(--text-sm);
}

.topbar-right {
    display: flex;
    align-items: center;
    gap: var(--spacing-lg);
}

.topbar-item {
    position: relative;
}

.topbar-link {
    display: flex;
    align-items: center;
    color: var(--text-secondary);
    text-decoration: none;
    transition: color var(--transition-base);
    padding: var(--spacing-sm);
    border-radius: var(--border-radius);
}

.topbar-link:hover {
    color: var(--primary-color);
    background-color: var(--bg-secondary);
    text-decoration: none;
}

.topbar-icon {
    font-size: var(--text-xl);
}

.topbar-badge {
    position: absolute;
    top: -2px;
    right: -2px;
    background-color: var(--danger-color);
    color: white;
    border-radius: 50%;
    width: 18px;
    height: 18px;
    font-size: var(--text-xs);
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
}

.user-profile {
    display: flex;
    align-items: center;
    gap: var(--spacing-sm);
    padding: var(--spacing-sm);
    border-radius: var(--border-radius);
    transition: background-color var(--transition-base);
    cursor: pointer;
}

.user-profile:hover {
    background-color: var(--bg-secondary);
}

.user-avatar {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid var(--border-color);
}

.user-info {
    display: flex;
    flex-direction: column;
}

.user-name {
    font-weight: 600;
    font-size: var(--text-sm);
    color: var(--text-primary);
    line-height: 1.2;
}

.user-role {
    font-size: var(--text-xs);
    color: var(--text-secondary);
    text-transform: capitalize;
}

/* Dropdown pour profil utilisateur */
.user-dropdown {
    position: absolute;
    top: 100%;
    right: 0;
    background: var(--bg-primary);
    border: 1px solid var(--border-color);
    border-radius: var(--border-radius-lg);
    box-shadow: var(--shadow-md);
    min-width: 200px;
    z-index: 1001;
    opacity: 0;
    visibility: hidden;
    transform: translateY(-10px);
    transition: all var(--transition-base);
}

.user-dropdown.show {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

.dropdown-item {
    display: flex;
    align-items: center;
    padding: var(--spacing-sm) var(--spacing-md);
    color: var(--text-primary);
    text-decoration: none;
    transition: background-color var(--transition-base);
    font-size: var(--text-sm);
}

.dropdown-item:hover {
    background-color: var(--bg-secondary);
    text-decoration: none;
    color: var(--text-primary);
}

.dropdown-item i {
    margin-right: var(--spacing-sm);
    width: 16px;
    text-align: center;
}

.dropdown-divider {
    height: 1px;
    background-color: var(--border-color);
    margin: var(--spacing-xs) 0;
}

/* Responsive */
@media (max-width: 992px) {
    .navbar-sidebar {
        transform: translateX(-100%);
        position: fixed;
        z-index: 1002;
    }
    
    .navbar-sidebar.show {
        transform: translateX(0);
    }
    
    .breadcrumb {
        display: none;
    }
    
    .topbar-right {
        gap: var(--spacing-md);
    }
    
    .user-info {
        display: none;
    }
}

@media (max-width: 768px) {
    .navbar-topbar {
        padding: var(--spacing-sm) var(--spacing-md);
    }
    
    .topbar-right {
        gap: var(--spacing-sm);
    }
    
    .user-profile {
        padding: var(--spacing-xs);
    }
    
    .user-avatar {
        width: 32px;
        height: 32px;
    }
}
</style>

<div class="navbar-container">
    <!-- Sidebar -->
    <aside class="navbar-sidebar" id="sidebar">
        <div class="sidebar-header">
            <a href="/dashboard/" class="sidebar-brand">
                <i class="fas fa-graduation-cap"></i>
                <span class="brand-text">SYGECOS</span>
            </a>
        </div>
        
        <nav class="sidebar-menu">
            <?php if (isset($menu_config[$user_type])): ?>
                <div class="menu-title"><?= strtoupper($user_type) ?></div>
                
                <?php foreach ($menu_config[$user_type] as $key => $menu): ?>
                    <?php if (isset($menu['submenu'])): ?>
                        <!-- Menu avec sous-menu -->
                        <div class="menu-item <?= isActive('', $current_path) ? 'active' : '' ?>" 
                             data-toggle="collapse" data-target="#<?= $key ?>">
                            <i class="<?= $menu['icon'] ?>"></i>
                            <span class="menu-text"><?= $menu['label'] ?></span>
                            <i class="fas fa-chevron-down menu-arrow"></i>
                        </div>
                        <div class="submenu" id="<?= $key ?>">
                            <?php foreach ($menu['submenu'] as $subkey => $submenu): ?>
                                <a href="<?= $submenu['url'] ?>" 
                                   class="submenu-item <?= isActive($submenu['url'], $current_path) ? 'active' : '' ?>">
                                    <?= $submenu['label'] ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <!-- Menu simple -->
                        <a href="<?= $menu['url'] ?>" 
                           class="menu-item <?= isActive($menu['url'], $current_path) ? 'active' : '' ?>">
                            <i class="<?= $menu['icon'] ?>"></i>
                            <span class="menu-text"><?= $menu['label'] ?></span>
                        </a>
                    <?php endif; ?>
                <?php endforeach; ?>
                
                <!-- Menu Déconnexion -->
                <div class="menu-title">SYSTÈME</div>
                <a href="/logout.php" class="menu-item">
                    <i class="fas fa-sign-out-alt"></i>
                    <span class="menu-text">Déconnexion</span>
                </a>
            <?php endif; ?>
        </nav>
    </aside>

    <!-- Contenu principal avec topbar -->
    <div class="navbar-main-content">
        <!-- Topbar -->
        <header class="navbar-topbar">
            <div class="topbar-left">
                <button class="sidebar-toggle" id="sidebarToggle">
                    <i class="fas fa-bars"></i>
                </button>
                <ul class="breadcrumb">
                    <?php foreach ($breadcrumb as $index => $item): ?>
                        <li class="breadcrumb-item <?= isset($item['active']) ? 'active' : '' ?>">
                            <?php if (isset($item['active'])): ?>
                                <?= $item['label'] ?>
                            <?php else: ?>
                                <a href="<?= $item['url'] ?>"><?= $item['label'] ?></a>
                            <?php endif; ?>
                        </li>
                        <?php if ($index < count($breadcrumb) - 1): ?>
                            <li class="breadcrumb-divider">
                                <i class="fas fa-chevron-right"></i>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="topbar-right">
                <!-- Notifications -->
                <div class="topbar-item">
                    <a href="/notifications.php" class="topbar-link">
                        <i class="fas fa-bell topbar-icon"></i>
                        <span class="topbar-badge">3</span>
                    </a>
                </div>
                
                <!-- Messages -->
                <div class="topbar-item">
                    <a href="/messages.php" class="topbar-link">
                        <i class="fas fa-envelope topbar-icon"></i>
                        <span class="topbar-badge">5</span>
                    </a>
                </div>
                
                <!-- Profil utilisateur -->
                <div class="topbar-item" style="position: relative;">
                    <div class="user-profile" onclick="toggleUserDropdown()">
                        <img src="https://ui-avatars.com/api/?name=<?= urlencode($user_name) ?>&background=3498db&color=fff" 
                             alt="Avatar" class="user-avatar">
                        <div class="user-info">
                            <span class="user-name"><?= htmlspecialchars($user_name) ?></span>
                            <span class="user-role"><?= ucfirst($user_type) ?></span>
                        </div>
                    </div>
                    
                    <!-- Dropdown profil -->
                    <div class="user-dropdown" id="userDropdown">
                        <a href="/profile.php" class="dropdown-item">
                            <i class="fas fa-user"></i>
                            Mon Profil
                        </a>
                        <a href="/settings.php" class="dropdown-item">
                            <i class="fas fa-cog"></i>
                            Paramètres
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="/logout.php" class="dropdown-item">
                            <i class="fas fa-sign-out-alt"></i>
                            Déconnexion
                        </a>
                    </div>
                </div>
            </div>
        </header>

<script>
// JavaScript pour la navbar
document.addEventListener('DOMContentLoaded', function() {
    
    // Toggle sidebar
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebar = document.getElementById('sidebar');
    
    if (sidebarToggle && sidebar) {
        sidebarToggle.addEventListener('click', function() {
            if (window.innerWidth <= 992) {
                sidebar.classList.toggle('show');
            } else {
                sidebar.classList.toggle('collapsed');
            }
        });
    }
    
    // Toggle submenus
    document.querySelectorAll('.menu-item[data-toggle="collapse"]').forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            const target = this.getAttribute('data-target');
            const submenu = document.querySelector(target);
            
            if (submenu) {
                this.classList.toggle('collapsed');
                submenu.classList.toggle('show');
            }
        });
    });
    
    // Fermer sidebar sur mobile quand on clique en dehors
    document.addEventListener('click', function(e) {
        if (window.innerWidth <= 992) {
            const sidebar = document.getElementById('sidebar');
            const sidebarToggle = document.getElementById('sidebarToggle');
            
            if (sidebar && !sidebar.contains(e.target) && e.target !== sidebarToggle) {
                sidebar.classList.remove('show');
            }
        }
    });
    
    // Auto-ouvrir les submenus actifs
    document.querySelectorAll('.submenu-item.active').forEach(item => {
        const submenu = item.closest('.submenu');
        const menuItem = submenu.previousElementSibling;
        
        if (submenu && menuItem) {
            submenu.classList.add('show');
            menuItem.classList.remove('collapsed');
        }
    });
});

// Toggle user dropdown
function toggleUserDropdown() {
    const dropdown = document.getElementById('userDropdown');
    dropdown.classList.toggle('show');
}

// Fermer dropdown si on clique en dehors
document.addEventListener('click', function(e) {
    const dropdown = document.getElementById('userDropdown');
    const userProfile = document.querySelector('.user-profile');
    
    if (dropdown && !userProfile.contains(e.target)) {
        dropdown.classList.remove('show');
    }
});
</script>