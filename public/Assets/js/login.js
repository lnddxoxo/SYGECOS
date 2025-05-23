document.addEventListener('DOMContentLoaded', function() {
    // Initialisation des animations
    const authContainer = document.querySelector('.auth-container');
    const authCard = document.querySelector('.auth-card');
    
    setTimeout(() => {
        authContainer.classList.add('visible');
        authCard.classList.add('visible');
    }, 100);
    
    // Gestion de la visibilité du mot de passe
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');
    
    togglePassword.addEventListener('click', function() {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
    });
    
    // Gestion de la soumission du formulaire
    const loginForm = document.getElementById('loginForm');
    const submitBtn = loginForm.querySelector('button[type="submit"]');
    const btnText = submitBtn.querySelector('.btn-text');
    const btnLoading = submitBtn.querySelector('.btn-loading');
    
    loginForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Récupération des valeurs
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;
        
        // Animation de chargement
        submitBtn.disabled = true;
        btnText.classList.add('d-none');
        btnLoading.classList.remove('d-none');
        
        // Simulation de requête AJAX
        setTimeout(() => {
            if(email && password) {
                // Succès
                submitBtn.classList.add('btn-success');
                submitBtn.innerHTML = '<span class="btn-text"><i class="fas fa-check-circle"></i> Connexion réussie</span>';
                
                // Redirection après délai
                setTimeout(() => {
                    window.location.href = 'dashboard.html';
                }, 1000);
            } else {
                // Erreur
                submitBtn.classList.add('btn-danger');
                submitBtn.innerHTML = '<span class="btn-text"><i class="fas fa-exclamation-circle"></i> Champs requis</span>';
                
                // Réinitialisation après délai
                setTimeout(() => {
                    submitBtn.disabled = false;
                    submitBtn.classList.remove('btn-danger');
                    submitBtn.innerHTML = `
                        <span class="btn-text"><i class="fas fa-sign-in-alt"></i> Se connecter</span>
                        <span class="btn-loading d-none">
                            <i class="fas fa-spinner"></i> Connexion...
                        </span>
                    `;
                    btnText.classList.remove('d-none');
                }, 1500);
            }
        }, 1500);
    });
    
    // Animation des champs au focus
    const inputs = document.querySelectorAll('.form-control');
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.classList.add('focused');
            this.previousElementSibling.style.color = 
                getComputedStyle(document.documentElement)
                    .getPropertyValue('--primary-color');
        });
        
        input.addEventListener('blur', function() {
            this.parentElement.classList.remove('focused');
            this.previousElementSibling.style.color = 
                getComputedStyle(document.documentElement)
                    .getPropertyValue('--gray-500');
        });
    });
    
    // Effet de survol sur les boutons sociaux
    const socialBtns = document.querySelectorAll('.auth-social-btn');
    socialBtns.forEach(btn => {
        btn.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-2px)';
            this.style.boxShadow = 'var(--shadow-sm)';
        });
        
        btn.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
            this.style.boxShadow = 'none';
        });
    });
});