<?php
require_once __DIR__ . '/../model/messagerie_model.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['message'], $_POST['conv_id'])) {
    $user_id = $_SESSION['user']['id_ut'] ?? null;
    $conv_id = intval($_POST['conv_id']);
    $message = trim($_POST['message']);
    if ($user_id && $conv_id && $message) {
        sendMessage($conv_id, $user_id, $message);
    }
    header("Location: messagerie.php?conv=$conv_id");
    exit;
}
?>
