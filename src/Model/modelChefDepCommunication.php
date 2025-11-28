<?php
require_once __DIR__ . '/../model/modelNotif.php';

//Trouve l'id_ut du destinataire par email ou login.
function get_user_id_by_destinataire(string $destinataire): ?int {
    $pdo = get_bdd();
    $sql = "SELECT id_ut FROM utilisateur WHERE email_ut = :dest LIMIT 1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':dest' => $destinataire]);
    $id = $stmt->fetchColumn();
    return $id ? (int)$id : null;
}


//Construit le message et envoie la notification.
function creer_notification_communication(string $destinataire, string $message_notif, string $description = '', int $type_notif = 1): ?int {
    $id_ut = get_user_id_by_destinataire($destinataire);
    if ($id_ut === null) {
        return null; 
    }
    // Le message_notif contient déjà tout (expéditeur - titre - description)
    return envoyer_notification($id_ut, $message_notif, $type_notif);
}
?>
