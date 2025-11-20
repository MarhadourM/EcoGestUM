<?php
require_once __DIR__ . '/../model/modelBDD.php'; // Si ce n'est pas déjà inclus par un parent
$error_message = $_SESSION['formDon_error'] ?? '';
unset($_SESSION['formDon_error']);

$etats_objet = get_etats_objet();       // SELECT id_etat_obj, nom_etat_obj FROM ETAT_OBJET
$categories = get_categories_objet();   // SELECT id_cat_obj, nom_cat_obj FROM CATEGORIE_OBJET
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?php echo getenv('BASE_URL'); ?>src/assets/css/style.css" rel="stylesheet" />
    <title>Donner un objet - EcoGestUM</title>
</head>
<body>
    <div class="connexion-page" style="background-image: url('<?php echo getenv('BASE_URL')."src/assets/Images/ConnexionImg.png"; ?>');">
        <div class="back-arrow" onclick="window.location.href='<?php echo getenv('BASE_URL'); ?>espace-reprise'">
            <svg viewBox="0 0 24 24" fill="none" stroke="#1B2963" stroke-width="2">
                <path d="M19 12H5M12 19l-7-7 7-7" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>
        <div class="connexion-container" style="max-width:900px;">
            <div class="connexion-logo">
                <img src="<?php echo getenv('BASE_URL')."src/assets/Images/logo_LEMANS.png"; ?>" alt="Le Mans Université">
            </div>
            <h2 class="connexion-title">FORMULAIRE DE DONATION</h2>
            <form class="connexion-form" method="POST" action="traitement_formDon" enctype="multipart/form-data">
                <div class="form-group" style="margin-bottom:24px;">
                    <label>Photos de l’objet :</label>
                    <input type="file" name="photos[]" accept="image/jpeg, image/png" multiple style="padding:10px;" required>
                    <small>Formats supportés : JPEG, PNG</small>
                </div>
                <div class="form-row" style="display:flex; gap:20px;">
                    <div class="form-group" style="flex:1;">
                        <label for="categorie">Catégorie de l’objet</label>
                        <select name="categorie" id="categorie" required>
                            <option value="">Choisir une catégorie</option>
                            <?php foreach ($categories as $cat): ?>
                                <option value="<?php echo $cat['id_cat_obj']; ?>">
                                    <?php echo htmlspecialchars($cat['nom_cat_obj']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group" style="flex:1;">
                        <label for="nom">Nom de l’objet</label>
                        <input type="text" name="nom" id="nom" placeholder="Nom de l’objet" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" rows="4" placeholder="Description détaillée de l’objet" required></textarea>
                </div>
                <div class="form-row" style="display:flex; gap:20px;">
                    <div class="form-group" style="flex:1;">
                        <label for="localisation">Localisation</label>
                        <input type="text" name="localisation" id="localisation" placeholder="Lieu de dépôt (bâtiment, étage, etc.)" required>
                    </div>
                    <div class="form-group" style="flex:1;">
                        <label for="etat">État</label>
                        <select name="etat" id="etat" required>
                            <option value="">Choisir l'état</option>
                            <?php foreach($etats_objet as $etat): ?>
                                <option value="<?php echo $etat['id_etat_obj']; ?>">
                                    <?php echo htmlspecialchars($etat['nom_etat_obj']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <?php if (!empty($error_message)): ?>
                    <div class="form-error">
                        <?php echo htmlspecialchars($error_message); ?>
                    </div>
                <?php endif; ?>
                <?php if (!empty($_GET['success'])): ?>
                    <div class="form-success">
                        Votre don a été enregistré avec succès !
                    </div>
                <?php endif; ?>
                <button type="submit" class="connexion-btn" style="margin-top:26px;background-color:#cf5222;">CONFIRMER LE FORMULAIRE</button>
            </form>
        </div>
    </div>
</body>
</html>
