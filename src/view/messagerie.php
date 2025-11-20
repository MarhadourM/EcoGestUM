<?php
require_once __DIR__ . '/../controller/messagerieController.php';

$user_id = $_SESSION['user']['id_ut'] ?? null;
if (!$user_id) {
    header('Location: ../connexion.php');
    exit;
}

$conversations = getUserConversations($user_id);
$selectedConv = $_GET['conv'] ?? ($conversations[0]['idconv'] ?? null);
$messages = $selectedConv ? getConversationMessages($selectedConv) : [];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?= getenv('BASE_URL'); ?>src/assets/css/style.css" rel="stylesheet">
    <title>Messagerie - EcoGestUM</title>
</head>
<body>
<div class="profil-page" style="background-image:url('<?= getenv('BASE_URL'); ?>src/assets/Images/ConnexionImg.png');">
<div class="messagerie-page">
    <div class="back-arrow" onclick="window.location.href='<?= getenv('BASE_URL'); ?>accueil'">
        <svg viewBox="0 0 24 24" fill="none" stroke="#1B2963" stroke-width="2">
            <path d="M19 12H5M12 19l-7-7 7-7" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </div>
    <div class="messagerie-container">
        <div class="messagerie-list">
            <?php foreach ($conversations as $conv): ?>
            <div class="messagerie-list-item <?= ($conv['id_conv'] == $selectedConv ? 'active' : '') ?>"
                onclick="window.location.href='?conv=<?= $conv['id_conv']; ?>'">
                <?= htmlspecialchars($conv['nom_user']) ?>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="messagerie-chat">
            <div class="messagerie-chat-header">
                <?= htmlspecialchars($conversations[array_search($selectedConv, array_column($conversations, 'id_conv'))]['nom_user'] ?? '') ?>
            </div>
            <div class="messagerie-chat-messages">
                <?php foreach ($messages as $msg): ?>
                <div class="messagerie-message <?= $msg['id_ut'] == $user_id ? 'self' : 'other' ?>">
                    <div class="message-content"><?= htmlspecialchars($msg['contenu_mess']) ?></div>
                    <div class="message-date"><?= date('H:i', strtotime($msg['date_envoi_mess'])) ?></div>
                </div>
                <?php endforeach; ?>
            </div>
            <form class="messagerie-form" method="POST" action="messagerieController.php">
                <input type="hidden" name="conv_id" value="<?= htmlspecialchars($selectedConv) ?>">
                <input type="text" name="message" placeholder="Écrire un message..." required />
                <button type="submit">Envoyer</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
