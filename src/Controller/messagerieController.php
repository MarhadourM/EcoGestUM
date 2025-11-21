<?php
require_once __DIR__ . '/../model/messagerie_model.php';

// TRAITEMENT SUPPRESSION
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['conv'])) {
    $conv_id = intval($_GET['conv']);
    deleteConversationEverywhere($conv_id);
    header("Location: ?page=messagerie");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['new_conv_email'])) {
    $user_id = $_SESSION['user']['id_ut'];
    $email = trim($_POST['new_conv_email']);
    $dest = getUserByEmail($email);

    if (!$dest) {
        header("Location: ?page=messagerie&error=Utilisateur introuvable pour cet email");
        exit;
    }
    $conv_id = findConversationBetweenUsers($user_id, $dest['id_ut']);
    if (!$conv_id) {
        $conv_id = createConversationForBothUsers($user_id, $dest['id_ut']);
        sendMessage($conv_id, $user_id, $dest['id_ut'], "Nouvelle discussion");
    }

    header("Location: ?page=messagerie&conv=$conv_id");
    exit;
}



// ENVOI MESSAGE
if ($_SERVER['REQUEST_METHOD'] === 'POST'
    && isset($_POST['message'], $_POST['conv_id'], $_POST['dest_id'])) {

    $user_id = $_SESSION['user']['id_ut'];
    $conv_id = intval($_POST['conv_id']);
    $dest_id = intval($_POST['dest_id']);
    $message = trim($_POST['message']);

    if ($user_id && $conv_id && $dest_id && $message) {
        sendMessage($conv_id, $user_id, $dest_id, $message);
    }
    header("Location: ?page=messagerie&conv=$conv_id");
    exit;
}
?>
