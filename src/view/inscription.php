<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/SamiHajadi/EcoGestUM/src/assets/css/style.css" rel="stylesheet" />
    <title>Inscription - EcoGestUM</title>
</head>
<body>
    <div class="connexion-page" style="background-image: url('<?php echo getenv('BASE_URL')."src/assets/Images/ConnexionImg.png"; ?>');">
        <!-- Flèche retour -->
        <div class="back-arrow" onclick="window.location.href='<?php echo getenv('BASE_URL'); ?>connexion'">
            <svg viewBox="0 0 24 24" fill="none" stroke="#1B2963" stroke-width="2">
                <path d="M19 12H5M12 19l-7-7 7-7" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>

        <!-- Container d'inscription -->
        <div class="connexion-container">
            <!-- Logo -->
            <div class="connexion-logo">
                <img src="<?php echo getenv('BASE_URL')."src/assets/Images/logo.png"?>" alt="Le Mans Université">
            </div>

            <!-- Formulaire d'inscription -->
            <form class="connexion-form" method="POST" action="traitement_inscription">
                <div class="form-group">
                    <label for="identifiant">Identifiant *</label>
                    <input type="text" id="identifiant" name="identifiant" required placeholder="Votre identifiant">
                </div>

                <div class="form-group">
                    <label for="email">Email *</label>
                    <input type="email" class="form-input" id="email" name="email" required placeholder="Votre email">
                </div>


                <div class="form-group">
                    <label for="nom">Nom *</label>
                    <input type="text" id="nom" name="nom" required placeholder="Votre nom">
                </div>

                <div class="form-group">
                    <label for="prenom">Prénom *</label>
                    <input type="text" id="prenom" name="prenom" required placeholder="Votre prénom">
                </div>

                <div class="form-group">
                    <label for="motdepasse">Mot de passe *</label>
                    <input type="password" id="motdepasse" name="motdepasse" required placeholder="Votre mot de passe">
                </div>

                <div class="form-group">
                    <label for="confirmer_mdp">Confirmer le mot de passe *</label>
                    <input type="password" id="confirmer_mdp" name="confirmer_mdp" required placeholder="Confirmer votre mot de passe">
                </div>

                <button type="submit" class="connexion-btn">Confirmer l'inscription</button>
            </form>

        </div>
    </div>
</body>
</html>
