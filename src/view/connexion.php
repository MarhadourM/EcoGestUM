<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?php echo $_ENV['BASE_URL']; ?>src/assets/css/style.css" rel="stylesheet" />
    <title>Connexion - EcoGestUM</title>
</head>
<body>
    <div class="connexion-page" style="background-image: url('<?php echo $_ENV["BASE_URL"]."src/assets/Images/ConnexionImg.png"; ?>');">
        <!-- Flèche retour -->
        <div class="back-arrow" onclick="window.location.href='<?php echo $_ENV['BASE_URL']; ?>'">
            <svg viewBox="0 0 24 24" fill="none" stroke="#1B2963" stroke-width="2">
                <path d="M19 12H5M12 19l-7-7 7-7" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>

        <!-- Container de connexion -->
        <div class="connexion-container">
            <!-- Logo -->
            <div class="connexion-logo">
                <img src="<?php echo $_ENV["BASE_URL"]."src/assets/Images/logo_LEMANS.png"; ?>" alt="Le Mans Université">
            </div>

            <!-- Formulaire -->
            <form class="connexion-form" method="POST" action="traitement_connexion">
                <div class="form-group">
                    <label for="identifiant">Identifiant *</label>
                    <input type="text" id="identifiant" name="identifiant" required placeholder="Votre identifiant">
                </div>

                <div class="form-group">
                    <label for="motdepasse">Mot de passe *</label>
                    <input type="password" id="motdepasse" name="motdepasse" required placeholder="Votre mot de passe">
                </div>

                <div class="remember-me">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">Se souvenir de moi</label>
                </div>

                <button type="submit" class="connexion-btn">Se connecter</button>
               <a href="inscription" class="inscription-link">S'INSCRIRE</a>

                
                <div class="connexion-footer">
                    <a href="mot-de-passe-oublie.php">mot de passe oublié</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
