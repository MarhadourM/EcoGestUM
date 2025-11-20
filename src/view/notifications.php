<?php
require_once __DIR__ . '/../controller/NotificationsController.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Notifications</title>
  <link rel="stylesheet" href="<?php echo getenv('BASE_URL'); ?>src/assets/css/style.css">
</head>
<body>
<div class="notif-bg">
  <div class="back-arrow" onclick="window.location.href='<?php echo getenv('BASE_URL'); ?>accueil'">
    <svg viewBox="0 0 24 24" fill="none" stroke="#1B2963" stroke-width="2">
      <path d="M19 12H5M12 19l-7-7 7-7" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
  </div>
  <div class="notif-container">
    <div class="notif-header-bar">
      <span class="notif-header-title">Vos Notifications</span>
      <img src="<?php echo getenv('BASE_URL'); ?>src/assets/Images/logo_LEMANS_UNIVERSITE_Blanc.png" class="notif-header-logo" alt="Logo">
    </div>
    <div class="notif-list">
      <?php foreach($notifications as $notif): ?>
        <div class="notif-card">
          <span>
            <?php
  $baseUrl = getenv('BASE_URL');
  $img = $baseUrl . "src/assets/Images/InfoIcon.png"; // Images au lieu de Img
  if ($notif['nom_type_notif'] === 'information')  $img = $baseUrl . "src/assets/Images/InfoIcon.png";
  if ($notif['nom_type_notif'] === 'alerte')        $img = $baseUrl . "src/assets/Images/AlerteIcon.png";
  if ($notif['nom_type_notif'] === 'confirmation')  $img = $baseUrl . "src/assets/Images/CheckIcon.png";
  if ($notif['nom_type_notif'] === 'rappel')        $img = $baseUrl . "src/assets/Images/alerte.png";
?>
            <img src="<?= $img ?>" class="IconNotif" alt="Icône">
          </span>
          <div class="notif-card-content">
            <div class="notif-card-title"><?= htmlspecialchars($notif['nom_type_notif']); ?></div>
            <div class="notif-card-text"><?= htmlspecialchars($notif['message_notif']); ?></div>
            <div class="notif-card-date"><?= htmlspecialchars(date('d/m/Y', strtotime($notif['date_envoi_notif']))); ?></div>
          </div>
          <div class="notif-card-actions">
            <form method="post" action="supprimer_notif.php" style="display:inline;">
              <input type="hidden" name="idnotification" value="<?= $notif['id_notification']; ?>">
              <button type="submit" class="notif-btn notif-btn-delete">Supprimer</button>
            </form>
            <a href="voir_notif.php?id=<?= $notif['id_notification']; ?>" class="notif-btn notif-btn-read">Voir plus</a>
          </div>
        </div>
      <?php endforeach; ?>
      <?php if (empty($notifications)): ?>
        <div class="notif-empty">Aucune notification.</div>
      <?php endif; ?>
    </div>
  </div>
</div>
</body>
</html>
