<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - SYGECOS</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        /* Intégration de la charte graphique */
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

        body {
            font-family: var(--font-primary);
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--bg-sidebar) 50%, var(--secondary-color) 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: var(--spacing-md);
            position: relative;
        }

        /* Formes géométriques animées */
        .geometric-shapes {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 1;
        }

        .shape {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            animation: float 6s ease-in-out infinite;
        }

        .shape:nth-child(1) {
            width: 100px;
            height: 100px;
            top: 10%;
            left: 10%;
            animation-delay: 0s;
            background: rgba(52, 152, 219, 0.2);
        }

        .shape:nth-child(2) {
            width: 150px;
            height: 150px;
            top: 70%;
            right: 10%;
            animation-delay: 2s;
            background: rgba(39, 174, 96, 0.15);
        }

        .shape:nth-child(3) {
            width: 80px;
            height: 80px;
            bottom: 20%;
            left: 20%;
            animation-delay: 4s;
            background: rgba(231, 76, 60, 0.2);
        }

        .shape:nth-child(4) {
            width: 120px;
            height: 120px;
            top: 30%;
            right: 30%;
            animation-delay: 1s;
            background: rgba(243, 156, 18, 0.18);
        }

        .shape:nth-child(5) {
            width: 200px;
            height: 200px;
            top: 50%;
            left: 5%;
            animation-delay: 3s;
            background: rgba(155, 89, 182, 0.12);
        }

        .shape:nth-child(6) {
            width: 90px;
            height: 90px;
            bottom: 10%;
            right: 40%;
            animation-delay: 5s;
            background: rgba(26, 188, 156, 0.15);
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0px) rotate(0deg);
                opacity: 0.7;
            }
            50% {
                transform: translateY(-20px) rotate(180deg);
                opacity: 1;
            }
        }

        /* Container principal */
        .login-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: var(--border-radius-xl);
            box-shadow: var(--shadow-xl);
            display: grid;
            grid-template-columns: 1fr 1fr;
            width: 100%;
            max-width: 800px;
            min-width: 600px;
            min-height: 500px;
            overflow: hidden;
            position: relative;
            z-index: 10;
            animation: slideInFromBottom 1s ease-out;
            margin: auto;
        }

        /* Section Logo */
        .logo-section {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--bg-sidebar) 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: var(--text-light);
            padding: var(--spacing-xxl);
            position: relative;
            overflow: hidden;
        }

        .logo-section::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: repeating-linear-gradient(
                45deg,
                transparent,
                transparent 10px,
                rgba(255, 255, 255, 0.03) 10px,
                rgba(255, 255, 255, 0.03) 20px
            );
            animation: slidePattern 20s linear infinite;
        }

        @keyframes slidePattern {
            0% { transform: translateX(-100px) translateY(-100px); }
            100% { transform: translateX(100px) translateY(100px); }
        }

        .logo {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 4px solid var(--secondary-color);
            padding: var(--spacing-sm);
            margin-bottom: var(--spacing-lg);
            position: relative;
            z-index: 2;
            animation: pulse 2s ease-in-out infinite;
            background: var(--text-light);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            box-shadow: var(--shadow-lg);
        }

        .logo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }

        .logo i {
            font-size: var(--text-4xl);
            color: var(--primary-color);
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        .logo-title {
            font-family: var(--font-heading);
            font-size: var(--text-2xl);
            font-weight: 700;
            margin-bottom: var(--spacing-sm);
            position: relative;
            z-index: 2;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }

        .logo-subtitle {
            font-size: var(--text-base);
            opacity: 0.9;
            position: relative;
            z-index: 2;
            line-height: 1.6;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.2);
        }

        /* Section Formulaire */
        .form-section {
            padding: var(--spacing-xl);
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .form-header {
            text-align: center;
            margin-bottom: var(--spacing-lg);
        }

        .form-header h2 {
            font-family: var(--font-heading);
            font-size: var(--text-2xl);
            color: var(--primary-color);
            margin-bottom: var(--spacing-sm);
        }

        .form-header p {
            color: var(--text-secondary);
            font-size: var(--text-base);
        }

        .login-form {
            width: 100%;
        }

        .form-group {
            margin-bottom: var(--spacing-lg);
            position: relative;
        }

        .form-label {
            display: block;
            margin-bottom: var(--spacing-sm);
            color: var(--text-primary);
            font-weight: 600;
            font-size: var(--text-base);
        }

        .form-control {
            width: 100%;
            padding: var(--spacing-md);
            font-size: var(--text-base);
            border: 2px solid var(--border-color);
            border-radius: var(--border-radius-lg);
            transition: all var(--transition-base);
            background-color: var(--bg-primary);
            color: var(--text-primary);
            min-height: 45px;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 4px rgba(52, 152, 219, 0.15);
            transform: translateY(-2px);
        }

        .form-control::placeholder {
            color: var(--text-muted);
            font-size: var(--text-base);
        }

        /* Style spécial pour le select - SUPPRIMÉ */

        .input-icon {
            position: absolute;
            right: var(--spacing-md);
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            cursor: pointer;
            transition: color var(--transition-base);
            font-size: var(--text-base);
        }

        .input-icon:hover {
            color: var(--secondary-color);
        }

        .password-toggle {
            top: calc(50% + 10px);
        }

        .btn {
            width: 100%;
            padding: var(--spacing-md);
            font-size: var(--text-base);
            font-weight: 600;
            border: none;
            border-radius: var(--border-radius-lg);
            cursor: pointer;
            transition: all var(--transition-base);
            text-transform: uppercase;
            letter-spacing: 1px;
            position: relative;
            overflow: hidden;
            min-height: 45px;
            margin-top: var(--spacing-sm);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--secondary-color) 0%, var(--primary-color) 100%);
            color: var(--text-light);
            box-shadow: var(--shadow-md);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-lg);
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn-primary:hover::before {
            left: 100%;
        }

        .forgot-password {
            text-align: center;
            margin-top: var(--spacing-lg);
        }

        .forgot-password a {
            color: var(--secondary-color);
            text-decoration: none;
            font-weight: 500;
            font-size: var(--text-sm);
            transition: color var(--transition-base);
        }

        .forgot-password a:hover {
            color: var(--primary-color);
            text-decoration: underline;
        }

        .alert {
            padding: var(--spacing-md);
            border-radius: var(--border-radius);
            margin-bottom: var(--spacing-lg);
            font-weight: 500;
            animation: slideInFromTop 0.5s ease-out;
            font-size: var(--text-sm);
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        /* Back to home */
        .back-home {
            position: fixed;
            top: var(--spacing-lg);
            left: var(--spacing-lg);
            z-index: 20;
        }

        .back-home a {
            display: flex;
            align-items: center;
            color: var(--text-light);
            text-decoration: none;
            font-weight: 500;
            transition: all var(--transition-base);
            background: rgba(255, 255, 255, 0.1);
            padding: var(--spacing-md) var(--spacing-lg);
            border-radius: var(--border-radius);
            backdrop-filter: blur(10px);
            font-size: var(--text-base);
        }

        .back-home a:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateX(-5px);
        }

        .back-home i {
            margin-right: var(--spacing-sm);
        }

        /* Animations */
        @keyframes slideInFromBottom {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInFromTop {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive Design */
        @media (max-width: 1200px) {
            .login-container {
                max-width: 750px;
                min-width: 550px;
            }
        }

        @media (max-width: 992px) {
            .login-container {
                max-width: 650px;
                min-width: 500px;
                min-height: 450px;
            }
            
            .logo {
                width: 100px;
                height: 100px;
            }
        }

        @media (max-width: 768px) {
            body {
                padding: var(--spacing-sm);
            }

            .login-container {
                grid-template-columns: 1fr;
                width: 100%;
                max-width: 400px;
                min-width: 320px;
                min-height: auto;
            }

            .logo-section {
                padding: var(--spacing-lg);
                order: 1;
            }

            .form-section {
                padding: var(--spacing-lg);
                order: 2;
            }

            .logo {
                width: 80px;
                height: 80px;
                margin-bottom: var(--spacing-md);
            }

            .logo-title {
                font-size: var(--text-xl);
            }

            .logo-subtitle {
                font-size: var(--text-sm);
            }

            .form-header h2 {
                font-size: var(--text-xl);
            }

            .form-group {
                margin-bottom: var(--spacing-md);
            }

            .form-label {
                font-size: var(--text-sm);
                margin-bottom: var(--spacing-xs);
            }

            .form-control {
                padding: var(--spacing-sm) var(--spacing-md);
                font-size: var(--text-sm);
                min-height: 40px;
            }

            .btn {
                padding: var(--spacing-sm) var(--spacing-md);
                font-size: var(--text-sm);
                min-height: 40px;
            }

            .back-home {
                position: relative;
                top: 0;
                left: 0;
                margin-bottom: var(--spacing-md);
                text-align: center;
            }

            .back-home a {
                display: inline-flex;
                padding: var(--spacing-xs) var(--spacing-sm);
                font-size: var(--text-xs);
            }
        }

        @media (max-width: 480px) {
            body {
                padding: var(--spacing-xs);
            }

            .login-container {
                border-radius: var(--border-radius-lg);
                max-width: 100%;
                min-width: 300px;
            }

            .logo-section,
            .form-section {
                padding: var(--spacing-md);
            }

            .logo {
                width: 70px;
                height: 70px;
            }

            .logo-title {
                font-size: var(--text-lg);
            }

            .form-header h2 {
                font-size: var(--text-lg);
            }
        }

        /* Loading animation */
        .loading {
            display: none;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1000;
        }

        .spinner {
            width: 40px;
            height: 40px;
            border: 4px solid rgba(52, 152, 219, 0.3);
            border-top: 4px solid var(--secondary-color);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Amélioration de l'accessibilité */
        .form-control:focus,
        .btn:focus {
            outline: 2px solid var(--secondary-color);
            outline-offset: 2px;
        }

        /* Style pour les navigateurs webkit */
        .form-control::-webkit-input-placeholder {
            color: var(--text-muted);
        }
        
        .form-control:-moz-placeholder {
            color: var(--text-muted);
        }
        
        .form-control::-moz-placeholder {
            color: var(--text-muted);
        }
        
        .form-control:-ms-input-placeholder {
            color: var(--text-muted);
        }
    </style>
</head>
<body>
    <!-- Formes géométriques animées -->
    <div class="geometric-shapes">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

    <!-- Retour à l'accueil -->
    <div class="back-home">
        <a href="index.php">
            <i class="fas fa-arrow-left"></i>
            Retour à l'accueil
        </a>
    </div>

    <!-- Container principal -->
    <div class="login-container">
        <!-- Section Logo -->
        <div class="logo-section">
            <div class="logo">
                <img src="../../public/Assets/WhatsApp Image 2025-05-15 à 00.55.04_1c2d5362.jpg" alt="Logo SYGECOS">
            </div>
            <h1 class="logo-title">SYGECOS</h1>
            <p class="logo-subtitle">
                Système de Gestion des Écoles Supérieures
                <br>
                Plateforme intégrée pour la gestion des soutenances académiques
            </p>
        </div>

        <!-- Section Formulaire -->
        <div class="form-section">
            <div class="form-header">
                <h2>Connexion</h2>
                <p>Accédez à votre espace personnel</p>
            </div>

            <!-- Affichage des messages d'erreur/succès -->
            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-triangle"></i>
                    <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
                </div>
            <?php endif; ?>

            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
                </div>
            <?php endif; ?>

            <form class="login-form" method="POST" action="index.php" id="loginForm">
                <div class="form-group">
                    <label for="login" class="form-label">
                        <i class="fas fa-user"></i>
                        Nom d'utilisateur ou Email
                    </label>
                    <input 
                        type="text" 
                        id="login" 
                        name="login" 
                        class="form-control" 
                        placeholder="Entrez votre nom d'utilisateur ou email"
                        required
                        autocomplete="username"
                    >
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">
                        <i class="fas fa-lock"></i>
                        Mot de passe
                    </label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        class="form-control" 
                        placeholder="Entrez votre mot de passe"
                        required
                        autocomplete="current-password"
                    >
                    <i class="fas fa-eye input-icon password-toggle" onclick="togglePassword()"></i>
                </div>

                <button type="submit" class="btn btn-primary">
                    Se connecter
                    <i class="fas fa-sign-in-alt" style="margin-left: 0.5rem;"></i>
                </button>

                <div class="forgot-password">
                    <a href="auth/forgot_password.php">
                        <i class="fas fa-question-circle"></i>
                        Mot de passe oublié ?
                    </a>
                </div>
            </form>

            <!-- Loading indicator -->
            <div class="loading" id="loading">
                <div class="spinner"></div>
            </div>
        </div>
    </div>

    <script>
        // Toggle password visibility
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.querySelector('.password-toggle');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }

        // Form submission with loading
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            const loadingIndicator = document.getElementById('loading');
            const submitButton = document.querySelector('.btn-primary');
            
            // Show loading
            loadingIndicator.style.display = 'block';
            submitButton.disabled = true;
            submitButton.innerHTML = 'Connexion en cours...';
        });

        // Auto-hide alerts after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    alert.style.animation = 'slideInFromTop 0.5s ease-out reverse';
                    setTimeout(() => {
                        alert.style.display = 'none';
                    }, 500);
                }, 5000);
            });
        });

        // Prevent form resubmission on page refresh
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }

        // Amélioration de l'accessibilité
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                const alerts = document.querySelectorAll('.alert');
                alerts.forEach(alert => {
                    alert.style.display = 'none';
                });
            }
        });
    </script>
</body>
</html>