<?php
require_once __DIR__ . '/modelBDD.php';

// Cherche un utilisateur par email
function getUserByEmail($email) {
    $pdo = get_bdd();
    $stmt = $pdo->prepare("SELECT id_ut FROM utilisateur WHERE email_ut = :email");
    $stmt->execute(['email' => $email]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Récupère ou crée la boîte de réception
function getOrCreateBoiteDeReception($id_ut) {
    $pdo = get_bdd();
    $stmt = $pdo->prepare("SELECT id_bdr FROM boite_de_reception WHERE id_ut = :id_ut");
    $stmt->execute(['id_ut' => $id_ut]);
    $bdr = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($bdr) return $bdr['id_bdr'];
    $stmt = $pdo->prepare("INSERT INTO boite_de_reception (id_ut) VALUES (:id_ut)");
    $stmt->execute(['id_ut' => $id_ut]);
    return $pdo->lastInsertId();
}

// Crée une conversation (retourne son id)
function createConversation($id_bdr) {
    $pdo = get_bdd();
    $stmt = $pdo->prepare("INSERT INTO conversation (id_bdr) VALUES (:id_bdr)");
    $stmt->execute(['id_bdr' => $id_bdr]);
    return $pdo->lastInsertId();
}

// Envoie un message
function sendMessage($conv_id, $user_id, $dest_id, $message) {
    $pdo = get_bdd();
    $sql = "INSERT INTO message (contenu_mess, date_envoi_mess, id_ut, id_ut_1, id_conv) 
            VALUES (:message, NOW(), :user_id, :dest_id, :conv_id)";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([
        'message' => $message,
        'user_id' => $user_id,
        'dest_id' => $dest_id,
        'conv_id' => $conv_id
    ]);
}

// Vérifie s'il existe déjà une conversation (messages partagés)
function findConversationBetweenUsers($user_id, $dest_id) {
    $pdo = get_bdd();
    $sql = "
        SELECT m.id_conv
        FROM message m
        WHERE (m.id_ut = :user_id AND m.id_ut_1 = :dest_id)
           OR (m.id_ut = :dest_id AND m.id_ut_1 = :user_id)
        LIMIT 1
    ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'user_id' => $user_id,
        'dest_id' => $dest_id
    ]);
    $existing = $stmt->fetch(PDO::FETCH_ASSOC);
    return $existing ? $existing['id_conv'] : false;
}

// Récupère la liste des conv de l'user (inclut le nom du destinataire grâce au pattern du dernier message)
function getUserConversations($user_id) {
    $pdo = get_bdd();
    $sql = "
        SELECT c.id_conv,
               COALESCE(u.nom_ut, '???') AS nom_user,
               COALESCE(partner.id_ut, 0) AS id_dest
        FROM conversation c
        JOIN boite_de_reception bdr ON c.id_bdr = bdr.id_bdr
        LEFT JOIN (
            SELECT m1.id_conv,
                    CASE
                        WHEN m1.id_ut = :user_id THEN m1.id_ut_1
                        ELSE m1.id_ut
                    END AS id_ut,
                    MAX(m1.date_envoi_mess) as max_date
            FROM message m1
            WHERE m1.id_ut = :user_id OR m1.id_ut_1 = :user_id
            GROUP BY m1.id_conv
        ) AS partner ON c.id_conv = partner.id_conv
        LEFT JOIN utilisateur u ON u.id_ut = partner.id_ut
        WHERE bdr.id_ut = :user_id
        GROUP BY c.id_conv
        ORDER BY c.id_conv DESC
    ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['user_id' => $user_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Récupère tous les messages d'une conv
function getConversationMessages($conv_id) {
    $pdo = get_bdd();
    $sql = "SELECT id_ut, contenu_mess, date_envoi_mess FROM message WHERE id_conv = :conv_id ORDER BY date_envoi_mess ASC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['conv_id' => $conv_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Supprime toutes les conv avec un id_conv (donc pour les deux users)
function deleteConversationEverywhere($conv_id) {
    $pdo = get_bdd();
    $stmt = $pdo->prepare("DELETE FROM conversation WHERE id_conv = :id_conv");
    $stmt->execute(['id_conv' => $conv_id]);
}

// Crée une conversation partagée dans les deux boîtes de réception
function createConversationForBothUsers($user_id, $dest_id) {
    $pdo = get_bdd();
    $user_bdr = getOrCreateBoiteDeReception($user_id);
    $dest_bdr = getOrCreateBoiteDeReception($dest_id);

    // On crée pour le 1er utilisateur
    $stmtA = $pdo->prepare("INSERT INTO conversation (id_bdr) VALUES (:id_bdr)");
    $stmtA->execute(['id_bdr' => $user_bdr]);
    $id_conv = $pdo->lastInsertId();

    // On crée pour l'autre SEULEMENT si ce n'est pas la même boîte !
    if ($user_bdr != $dest_bdr) {
        $stmtB = $pdo->prepare("INSERT INTO conversation (id_conv, id_bdr) VALUES (:id_conv, :id_bdr)");
        $stmtB->execute(['id_conv' => $id_conv, 'id_bdr' => $dest_bdr]);
    }

    return $id_conv;
}




?>
