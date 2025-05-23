<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SYGECOS - Administration</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Montserrat:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Votre charte graphique complète ici */
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --accent-color: #e74c3c;
            --success-color: #27ae60;
            --warning-color: #f39c12;
            --danger-color: #e74c3c;
            --info-color: #3498db;
            --gray-100: #f8f9fa;
            --gray-200: #e9ecef;
            --gray-300: #dee2e6;
            --gray-400: #ced4da;
            --gray-500: #adb5bd;
            --gray-600: #6c757d;
            --gray-700: #495057;
            --gray-800: #343a40;
            --gray-900: #212529;
            --text-primary: #2c3e50;
            --text-secondary: #6c757d;
            --text-light: #ffffff;
            --text-muted: #adb5bd;
            --bg-primary: #ffffff;
            --bg-secondary: #f8f9fa;
            --bg-dark: #2c3e50;
            --bg-sidebar: #34495e;
            --spacing-xs: 0.25rem;
            --spacing-sm: 0.5rem;
            --spacing-md: 1rem;
            --spacing-lg: 1.5rem;
            --spacing-xl: 2rem;
            --spacing-xxl: 3rem;
            --border-radius: 6px;
            --border-radius-lg: 8px;
            --border-radius-xl: 12px;
            --border-color: #dee2e6;
            --border-width: 1px;
            --shadow-sm: 0 1px 2px rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 20px rgba(0, 0, 0, 0.15);
            --shadow-xl: 0 20px 40px rgba(0, 0, 0, 0.2);
            --font-primary: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            --font-heading: 'Montserrat', 'Inter', sans-serif;
            --font-mono: 'Fira Code', 'Consolas', monospace;
            --text-xs: 0.75rem;
            --text-sm: 0.875rem;
            --text-base: 1rem;
            --text-lg: 1.125rem;
            --text-xl: 1.25rem;
            --text-2xl: 1.5rem;
            --text-3xl: 1.875rem;
            --text-4xl: 2.25rem;
            --transition-fast: 150ms ease-in-out;
            --transition-base: 200ms ease-in-out;
            --transition-slow: 300ms ease-in-out;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            font-size: 16px;
            scroll-behavior: smooth;
        }

        body {
            font-family: var(--font-primary);
            font-size: var(--text-base);
            line-height: 1.6;
            color: var(--text-primary);
            background-color: var(--bg-secondary);
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        /* Layout */
        .app-container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            background-color: var(--bg-sidebar);
            color: var(--text-light);
            transition: all var(--transition-base);
            height: 100vh;
            position: sticky;
            top: 0;
            overflow-y: auto;
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
        }

        .sidebar-brand i {
            font-size: var(--text-2xl);
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
        }

        .menu-item {
            display: flex;
            align-items: center;
            padding: var(--spacing-sm) var(--spacing-lg);
            color: var(--text-light);
            text-decoration: none;
            transition: all var(--transition-base);
            border-left: 3px solid transparent;
        }

        .menu-item:hover {
            background-color: rgba(255, 255, 255, 0.05);
            border-left-color: var(--secondary-color);
        }

        .menu-item.active {
            background-color: rgba(255, 255, 255, 0.1);
            border-left-color: var(--secondary-color);
        }

        .menu-item i {
            margin-right: var(--spacing-sm);
            width: 24px;
            text-align: center;
        }

        .menu-item .menu-arrow {
            margin-left: auto;
            transition: transform var(--transition-base);
        }

        .menu-item.collapsed .menu-arrow {
            transform: rotate(-90deg);
        }

        .submenu {
            padding-left: var(--spacing-xl);
            background-color: rgba(0, 0, 0, 0.1);
            overflow: hidden;
            max-height: 0;
            transition: max-height var(--transition-slow);
        }

        .submenu.show {
            max-height: 500px;
        }

        .submenu-item {
            padding: var(--spacing-xs) var(--spacing-lg);
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
        }

        .submenu-item.active {
            opacity: 1;
            color: var(--secondary-color);
            font-weight: 500;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            overflow-x: hidden;
        }

        /* Topbar */
        .topbar {
            background-color: var(--bg-primary);
            padding: var(--spacing-md) var(--spacing-lg);
            box-shadow: var(--shadow-sm);
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: var(--z-fixed);
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
        }

        .breadcrumb {
            display: flex;
            align-items: center;
            list-style: none;
        }

        .breadcrumb-item {
            font-size: var(--text-sm);
        }

        .breadcrumb-item a {
            color: var(--text-secondary);
        }

        .breadcrumb-item.active {
            color: var(--text-primary);
            font-weight: 500;
        }

        .breadcrumb-divider {
            margin: 0 var(--spacing-sm);
            color: var(--text-muted);
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: var(--spacing-md);
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
        }

        .topbar-link:hover {
            color: var(--primary-color);
        }

        .topbar-icon {
            font-size: var(--text-xl);
        }

        .topbar-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: var(--danger-color);
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            font-size: var(--text-xs);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: var(--spacing-sm);
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            object-fit: cover;
        }

        .user-name {
            font-weight: 500;
            font-size: var(--text-sm);
        }

        /* Page Content */
        .page-content {
            padding: var(--spacing-lg);
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: var(--spacing-xl);
        }

        .page-title {
            font-family: var(--font-heading);
            font-weight: 600;
            font-size: var(--text-3xl);
            color: var(--primary-color);
        }

        .page-actions {
            display: flex;
            gap: var(--spacing-md);
        }

        /* Form Styles */
        .form-row {
            display: flex;
            flex-wrap: wrap;
            gap: var(--spacing-md);
            margin-bottom: var(--spacing-lg);
            background-color: var(--bg-primary);
            padding: var(--spacing-lg);
            border-radius: var(--border-radius-lg);
            box-shadow: var(--shadow-sm);
        }

        .form-group {
            flex: 1;
            min-width: 200px;
        }

        .form-label {
            display: block;
            margin-bottom: var(--spacing-sm);
            color: var(--text-primary);
            font-weight: 500;
        }

        .form-control {
            width: 100%;
            padding: var(--spacing-sm) var(--spacing-md);
            font-size: var(--text-base);
            font-family: var(--font-primary);
            color: var(--text-primary);
            background-color: var(--bg-primary);
            border: var(--border-width) solid var(--border-color);
            border-radius: var(--border-radius);
            transition: all var(--transition-base);
        }

        .form-control:focus {
            outline: none;
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
        }

        /* Table Styles */
        .table-container {
            background-color: var(--bg-primary);
            border-radius: var(--border-radius-lg);
            box-shadow: var(--shadow-sm);
            overflow: hidden;
        }

        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: var(--spacing-md) var(--spacing-lg);
            background-color: var(--bg-secondary);
            border-bottom: var(--border-width) solid var(--border-color);
        }

        .table-title {
            font-weight: 600;
            color: var(--text-primary);
        }

        .table-actions {
            display: flex;
            gap: var(--spacing-sm);
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            padding: var(--spacing-md);
            text-align: left;
            border-bottom: var(--border-width) solid var(--border-color);
        }

        .table th {
            background-color: var(--bg-secondary);
            font-weight: 600;
            color: var(--text-primary);
        }

        .table tbody tr:hover {
            background-color: var(--gray-100);
        }

        .table-checkbox {
            width: 20px;
            height: 20px;
        }

        .table-actions-cell {
            display: flex;
            gap: var(--spacing-xs);
        }

        .action-btn {
            padding: var(--spacing-xs) var(--spacing-sm);
            border-radius: var(--border-radius);
            border: none;
            background: none;
            cursor: pointer;
            transition: all var(--transition-base);
        }

        .action-btn.edit {
            color: var(--secondary-color);
        }

        .action-btn.edit:hover {
            background-color: rgba(52, 152, 219, 0.1);
        }

        .action-btn.delete {
            color: var(--danger-color);
        }

        .action-btn.delete:hover {
            background-color: rgba(231, 76, 60, 0.1);
        }

        /* Pagination */
        .pagination {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: var(--spacing-md) var(--spacing-lg);
            background-color: var(--bg-secondary);
            border-top: var(--border-width) solid var(--border-color);
        }

        .pagination-info {
            font-size: var(--text-sm);
            color: var(--text-secondary);
        }

        .pagination-controls {
            display: flex;
            gap: var(--spacing-xs);
        }

        .page-item {
            list-style: none;
        }

        .page-link {
            display: block;
            padding: var(--spacing-xs) var(--spacing-sm);
            border: var(--border-width) solid var(--border-color);
            border-radius: var(--border-radius);
            text-decoration: none;
            color: var(--text-primary);
            transition: all var(--transition-base);
        }

        .page-link:hover {
            background-color: var(--gray-200);
        }

        .page-link.active {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            color: white;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .sidebar {
                width: 80px;
                overflow: hidden;
            }
            .sidebar-header, .menu-title, .menu-item span, .menu-arrow {
                display: none;
            }
            .menu-item {
                justify-content: center;
                padding: var(--spacing-md) 0;
            }
            .menu-item i {
                margin-right: 0;
                font-size: var(--text-lg);
            }
        }

        @media (max-width: 768px) {
            .form-row {
                flex-direction: column;
                gap: var(--spacing-md);
            }
            .page-header {
                flex-direction: column;
                align-items: flex-start;
                gap: var(--spacing-md);
            }
            .page-actions {
                width: 100%;
                justify-content: flex-end;
            }
        }
    </style>
