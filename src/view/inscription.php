<?php
require_once __DIR__ . '/../model/utilisateur_model.php';
session_start();
$errors = [];
if (!empty($_SESSION['inscription_error'])) {
  $errors = $_SESSION['inscription_error'];
  unset($_SESSION['inscription_error']);
}
$universites = get_universites();
$composantes = get_composantes();
$departements = get_departements();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?php echo getenv('BASE_URL')."src/assets/css/style.css"; ?>" rel="stylesheet" />
    <title>Inscription - EcoGestUM</title>
</head>
<body>
    <div class="connexion-page" style="background-image: url('<?php echo $_ENV['BASE_URL']."src/assets/Images/ConnexionImg.png"; ?>');">
        <div class="back-arrow" onclick="window.location.href='<?php echo $_ENV['BASE_URL']; ?>connexion'">
            <svg viewBox="0 0 24 24" fill="none" stroke="#1B2963" stroke-width="2">
                <path d="M19 12H5M12 19l-7-7 7-7" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>
        <div class="connexion-container">
            <div class="connexion-logo">
                <img src="<?php echo $_ENV['BASE_URL']."src/assets/Images/logo_LEMANS.png"; ?>" alt="Le Mans Université">
            </div>
            <form class="connexion-form" method="POST" action="traitement_inscription">
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
                    <label for="iduniv">Université *</label>
                    <select id="iduniv" name="iduniv" required>
                        <option value="">Sélectionner une université</option>
                        <?php foreach($universites as $univ): ?>
                            <option value="<?= htmlspecialchars($univ['id_univ']) ?>">
                                <?= htmlspecialchars($univ['nom_univ']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="idcomp">Composante *</label>
                    <select id="idcomp" name="idcomp" required>
                        <option value="">Sélectionner une composante</option>
                        <?php foreach($composantes as $comp): ?>
                            <option value="<?= htmlspecialchars($comp['id_comp']) ?>">
                                <?= htmlspecialchars($comp['nom_comp']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="iddept">Département *</label>
                    <select id="iddept" name="iddept" required>
                        <option value="">Sélectionner un département</option>
                        <?php foreach($departements as $dep): ?>
                            <option value="<?= htmlspecialchars($dep['id_dept']) ?>">
                                <?= htmlspecialchars($dep['nom_dept']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="motdepasse">Mot de passe *</label>
                    <input type="password" id="motdepasse" name="motdepasse" required placeholder="Votre mot de passe">
                </div>
                <div class="form-group">
                    <label for="confirmer_mdp">Confirmer le mot de passe *</label>
                    <input type="password" id="confirmer_mdp" name="confirmer_mdp" required placeholder="Confirmer votre mot de passe">
                </div>
                <?php if (!empty($errors)): ?>
                    <div class="message-error">
                        <ul>
                            <?php foreach ($errors as $err): ?>
                                <li><?= htmlspecialchars($err) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <button type="submit" class="connexion-btn">Confirmer l'inscription</button>
            </form>
        </div>
    </div>

    <script>
document.querySelector('.connexion-form').addEventListener('submit', function(e) {
    const mdp1 = document.getElementById('motdepasse').value;
    const mdp2 = document.getElementById('confirmer_mdp').value;
    let erreurs = [];

    if (mdp1.length < 8) {
        erreurs.push("Le mot de passe doit contenir au moins 8 caractères");
    }
    if (!/[a-z]/.test(mdp1)) {
        erreurs.push("Le mot de passe doit contenir au moins une minuscule");
    }
    if (!/[0-9]/.test(mdp1)) {
        erreurs.push("Le mot de passe doit contenir au moins un chiffre");
    }
    if (!/[!@#$%^&*(),.?\":{}|<>]/.test(mdp1)) {
        erreurs.push("Le mot de passe doit contenir au moins un caractère spécial (!@#$%^&*(),.?\":{}|<>)");
    }
    if (mdp1 !== mdp2) {
        erreurs.push("Les mots de passe sont différents");
    }

    let errDiv = document.getElementById('mdp-error');
    if (!errDiv) {
        errDiv = document.createElement('div');
        errDiv.id = 'mdp-error';
        errDiv.className = 'message-error';
        // Ajoute le message d'erreur juste avant le bouton
        const submitBtn = document.querySelector('.connexion-btn');
        submitBtn.parentNode.insertBefore(errDiv, submitBtn);
    }

    if (erreurs.length > 0) {
        errDiv.innerHTML = '<ul>' + erreurs.map(e => '<li>'+e+'</li>').join('') + '</ul>';
        e.preventDefault();
    } else {
        errDiv.innerHTML = '';
    }
});
</script>


</body>
</html>
