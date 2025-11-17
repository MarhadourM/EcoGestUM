<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?php echo $_ENV["BASE_URL"]."src/assets/css/style.css"; ?>" rel="stylesheet" />
    <title>EcoGestUM - Header</title>
</head>
<body>
    <header class="header">
        <!-- Top bar -->
        <div class="header__top">
            <div class="header__logo">
                <div class="header__logo-img">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M12 2L3 7V12C3 16.55 6.84 20.74 12 22C17.16 20.74 21 16.55 21 12V7L12 2Z" fill="#2b2e5e" stroke="#2b2e5e" stroke-width="2"/>
                    </svg>
                </div>
                <span class="header__logo-text">Le Mans Université</span>
                <span class="header__separator">|</span>
                <span class="header__site-name">EcoGestUM</span>
            </div>
            <button class="header__connect-btn" src=window.location(connexion.php)>SE CONNECTER</button>
        </div>
        <!-- Navigation principale -->
        <nav class="header__nav">
            <div class="nav">
                <div class="nav__item active">
                    <a href="#statistiques" class="nav__link">
                        <svg class="nav__icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M3 3v18h18" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M18 17V9M13 17v-5M8 17v-3" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span class="nav__text">Statistiques</span>
                    </a>
                </div>

                <div class="nav__item">
                    <a href="#notre-politique" class="nav__link">
                        <svg class="nav__icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z" stroke-linecap="round" stroke-linejoin="round"/>
                            <polyline points="17 21 17 13 7 13 7 21" stroke-linecap="round" stroke-linejoin="round"/>
                            <polyline points="7 3 7 8 15 8" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span class="nav__text">Notre politique</span>
                    </a>
                </div>

                <div class="nav__item">
                    <a href="#espace-reprise" class="nav__link">
                        <svg class="nav__icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M12 6v6l4 2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span class="nav__text">Espace Reprise</span>
                    </a>
                </div>

                <div class="nav__item">
                    <a href="#evenements" class="nav__link">
                        <svg class="nav__icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <line x1="16" y1="2" x2="16" y2="6" stroke-linecap="round" stroke-linejoin="round"/>
                            <line x1="8" y1="2" x2="8" y2="6" stroke-linecap="round" stroke-linejoin="round"/>
                            <line x1="3" y1="10" x2="21" y2="10" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span class="nav__text">Évènements</span>
                    </a>
                </div>

                <div class="nav__item">
                    <a href="#messagerie" class="nav__link">
                        <svg class="nav__icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span class="nav__text">Messagerie</span>
                    </a>
                </div>
            </div>
        </nav>
    </header>

    <script>
        document.querySelectorAll('.nav__item').forEach(item => {
            item.addEventListener('click', function(e) {
                document.querySelectorAll('.nav__item').forEach(navItem => {
                    navItem.classList.remove('active');
                });
                this.classList.add('active');
            });
        });

        // Gestion du bouton de connexion
        document.querySelector('.header__connect-btn').addEventListener('click', function() {
            alert('Fonctionnalité de connexion à implémenter');
        });
    </script>
