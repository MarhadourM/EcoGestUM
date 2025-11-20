<?php
require_once __DIR__ . '/../Controller/ProfilController.php';

$user_id = $_SESSION['user']['id_ut'] ?? null;
$user = null;
if ($user_id) {
    $user = get_user_info($user_id);
}
?>
<?php
$error_message = '';
if (isset($_SESSION['connexion_error'])) {
    $error_message = $_SESSION['connexion_error'];
    unset($_SESSION['connexion_error']);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?php echo getenv('BASE_URL'); ?>src/assets/css/style.css" rel="stylesheet" />
    <title>Connexion - EcoGestUM</title>
</head>
<body>
    <div class="connexion-page" style="background-image: url('<?php echo getenv('BASE_URL')."src/assets/Images/ConnexionImg.png"; ?>');">
        <!-- Flèche retour -->
        <div class="back-arrow" onclick="window.location.href='<?php echo getenv('BASE_URL'); ?>accueil'">
            <svg viewBox="0 0 24 24" fill="none" stroke="#1B2963" stroke-width="2">
                <path d="M19 12H5M12 19l-7-7 7-7" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>

    </div>
</body>
</html>
