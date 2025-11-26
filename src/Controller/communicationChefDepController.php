<?php
require_once __DIR__ . '/../Model/modelBDD.php'; // pour get_bdd()
require_once __DIR__ . '/../Model/modelChefDepCommunication.php';

$message = null;

$user_id = $_SESSION['user']['id_ut'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $user_id !== null) {
    $destinataire = trim($_POST['destinataires'] ?? '');
    $titre        = trim($_POST['titre'] ?? '');
    $description  = trim($_POST['description'] ?? '');
    $type_notif   = isset($_POST['type_notif']) ? (int)$_POST['type_notif'] : 1;

    // Récupère le nom complet de l'expéditeur en base
    $expediteur_nom = '';
    if ($user_id !== null) {
        $pdo = get_bdd();
        $sql = "SELECT nom_ut, pren_ut FROM utilisateur WHERE id_ut = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$user_id]);
        if ($infos = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $expediteur_nom = $infos['pren_ut'] . ' ' . $infos['nom_ut'];
        }
    }

    if ($destinataire !== '' && $titre !== '' && $description !== '') {
        // Ajoute l’expéditeur devant le titre !
        $message_to_send = ($expediteur_nom ? $expediteur_nom . " - " : "") . $titre . " - " . $description;

        $id_notification = creer_notification_communication(
            $destinataire,
            $message_to_send,
            '', // On ne met rien dans "description" (déjà inclus)
            $type_notif
        );
        if ($id_notification !== null) {
            $message = "Notification envoyée avec succès au destinataire.";
        } else {
            $message = "Destinataire introuvable. Vérifiez le login ou l'email.";
        }
    } else {
        $message = "Veuillez remplir tous les champs.";
    }
} else if ($user_id === null) {
    $message = "Utilisateur non identifié.";
}
?>