</head>
<body>
    <div class="app-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <a href="#" class="sidebar-brand">
                    <i class="fas fa-graduation-cap"></i>
                    <span>SYGECOS</span>
                </a>
            </div>
            
            <nav class="sidebar-menu">
                <div class="menu-title">ADMINISTRATION</div>
                
                <!-- Paramètres Généraux -->
                <div class="menu-item collapsed" data-toggle="collapse" data-target="#parametres">
                    <i class="fas fa-cog"></i>
                    <span>Paramètres Généraux</span>
                    <i class="fas fa-chevron-down menu-arrow"></i>
                </div>
                <div class="submenu" id="parametres">
                    <a href="#" class="submenu-item active">Groupes Utilisateurs</a>
                    <a href="#" class="submenu-item">Types Utilisateurs</a>
                    <a href="#" class="submenu-item">Utilisateurs</a>
                    <a href="#" class="submenu-item">Traitements</a>
                    <a href="#" class="submenu-item">Niveaux d'Accès</a>
                </div>
                
                <!-- UE/ECUE -->
                <div class="menu-item collapsed" data-toggle="collapse" data-target="#ue-ecue">
                    <i class="fas fa-book"></i>
                    <span>UE/ECUE</span>
                    <i class="fas fa-chevron-down menu-arrow"></i>
                </div>
                <div class="submenu" id="ue-ecue">
                    <a href="#" class="submenu-item">Unités d'Enseignement</a>
                    <a href="#" class="submenu-item">Éléments Constitutifs</a>
                </div>
                
                <!-- Gestion Personnel -->
                <div class="menu-item collapsed" data-toggle="collapse" data-target="#personnel">
                    <i class="fas fa-users"></i>
                    <span>Gestion Personnel</span>
                    <i class="fas fa-chevron-down menu-arrow"></i>
                </div>
                <div class="submenu" id="personnel">
                    <a href="#" class="submenu-item">Personnel Administratif</a>
                    <a href="#" class="submenu-item">Fonctions</a>
                </div>
                
                <!-- Gestion Professeurs -->
                <div class="menu-item collapsed" data-toggle="collapse" data-target="#professeurs">
                    <i class="fas fa-chalkboard-teacher"></i>
                    <span>Gestion Professeurs</span>
                    <i class="fas fa-chevron-down menu-arrow"></i>
                </div>
                <div class="submenu" id="professeurs">
                    <a href="#" class="submenu-item">Liste des Professeurs</a>
                    <a href="#" class="submenu-item">Grades</a>
                    <a href="#" class="submenu-item">Spécialités</a>
                </div>
                
                <!-- Piste Audit -->
                <a href="#" class="menu-item">
                    <i class="fas fa-clipboard-list"></i>
                    <span>Piste d'Audit</span>
                </a>
                
                <!-- Logs & Stats -->
                <a href="#" class="menu-item">
                    <i class="fas fa-chart-bar"></i>
                    <span>Logs & Statistiques</span>
                </a>
                
                <!-- Sécurité -->
                <a href="#" class="menu-item">
                    <i class="fas fa-shield-alt"></i>
                    <span>Sécurité</span>
                </a>
            </nav>
        </aside>

        
        <main class="main-content">
            <!-- Topbar -->
            <header class="topbar">
                <div class="topbar-left">
                    <button class="sidebar-toggle">
                        <i class="fas fa-bars"></i>
                    </button>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="#">Administration</a>
                        </li>
                        <li class="breadcrumb-divider">
                            <i class="fas fa-chevron-right"></i>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#">Paramètres Généraux</a>
                        </li>
                        <li class="breadcrumb-divider">
                            <i class="fas fa-chevron-right"></i>
                        </li>
                        <li class="breadcrumb-item active">
                            Groupes Utilisateurs
                        </li>
                    </ul>
                </div>
                <div class="topbar-right">
                    <div class="topbar-item">
                        <a href="#" class="topbar-link">
                            <i class="fas fa-bell topbar-icon"></i>
                            <span class="topbar-badge">3</span>
                        </a>
                    </div>
                    <div class="topbar-item">
                        <a href="#" class="topbar-link">
                            <i class="fas fa-envelope topbar-icon"></i>
                            <span class="topbar-badge">5</span>
                        </a>
                    </div>
                    <div class="topbar-item">
                        <div class="user-profile">
                            <img src="https://via.placeholder.com/150" alt="User" class="user-avatar">
                            <span class="user-name">Admin</span>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <div class="page-content">
                <div class="page-header">
                    <h1 class="page-title">Mise à jour des UE</h1>
                    <div class="page-actions">
                        <button class="btn btn-primary">
                            <i class="fas fa-file-export"></i> Exporter
                        </button>
                        <button class="btn btn-danger">
                            <i class="fas fa-trash-alt"></i> Supprimer
                        </button>
                    </div>
                </div>

                <!-- Formulaire d'ajout -->
                <div class="form-row">
                    <div class="form-group">
                        <label for="groupName" class="form-label">Année academique</label>
                        <select id="groupLevel" class="form-control">
                            <option value="">Sélectionnez une année</option>
                            <option value="1">2020/2021</option>
                            <option value="2">2023§2024 </option>
                            <option value="3">2024/2025</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="groupLevel" class="form-label">Niveau</label>
                        <select id="groupLevel" class="form-control">
                            <option value="">Sélectionnez un niveau</option>
                            <option value="1">M1</option>
                            <option value="2">M2</option>
                            
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="groupLevel" class="form-label">Semestre</label>
                        <select id="groupLevel" class="form-control">
                            <option value="">Sélectionnez un semestre</option>
                            <option value="1">Semestre 7</option>
                            <option value="2">Semestre 8</option>
                            <option value="3">Semestre 9</option>
                        </select>
                    </div>
                    <div class="form-group" style="align-self: flex-end;">
                        <button class="btn btn-success">
                            <i class="fas fa-plus"></i> Ajouter
                        </button>
                    </div>
                </div>

                <!-- Tableau des groupes -->
                <div class="table-container">
                    <div class="table-header">
                        <h3 class="table-title">Liste des UE</h3>
                        <div class="table-actions">
                            <input type="text" class="form-control" placeholder="Rechercher..." style="width: 200px;">
                        </div>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th width="40">
                                    <input type="checkbox" class="table-checkbox">
                                </th>
                                <th>Code UE</th>
                                <th>Designation</th>
                                <th>Nombre ECUE</th>
                                <th>Credit</th>
                                <th>Date de Création</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input type="checkbox" class="table-checkbox"></td>
                                <td></td>
                                <td>Modelisation SI</td>
                                <td><span class="badge bg-danger">Niveau 3</span></td>
                                <td>5</td>
                                <td>15/01/2023</td>
                                <td class="table-actions-cell">
                                    <button class="action-btn edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="action-btn delete">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" class="table-checkbox"></td>
                                <td>Enseignants</td>
                                <td>PROF</td>
                                <td><span class="badge bg-warning">Niveau 2</span></td>
                                <td>42</td>
                                <td>15/01/2023</td>
                                <td class="table-actions-cell">
                                    <button class="action-btn edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="action-btn delete">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" class="table-checkbox"></td>
                                <td>Étudiants</td>
                                <td>ETUD</td>
                                <td><span class="badge bg-primary">Niveau 1</span></td>
                                <td>1250</td>
                                <td>15/01/2023</td>
                                <td class="table-actions-cell">
                                    <button class="action-btn edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="action-btn delete">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" class="table-checkbox"></td>
                                <td>Personnel Administratif</td>
                                <td>PERSO</td>
                                <td><span class="badge bg-secondary">Niveau 2</span></td>
                                <td>28</td>
                                <td>20/02/2023</td>
                                <td class="table-actions-cell">
                                    <button class="action-btn edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="action-btn delete">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="pagination">
                        <div class="pagination-info">
                            Affichage de 1 à 4 sur 4 entrées
                        </div>
                        <ul class="pagination-controls">
                            <li class="page-item">
                                <a href="#" class="page-link disabled">
                                    <i class="fas fa-chevron-left"></i>
                                </a>
                            </li>
                            <li class="page-item">
                                <a href="#" class="page-link active">1</a>
                            </li>
                            <li class="page-item">
                                <a href="#" class="page-link disabled">
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        // Toggle sidebar submenus
        document.querySelectorAll('.menu-item[data-toggle="collapse"]').forEach(item => {
            item.addEventListener('click', function() {
                const target = this.getAttribute('data-target');
                const submenu = document.querySelector(target);
                
                this.classList.toggle('collapsed');
                submenu.classList.toggle('show');
            });
        });

        // Toggle sidebar on mobile
        document.querySelector('.sidebar-toggle').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('collapsed');
        });

        // Select all checkboxes
        document.querySelector('thead .table-checkbox').addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('tbody .table-checkbox');
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
        });
    </script>
</body>
</html>