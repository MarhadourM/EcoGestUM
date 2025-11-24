<?php
require_once __DIR__ . '/../model/modelBDD.php';
function get_notifs_user($user_id) {
    $pdo = get_bdd();
    $sql = "
        SELECT n.id_notification, n.message_notif, n.date_envoi_notif, n.id_statut_notif, n.id_type_notif, s.nom_statut_notif, t.nom_type_notif
        FROM notif_utilisateur nu
        JOIN NOTIFICATION n ON n.id_notification = nu.id_notification
        JOIN STATUT_NOTIFICATION s ON s.id_statut_notif = n.id_statut_notif
        JOIN TYPE_NOTIF t ON t.id_type_notif = n.id_type_notif
        WHERE nu.id_ut = ?
        ORDER BY n.date_envoi_notif DESC
    ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$user_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function delete_notification_user($id_notification, $id_ut) {
    $pdo = get_bdd();
    $stmt = $pdo->prepare("DELETE FROM notif_utilisateur WHERE id_notification = ? AND id_ut = ?");
    $stmt->execute([$id_notification, $id_ut]);
}

function envoyer_notification($id_ut, $message_notif, $type_notif) {
    $pdo = get_bdd();
    $sql = "INSERT INTO NOTIFICATION (id_ut, message_notif, type_notif, date_notif, statut_notif)
            VALUES (:id_ut, :message_notif, :type_notif, NOW(), 'non lu')";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':id_ut' => $id_ut,
        ':message_notif' => $message_notif,
        ':type_notif' => $type_notif
    ]);
    return $pdo->lastInsertId();
}


?>