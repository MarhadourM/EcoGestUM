<?php
require_once __DIR__ . '/modelBDD.php';

function getUserConversations($user_id) {
    $pdo = get_bdd();
    $sql = "SELECT c.id_conv,
                   CASE
                       WHEN m.id_ut = :user_id THEN u2.nom_ut
                       ELSE u1.nom_ut
                   END AS nom_user
            FROM CONVERSATION c
            JOIN MESSAGE m ON m.id_conv = c.id_conv
            JOIN UTILISATEUR u1 ON u1.id_ut = m.id_ut
            JOIN UTILISATEUR u2 ON u2.id_ut = m.id_ut_1
            WHERE m.id_ut = :user_id OR m.id_ut_1 = :user_id
            GROUP BY c.id_conv, nom_user
            ORDER BY c.id_conv DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['user_id' => $user_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


function getConversationMessages($conv_id) {
    $pdo = get_bdd();
    $sql = "SELECT id_ut, contenu_mess, date_envoi_mess FROM MESSAGE WHERE id_conv = :conv_id ORDER BY date_envoi_mess ASC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['conv_id' => $conv_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


function sendMessage($conv_id, $user_id, $dest_id, $message) {
    $pdo = get_bdd();
    $sql = "INSERT INTO MESSAGE (contenu_mess, date_envoi_mess, id_ut, id_ut_1, id_conv) 
            VALUES (:message, NOW(), :user_id, :dest_id, :conv_id)";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([
        'message' => $message,
        'user_id' => $user_id,
        'dest_id' => $dest_id,
        'conv_id' => $conv_id
    ]);
}


?>
